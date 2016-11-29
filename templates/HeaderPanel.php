<?php

require_once ROOT . '/templates/Template.php';
require_once ROOT . '/models/ThemeModel.php';

class HeaderPanel implements Template
{
    private $_model;

    public function __construct()
    {
        $this->_model = new ThemeModel();
    }

    public function render($data = null) : string
    {
        $themes = $this->_model->getListPublished(true, null, 5);

        $element = '<header><ul>';

        $element .= "<li><a href='/'>Главная</a></li>";

        foreach ($themes as $theme) {
            $element .= "<li><a href='/publication/show-theme/{$theme['id']}/1'>{$theme['name']}</a></li>";
        }

        $element .= '</ul></header>';

        return $element;
    }
}
