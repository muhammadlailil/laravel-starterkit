<?php

use Illuminate\Support\Facades\Route;
use laililmahfud\starterkit\models\CmsModuls;
use laililmahfud\starterkit\middleware\AdminMiddleware;
use laililmahfud\starterkit\Middleware\SuperAdminMiddleware;
use laililmahfud\starterkit\controllers\Admin\AdminController;
use laililmahfud\starterkit\controllers\Admin\AdminCmsMenusController;
use laililmahfud\starterkit\controllers\Admin\AdminCmsUsersController;
use laililmahfud\starterkit\controllers\Admin\AdminCmsModulsController;
use laililmahfud\starterkit\controllers\Admin\AdminCmsPrivilegesController;
use laililmahfud\starterkit\controllers\Admin\AdminCmsNotificationController;

Route::group(['prefix' => s_config('admin_path'), 'as' => 'admin.', 'middleware' => ['web']], function () {

    Route::controller(AdminController::class)->group(function () {
        Route::get('/login', 'getLogin')->name('login');
        Route::post('/login', 'postLogin')->name('post-login');
    });

    Route::middleware(AdminMiddleware::class)->group(function () {
        Route::controller(AdminController::class)->group(function () {
            Route::get('/', 'getIndex')->name('index');
            Route::get('/logout', 'getLogout')->name('logout');
            Route::get('/profile', 'getProfile')->name('profile');
            Route::post('/profile', 'updateProfile')->name('update-profile');
        });
        Route::group(['prefix' => 'cms-notification', 'as' => 'cms-notification.', 'controller' => AdminCmsNotificationController::class], function () {
            Route::get('/', 'index')->name('index');
            Route::get('/read/{id}', 'read')->name('read');
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

Route::get('/simlink', function () {
    return app('files')->link(storage_path('app/public'), public_path('storage'));
});