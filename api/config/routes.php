<?php

declare(strict_types=1);

/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://doc.hyperf.io
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf-cloud/hyperf/blob/master/LICENSE
 */

use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

//站点无需登录
Router::addGroup('/site', function () {
    Router::post('/login', 'App\Controller\SiteController@login');
});

//学生管理
Router::addGroup('/students', function () {
    Router::get('', 'App\Controller\StudentController@index');
    Router::post('', 'App\Controller\StudentController@store');
    Router::put('/{id}', 'App\Controller\StudentController@update');
    Router::delete('/{id}', 'App\Controller\StudentController@delete');
});
