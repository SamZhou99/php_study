<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// 首页路由
$routes->get('/', 'Home::index');

// 关于页面路由
$routes->get('/about', 'About::index');
$routes->get('/about/add', 'About::add');
$routes->get('/about/delete', 'About::delete');
$routes->get('/about/update', 'About::update');

/*
 * --------------------------------------------------------------------
 * API 路由组
 * --------------------------------------------------------------------
 *
 * 所有 API 路由都放在 /api 前缀下
 * 支持跨域请求和 JSON 响应
 */
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    // API 版本分组
    $routes->group('v1', function ($routes) {
        // 用户相关 API
        $routes->get('users', 'Api\UserController::index');
        $routes->get('users/(:num)', 'Api\UserController::show/$1');
        $routes->post('users', 'Api\UserController::create');
        $routes->put('users/(:num)', 'Api\UserController::update/$1');
        $routes->delete('users/(:num)', 'Api\UserController::delete/$1');

        // 示例 API
        $routes->get('test', 'Api\TestController::index');
        $routes->post('test', 'Api\TestController::create');
    });
});