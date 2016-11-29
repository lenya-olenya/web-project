<?php

interface Template
{
    public function render($data = null) : string;
}
