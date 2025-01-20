<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LangController;
use App\Http\Controllers\AuthController;
Route::middleware(['auth.check'])->prefix('/')->group(function (){
    Route::get('/', [DashboardController::class, 'page'])->name('home');
    Route::get('/profile', [UserController::class, 'profilePage'])->name('profile');
    Route::post('/profile', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/change-password', [UserController::class, 'changePasswordPage'])->name('profile.change_password_page');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change_password');


    /* Course Routes */
    Route::prefix('course')->name('course.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CourseController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\CourseController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\CourseController::class, 'show'])->name('show');
        Route::get('/topics/{id}', [\App\Http\Controllers\CourseController::class, 'getCourseWiseTopic'])->name('get_topics');
        Route::get('/edit/{id}', [\App\Http\Controllers\CourseController::class, 'edit'])->name('edit');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\CourseController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/update/{id}', [\App\Http\Controllers\CourseController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\CourseController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\CourseController::class, 'delete'])->name('delete');
        Route::get('/export', [\App\Http\Controllers\CourseController::class, 'export'])->name('export');
    });

    /* Course Routes */
    Route::prefix('quick-tips')->name('quick_tips.')->group(function (){
        Route::get('/', [\App\Http\Controllers\QuickTipsController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\QuickTipsController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\QuickTipsController::class, 'show'])->name('show');
        Route::get('/topics/{id}', [\App\Http\Controllers\QuickTipsController::class, 'getCourseWiseTopic'])->name('get_topics');
        Route::get('/edit/{id}', [\App\Http\Controllers\QuickTipsController::class, 'edit'])->name('edit');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\QuickTipsController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/update/{id}', [\App\Http\Controllers\QuickTipsController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\QuickTipsController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\QuickTipsController::class, 'delete'])->name('delete');
        Route::get('/export', [\App\Http\Controllers\QuickTipsController::class, 'export'])->name('export');
    });

    /* Course Topics Routes */
    Route::prefix('course-topic')->name('course_topic.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CourseTopicController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\CourseTopicController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\CourseTopicController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\CourseTopicController::class, 'edit'])->name('edit');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\CourseTopicController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/update/{id}', [\App\Http\Controllers\CourseTopicController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\CourseTopicController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\CourseTopicController::class, 'delete'])->name('delete');
        Route::get('/export', [\App\Http\Controllers\CourseTopicController::class, 'export'])->name('export');
    });

    /* Course Topics Data Routes */
    Route::prefix('course-topic-data')->name('course_topic_data.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CourseTopicDataController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\CourseTopicDataController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\CourseTopicDataController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\CourseTopicDataController::class, 'edit'])->name('edit');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\CourseTopicDataController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/update/{id}', [\App\Http\Controllers\CourseTopicDataController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\CourseTopicDataController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\CourseTopicDataController::class, 'delete'])->name('delete');
        Route::get('/export', [\App\Http\Controllers\CourseTopicDataController::class, 'export'])->name('export');
    });


    /* Course Topics Resource Routes */
    Route::prefix('course-topic-resource')->name('course_topic_resource.')->group(function (){
        Route::get('/', [\App\Http\Controllers\CourseTopicResourceController::class, 'index'])->name('index');
        Route::get('/create', [\App\Http\Controllers\CourseTopicResourceController::class, 'create'])->name('create');
        Route::get('/show/{id}', [\App\Http\Controllers\CourseTopicResourceController::class, 'show'])->name('show');
        Route::get('/edit/{id}', [\App\Http\Controllers\CourseTopicResourceController::class, 'edit'])->name('edit');
        Route::get('/changeStatus/{id}', [\App\Http\Controllers\CourseTopicResourceController::class, 'changeStatus'])->name('changeStatus');
        Route::post('/update/{id}', [\App\Http\Controllers\CourseTopicResourceController::class, 'update'])->name('update');
        Route::post('/store', [\App\Http\Controllers\CourseTopicResourceController::class, 'store'])->name('store');
        Route::post('/delete/{id}', [\App\Http\Controllers\CourseTopicResourceController::class, 'delete'])->name('delete');
        Route::get('/export', [\App\Http\Controllers\CourseTopicResourceController::class, 'export'])->name('export');
    });





    /* Users Route:-> Example Routes  */
    Route::prefix('users')->name('user.')->group(function (){
        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('index');

    });

    Route::get('change-lang/{lang}', [LangController::class, 'change'])->name('lang.change');
    Route::get('change-theme/{name}', [LangController::class, 'changeTheme'])->name('theme.change');
});

Route::get('/login', [AuthController::class, 'loginPage'])->name('loginPage');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
