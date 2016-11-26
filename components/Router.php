<?php

require_once ROOT . '/components/exceptions/FileNotFoundException.php';
require_once ROOT . '/components/exceptions/InvalidNameException.php';

class Router
{
    private $_uri;
    private $_segments;
    private $_controllerClassName;
    private $_controllerFilename;
    private $_controller;
    private $_actionName;
    private $_actionArgs;

    public function __construct()
    {
        $this->_uri = self::_getUri();
        $this->_searchRoute();

        $this->_segments = $this->_getSegments();

        $this->_initControllerClassName();
        $this->_initControllerFilename();
        $this->_initController();
        $this->_initActionName();
        $this->_initActionArgs();
    }

    public function getController()
    {
        return $this->_controller;
    }

    public function getActionName()
    {
        return $this->_actionName;
    }

    public function getActionArgs()
    {
        return $this->_actionArgs;
    }

    private function _searchRoute()
    {
        if ($this->_uri === '') {
            $this->_uri = Application::$config['router']['defaultController'];
            return true;
        }

        foreach (Application::$config['router']['exceptionRoutes'] as $uriPattern => $route) {
            if (preg_match("~$uriPattern~", $this->_uri)) {
                $this->_uri = preg_replace("~$uriPattern~", $route, $this->_uri);
                return true;
            }
        }

        return false;
    }

    private function _getSegments()
    {
        return explode('/', $this->_uri);
    }

    private function _initControllerClassName()
    {
        $tmp = array_shift($this->_segments);

        if (self::_isValidName($tmp)) {
            $this->_controllerClassName = self::_toCamelCase($tmp) . 'Controller';
        } else {
            throw new InvalidNameException(
                $tmp,
                'Controller class name does not match any rules.'
            );
        }
    }

    private function _initControllerFilename()
    {
        $this->_controllerFilename = ROOT . '/controllers/' . $this->_controllerClassName . '.php';
    }

    private function _initController()
    {
        if (!file_exists($this->_controllerFilename)) {
             throw new FileNotFoundException($this->_controllerFilename);
        }

        include $this->_controllerFilename;

        $this->_controller = new $this->_controllerClassName();
    }

    private function _initActionName()
    {
        if (count($this->_segments) === 0) {
            $actionName = $this->_controller->getDefaultAction();
            $this->_actionArgs = $this->_controller->getDefaultActionArgs();
        } else {
            $actionName = array_shift($this->_segments);
        }

        if (!self::_isValidName($actionName)) {
            throw new InvalidNameException(
                $actionName,
                'Action name does not match any rules.'
            );
        }

        $this->_actionName = 'action' . self::_toCamelCase($actionName);
    }

    private function _initActionArgs()
    {
        if (!isset($this->_actionArgs)) {
            $this->_actionArgs = $this->_segments;
        }
    }

    private static function _getUri()
    {
        return ltrim($_SERVER['REQUEST_URI'], '/');
    }

    private static function _isValidName($name)
    {
        return  preg_match('/^[a-z\d-]+$/', $name) &&    // consists of these characters
                preg_match('/^[a-z]+/', $name) &&        // begins with letter
                preg_match('/[a-z\d]+$/', $name) &&      // ends with letter or digit
                !preg_match('/-{2,}/', $name);           // hyphen can't appear in a row more than twice
    }

    private static function _toCamelCase($stringWithHyphens)
    {
        return implode('',
            array_map(
                function ($item) { return ucfirst($item); },
                explode('-', $stringWithHyphens)
            )
        );
    }
}
