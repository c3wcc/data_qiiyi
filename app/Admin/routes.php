<?php

use Illuminate\Routing\Router;

Admin::registerAuthRoutes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');

    $router->resource('user', UserController::class);
    $router->resource('order', OrderController::class);
    $router->resource('store', StoreController::class);
    $router->resource('food/category', FoodCategoryController::class);
    $router->resource('food', FoodListController::class);

    //地址异常
    $router->resource('abnormal/address', AbnormalAddressController::class);
    $router->resource('abnormal/management', AbnormalManagementController::class);
    

});
