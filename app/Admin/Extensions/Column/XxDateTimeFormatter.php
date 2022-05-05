<?php

namespace App\Admin\Controllers\Extensions\Grid;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

// App\Admin\bootstrap.php
class XxDateTimeFormatter extends AbstractDisplayer
{
    public function display($formtter = 'Y-m-d')
    {
        return $this->value ? date($formtter, strtotime($this->value)) : '';
    }
}
