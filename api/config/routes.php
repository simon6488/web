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
    Router::post('/login', 'App\Controller\Admin\SiteController@login');
});

Router::addGroup('/admin', function () {

    //模块管理
    Router::addGroup('/modules',function (){
        Router::get('', 'App\Controller\Admin\ModuleController@index');
        Router::post('', 'App\Controller\Admin\ModuleController@store');
        Router::put('/{id}', 'App\Controller\Admin\ModuleController@update');
        Router::delete('/{id}', 'App\Controller\Admin\ModuleController@delete');
    });

    //角色管理
    Router::addGroup('/roles',function (){
        Router::get('', 'App\Controller\Admin\RoleController@index');
        Router::post('', 'App\Controller\Admin\RoleController@store');
        Router::put('/{id}', 'App\Controller\Admin\RoleController@update');
        Router::delete('/{id}', 'App\Controller\Admin\RoleController@delete');
    });

    //用户管理
    Router::addGroup('/users', function () {
        Router::get('', 'App\Controller\Admin\UserController@index');
        Router::post('', 'App\Controller\Admin\UserController@store');
        Router::put('/{id}', 'App\Controller\Admin\UserController@update');
        Router::delete('/{id}', 'App\Controller\Admin\UserController@delete');
    });

    //学生管理
    Router::addGroup('/students', function () {
        Router::get('', 'App\Controller\Admin\StudentController@index');
        Router::post('', 'App\Controller\Admin\StudentController@store');
        Router::put('/{id}', 'App\Controller\Admin\StudentController@update');
        Router::delete('/{id}', 'App\Controller\Admin\StudentController@delete');
    });

    //成绩管理
    Router::addGroup('/grade', function () {
        Router::get('', 'App\Controller\Admin\GradeController@index');
        Router::post('', 'App\Controller\Admin\GradeController@store');
        Router::post('/upload', 'App\Controller\Admin\GradeController@upload');
        Router::put('/{id}', 'App\Controller\Admin\GradeController@update');
        Router::delete('/{id}', 'App\Controller\Admin\GradeController@delete');
    });
}, ['middleware' => [\App\Middleware\AuthMiddleware::class]]);
