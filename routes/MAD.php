<?php

use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\ProductController;
use App\Support\Generators\CRUDRouteGenerator;
use Illuminate\Support\Facades\Route;

Route::middleware('auth', 'auth.session')->group(function () {
    // EPP
    Route::prefix('manufacturers')->controller(ManufacturerController::class)->name('manufacturers.')->group(function () {
        CRUDRouteGenerator::defineDefaultRoutesExcept(['show'], 'id', 'can:view-MAD-EPP', 'can:edit-MAD-EPP');
        Route::post('/export-as-excel', 'exportAsExcel')->name('export-as-excel')->middleware('can:export-records-as-excel');
    });

    // IVP
    Route::prefix('products')->controller(ProductController::class)->name('products.')->group(function () {
        CRUDRouteGenerator::defineDefaultRoutesExcept(['show'], 'id', 'can:view-MAD-IVP', 'can:edit-MAD-IVP');

        Route::post('/export-as-excel', 'exportAsExcel')->name('export-as-excel')->middleware('can:export-records-as-excel');
        Route::post('/get-similar-records', 'getSimilarRecordsForRequest');  // AJAX request on create form for uniqness
    });

    // VPS
    Route::prefix('processes')->controller(ProcessController::class)->name('processes.')->group(function () {
        CRUDRouteGenerator::defineDefaultRoutesExcept(['show'], 'id', 'can:view-MAD-VPS', 'can:edit-MAD-VPS');
        Route::post('/export-as-excel', 'exportAsExcel')->name('export-as-excel')->middleware('can:export-records-as-excel');
    });

    // KVPP
    Route::prefix('product-searches')->controller(ProductSearchController::class)->name('product-searches.')->group(function () {
        CRUDRouteGenerator::defineDefaultRoutesExcept(['show'], 'id', 'can:view-MAD-KVPP', 'can:edit-MAD-KVPP');
        Route::post('/export-as-excel', 'exportAsExcel')->name('export-as-excel')->middleware('can:export-records-as-excel');
    });

    // Meetings
    Route::prefix('meetings')->controller(ProcessController::class)->name('meetings.')->group(function () {
        CRUDRouteGenerator::defineDefaultRoutesExcept(['show'], 'id', 'can:view-MAD-Meetings', 'can:edit-MAD-Meetings');
        Route::post('/export-as-excel', 'exportAsExcel')->name('export-as-excel')->middleware('can:export-records-as-excel');
    });
});
