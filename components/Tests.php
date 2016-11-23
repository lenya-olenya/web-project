<?php

class Tests
{
    private $_className;

    public function __construct($className)
    {
        $this->_className = $className;

        echo '<style>span.passed { font-weight: bold; color: green; } ' .
            'span.failed { font-weight: bold; color: red; }</style>';

        echo '<pre>';
    }

    public function test($className, $methodName, ...$args)
    {
        $res = null;

        try {
            $res = call_user_func_array([new $className, $methodName], $args);
            self::_echoPassed("`$className::$methodName` test passed!");
        } catch (Exception $e) {
            self::_echoFailed("`$className::$methodName` test failed!");
            var_dump($e->getMessage());
        }

        echo '<br>';
        var_dump($res);
        echo '<br>';

        return $res;
    }

    public function testClass($methodName, ...$args)
    {
        return $this->test($this->_className, $methodName, ...$args);
    }

    public function setClassName($className)
    {
        $this->_className = $className;
    }

    private static function _echoPassed($message)
    {
        echo '<span class="passed">' . $message .'</span>';
    }

    private static function _echoFailed($message)
    {
        echo '<span class="failed">' . $message .'</span>';
    }
}
