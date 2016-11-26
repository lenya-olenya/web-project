<?php

abstract class Controller
{
    protected $_defaultAction;
    protected $_defaultActionArgs;

    public function __construct()
    {
        $this->_defaultAction = 'index';
        $this->_defaultActionArgs = [];
    }

    public function getDefaultAction()
    {
        return $this->_defaultAction;
    }

    public function getDefaultActionArgs()
    {
        return $this->_defaultActionArgs;
    }
}
