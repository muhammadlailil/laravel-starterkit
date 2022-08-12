<?php

use Illuminate\Support\Facades\Route;
use Laililmahfud\Starterkit\Models\CmsModuls;
use Laililmahfud\Starterkit\Middleware\AdminMiddleware;
use Laililmahfud\Starterkit\Controllers\AdminController;
use Laililmahfud\Starterkit\Middleware\SuperAdminMiddleware;
use Laililmahfud\Starterkit\controllers\AdminCmsMenusController;
use Laililmahfud\Starterkit\Controllers\AdminCmsUsersController;
use Laililmahfud\Starterkit\controllers\AdminCmsModulsController;
use Laililmahfud\Starterkit\controllers\AdminCmsPrivilegesController;

Route::group(['prefix' => s_config('admin_path'), 'as' => 'admin.', 'middleware' => ['web']], function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'getLogin')->name('login');
        Route::post('/login', 'postLogin')->name('post-login');
    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'getIndex')->name('index');
            Route::get('/logout', 'getLogout')->name('logout');
        });

        Route::middleware(SuperAdminMiddleware::class)->group(function () {
            Route::group(['prefix' => 'cms-users', 'as' => 'cms-users.', 'controller' => AdminCmsUsersController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/save', 'save')->name('save');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::delete('/bulk-delete', 'bulkdelete')->name('bulk-delete');
            });
            Route::group(['prefix' => 'cms-roles', 'as' => 'cms-roles.', 'controller' => AdminCmsPrivilegesController::class], function () {
                Route::get('/', 'index')->name('index');
                Route::get('/add', 'add')->name('add');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/save', 'save')->name('save');
                Route::delete('/delete/{id}', 'delete')->name('delete');
                Route::delete('/bulk-delete', 'bulkdelete')->name('bulk-delete');
            });

            Route::group(['prefix' => 'cms-menus', 'as' => 'cms-menus.', 'controller' => AdminCmsMenusController::class], function () {
                Route::get('', 'index')->name('index');
                Route::post('/save', 'save')->name('save');
                Route::post('/save-sorting', 'sortingMenus')->name('save-sorting');
            });

            Route::group(['prefix' => 'cms-moduls', 'as' => 'cms-moduls.', 'controller' => AdminCmsModulsController::class], function () {
                Route::get('', 'index')->name('index');
                Route::get('/load-columns/{table_name}', 'loadColumns')->name('load-columns');
                Route::post('/save', 'save')->name('save');
            });
        });

        try {
            //loop cms modul
            $moduls = CmsModuls::whereType('module')->get();
            foreach ($moduls as $row) {
                Route::group(['prefix' => $row->path, 'as' => "$row->route_prefix.", 'controller' => "\App\Http\Controllers\Admin\\$row->controller"], function () {
                    Route::get('/', 'index')->name('index');
                    Route::get('/add', 'add')->name('add');
                    Route::get('/edit/{id}', 'edit')->name('edit');
                    Route::post('/save', 'save')->name('save');
                    Route::delete('/delete/{id}', 'delete')->name('delete');
                    Route::delete('/bulk-delete', 'bulkdelete')->name('bulk-delete');
                });
            }
        } catch (Exception $e) {
    
        }
        
    });

});
