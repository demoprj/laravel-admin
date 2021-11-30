<?php

namespace App\Admin\Extensions\Column;

use Encore\Admin\Admin;
use Encore\Admin\Grid\Displayers\AbstractDisplayer;

// https://www.laravel-admin.org/docs/zh/1.x/model-grid-column#%E6%89%A9%E5%B1%95%E5%88%97%E5%8A%9F%E8%83%BD
// https://github.com/z-song/laravel-admin/blob/master/src/Grid/Displayers/AbstractDisplayer.php
// app/Admin/bootstrap.php
// Column::extend('xx_formatter_status', XxStatus::class);
class XxStatus extends AbstractDisplayer
{
    public function display($para = '')
    {
        // $this->grid;
        // $this->column;
        // $this->row;
        // $this->value;

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
