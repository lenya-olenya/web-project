<?php

require_once ROOT . '/components/Tests.php';
require_once ROOT . '/models/AdminConfigModel.php';

class AdminConfigModelTests
{
    private $_tests;

    public function __construct()
    {
        $this->_tests = new Tests('AdminConfigModel');
    }

    public function setLoginTest()
    {
        $this->_tests->testClass('setLogin', 'test_login');
    }

    public function setPasswordTest()
    {
        $this->_tests->testClass('setPassword', 'test_password');
    }

    public function getLoginTest()
    {
        $this->_tests->testClass('getLogin');
    }

    public function getPasswordTest()
    {
        $this->_tests->testClass('getPassword');
    }

    public function testAll()
    {
        $this->setLoginTest();
        $this->setPasswordTest();
        $this->getLoginTest();
        $this->getPasswordTest();
    }
}
