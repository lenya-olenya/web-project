<?php

require_once ROOT . '/components/Tests.php';
require_once ROOT . '/models/ThemeModel.php';

class ThemeModelTests
{
    private $_tests;

    public function __construct()
    {
        $this->_tests = new Tests('ThemeModel');
    }

    public function addTest()
    {
        $this->_tests->testClass('add');
        $this->_tests->testClass('add', 'Test Theme 1');
        $this->_tests->testClass('add', 'Test Theme 2', 'Test Description 2');
        $this->_tests->testClass('add', 'Test Theme 3', 'Test Description 3', true);
        $this->_tests->testClass('add', null, 'Test Description 4', true);
        $this->_tests->testClass('add', null, null, true);
        $this->_tests->testClass('add', null, null, false);
        $this->_tests->testClass('add', 'Test Theme 4', null, true);
    }

    public function getListPublishedTest()
    {
        $this->_tests->testClass('getListPublished');
        $this->_tests->testClass('getListPublished', false);
        $this->_tests->testClass('getListPublished', true, 1);
        $this->_tests->testClass('getListPublished', true, null, 2);
        $this->_tests->testClass('getListPublished', false, 1, 2);
    }

    public function getNameTest()
    {
        $this->_tests->testClass('getName');
    }

    public function testAll()
    {
//        $this->addTest();
        $this->getListPublishedTest();
        $this->getNameTest();
    }
}
