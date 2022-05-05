<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

use Encore\Admin\Grid\Column;
use Encore\Admin\Show;

Column::extend('xx_formatter_status', App\Admin\Extensions\Column\XxStatus::class);
Column::extend('xx_datetime', App\Admin\Extensions\Column\XxDateTimeFormatter::class);
Show::extend('xx_formatter_status', App\Admin\Extensions\Show\XxStatus::class);
Show::extend('xx_datetime', App\Admin\Extensions\Show\XxDateTimeFormatter::class);

// use Encore\Admin\Admin;
// Admin::disablePjax();
// Admin::favicon('/your/favicon/path');
// Admin::css('/your/css/path/style.css');
// Admin::js('/your/javascript/path/js.js');
// Admin::script('console.log("hello world");');
// Admin::style('.form-control {margin-top: 10px;}');
// Admin::html('<template>...</template>');

Admin::navbar(function (\Encore\Admin\Widgets\Navbar $navbar) {
    $navbar->right(new App\Admin\Actions\Feedback())
        ->right(new App\Admin\Actions\System());
    $navbar->right(App\Admin\Extensions\Nav\Shortcut::make([
        'Posts' => 'posts/create',
        'Users' => 'users/create',
        'Images' => 'images/create',
        'Videos' => 'videos/create',
        'Articles' => 'articles/create',
        'Tags' => 'tags/create',
        'Categories' => 'categories/create',
    ], 'fa-plus')->title('新建'));

    $navbar->right(new App\Admin\Extensions\Nav\Dropdown());
});

//
Encore\Admin\Form::forget(['map', 'editor']);
