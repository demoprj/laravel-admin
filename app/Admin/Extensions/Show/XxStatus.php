<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

// https://laravel-admin.org/docs/zh/1.x/model-show-extension
// https://github.com/z-song/laravel-admin/blob/master/src/Show/AbstractField.php
// app/Admin/bootstrap.php
// Column::extend('xx_formatter_status', XxStatus::class);
class XxStatus extends AbstractField
{
    public $border = true;
    public $escape = false;

    public function render($arg = '')
    {
        // $this->value;
        // $this->model;
        // $this->border = true;
        // $this->escape = false;

        switch ($this->value) {
            case 0:
                return '<span class="label label-danger">无效</span>';
                break;
            case 1:
                return '<span class="label label-success">有效</span>';
                break;
        }
        return $this->value;
    }
}
