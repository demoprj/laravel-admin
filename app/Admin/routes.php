<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {

    $router->get('/', 'HomeController@index')->name('home');
    //
    $router->resource('/xxtest', XxTestController::class);
    $router->resource('/xxtestdetail', XxTestDetailController::class);
    //
    $router->resource('/xxtest2', XxTestController2::class);
    $router->resource('/xxtestdetail2', XxTestDetailController2::class);
    //
    $router->resource('/xxtest3', XxTestController3::class);
    //
    $router->resource('/xxtest_bad', XxTestControllerBad::class);
    
});


Route::group([
    'prefix'        => config('admin.route.prefix'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->resource('/form/xxtest_form', App\Admin\Forms\FormTest::class);
});

