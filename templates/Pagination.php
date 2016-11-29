<?php

require_once ROOT . '/templates/Template.php';

class Pagination implements Template
{
    public function render($data = null): string
    {
        $activePage = $data['activePage'] ?? 1;
        $pageCount = $data['pageCount'] ?? 1;
        $action = $data['action'] ?? 'show-all';
        $prevPage = $activePage - 1;
        $nextPage = $activePage + 1;

        $element = '';

        $element .= "<ul class='pagination'>";

        if ($activePage == 1) {
            $element .= "<li><a class='not-active' href='#'>«</a></li>";
        } else {
            $element .= "<li><a href='/publication/$action/$prevPage'>«</a></li>";
        }

        for ($i = 1; $i <= $pageCount; $i++) {
            if ($i == $activePage) {
                $element .= "<li><a class='active' href='#'>$i</a></li>";
            } else {
                $element .= "<li><a href='/publication/$action/$i'>$i</a></li>";
            }
        }

        if ($activePage == $pageCount) {
            $element .= "<li class='not-active'><a href='#'>»</a></li>";
        } else {
            $element .= "<li><a href='/publication/$action/$nextPage'>»</a></li>";
        }

        $element .= "</ul>";

        return $element;
    }
}
