<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

// https://laravel-admin.org/docs/zh/1.x/model-show-extension
// https://github.com/z-song/laravel-admin/blob/master/src/Show/AbstractField.php
// app/Admin/bootstrap.php
class XxDateTimeFormatter extends AbstractField
{
    public function render($arg = 'Y-m-d')
    {
        // $this->value;
        // $this->model;
        // $this->border = false;
        // $this->escape = true;

        $formtter = $arg;
        return $this->value ? date($formtter, strtotime($this->value)) : '';
    }
}
