<?php

require_once ROOT . '/templates/Template.php';

class Head implements Template
{
    private $_title;
    private $_styles;

    public function __construct($title = 'Title', ...$styles)
    {
        $this->_title = $title;
        $this->_styles = $styles;
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

        $element .= '</head>';

        return $element;
    }
}
