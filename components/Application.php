<?php

require_once ROOT . '/components/Router.php';
require_once ROOT . '/components/exceptions/FileNotFoundException.php';
require_once ROOT . '/components/exceptions/InvalidNameException.php';

class Application
{
    public static $config;

    private $_router;
    private $_controller;
    private $_action;
    private $_actionArgs;

    public function __construct(&$config)
    {
        self::$config = $config;
    }

    public function run()
    {
        try {
            $this->_router = new Router();
        } catch (FileNotFoundException $e) {
            // 404
            echo '404 file not found'; die;
        } catch (InvalidNameException $e) {
            // 404
            echo '404'; die;
        }

        $this->_controller = $this->_router->getController();
        $this->_action = $this->_router->getActionName();
        $this->_actionArgs = $this->_router->getActionArgs();

        if (!method_exists($this->_controller, $this->_action)) {
            // 404
            echo '404'; die;
        }

        if (
            count($this->_actionArgs) != (new ReflectionMethod(
                $this->_controller,
                $this->_action)
            )->getNumberOfParameters()
        ) {
            // 404
            echo '404'; die;
        }

        return call_user_func_array(
            [
                $this->_controller,
                $this->_action
            ],
            $this->_actionArgs
        );
    }
}
