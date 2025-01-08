<?php

use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\AuthenticatedSessionController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use App\Support\Generators\CRUDRouteGenerator;
use Illuminate\Support\Facades\Route;

Route::controller(AuthenticatedSessionController::class)->group(function () {
    Route::get('login', 'create')->middleware('guest')->name('login');
    Route::post('login', 'store')->middleware('guest');
    Route::post('logout', 'destroy')->middleware('auth')->name('logout');
});

Route::middleware('auth', 'auth.session')->group(function () {
    Route::controller(MainController::class)->group(function () {
        Route::get('/', 'redirectToHomePage')->name('home');
        Route::post('/upload-simditor-image', 'uploadSimditorImage');
        Route::post('/navigate-to-page-number', 'navigateToPageNumber')->name('navigate-to-page-number');
    });

    Route::controller(SettingController::class)->prefix('/settings')->name('settings.')->group(function () {
        Route::patch('locale', 'updateLocale')->name('update-locale');
        Route::patch('preferred-theme', 'toggleTheme')->name('toggle-theme');
        Route::patch('collapsed-leftbar', 'toggleLeftbar')->name('toggle-leftbar'); // ajax request
        Route::patch('table-columns/{key}', 'updateTableColumns')->name('update-table-columns');
    });

    Route::prefix('notifications')->controller(NotificationController::class)->name('notifications.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::patch('/mark-as-read', 'markAsRead')->name('mark-as-read');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });

    Route::controller(ProfileController::class)->name('profile.')->group(function () {
        Route::get('profile', 'edit')->name('edit');
        Route::patch('profile', 'update')->name('update');
        Route::patch('password', 'updatePassword')->name('update-password');
    });

    Route::prefix('comments')->controller(CommentController::class)->name('comments.')->group(function () {
        Route::get('/view/{commentable_type}/{commentable_id}', 'index')->name('index');

        CRUDRouteGenerator::defineDefaultRoutesOnly(['edit', 'store', 'update', 'destroy'], 'id', null, 'can:edit-comments');
    });

    Route::prefix('model-attachments')->controller(AttachmentController::class)->name('attachments.')->group(function () {
        Route::get('/view/{attachable_type}/{attachable_id}', 'index')->name('index');
        Route::delete('/destroy', 'destroy')->name('destroy');
    });
});

require __DIR__ . '/MAD.php';
