<?php

require_once ROOT . '/templates/Template.php';

class Head implements Template
{
    private $_title;
    private $_styles;
    private $_scripts;

    public function __construct($title = 'Title')
    {
        $this->_title = $title;
        $this->_styles = [];
        $this->_scripts = [];
    }

    public function addStyle($style)
    {
        $this->_styles[] = $style;
    }

    public function addScript($script)
    {
        $this->_scripts[] = $script;
    }

    public function render($data = null): string
    {
        $element = '';

        $element .= '<head>';
        $element .= '<meta charset="utf-8">';
        $element .= '<title>' . $this->_title . '</title>';

        foreach ($this->_styles as $style) {
            $element .= "<link rel='stylesheet' href='$style'>";
        }

        foreach ($this->_scripts as $script) {
            $element .= "<script src='$script'></script>";
        }

        $element .= '</head>';

        return $element;
    }
}
