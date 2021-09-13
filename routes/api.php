<?php

use App\Http\Controllers\API\AnnouncementsController;
use App\Http\Controllers\API\ReportsController;
use App\Http\Controllers\API\BlogsController;
use App\Http\Controllers\API\FormsController;
use App\Http\Controllers\API\NewsletterController;
use App\Http\Controllers\API\EventsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function(){
    Route::post('details', 'API\UserController@details');
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::group(['prefix' => 'reports'], function () {
        Route::get('getReports', [ReportsController::class, 'getReports']);
        Route::get('getProgressReports', [ReportsController::class, 'getProgressReports']);
        Route::get('getTransparencyReports', [ReportsController::class, 'getTransparencyReports']);
        Route::post('store', [ReportsController::class, 'store']);
        Route::post('delete', [ReportsController::class, 'delete']);
    });

    Route::group(['prefix' => 'announcements'], function () {
        Route::get('getAnnouncement', [AnnouncementsController::class, 'getAnnouncement']);
        Route::get('getThreeAnnouncement', [AnnouncementsController::class, 'getThreeAnnouncement']);
        Route::post('editAnn', [AnnouncementsController::class, 'editAnn']);
        Route::post('store', [AnnouncementsController::class, 'store']);
        Route::post('delete', [AnnouncementsController::class, 'delete']);
    });

    Route::group(['prefix' => 'blogs'], function () {
        Route::get('getAllBlog', [BlogsController::class, 'getAllBlog']);
        Route::post('store', [BlogsController::class, 'store']);
        Route::post('delete', [BlogsController::class, 'delete']);
        Route::post('editBlog', [BlogsController::class, 'editBlog']);
    });

    Route::group(['prefix' => 'forms'], function () {
        Route::get('getForms', [FormsController::class, 'getForms']);
        Route::post('editForms', [FormsController::class, 'editForms']);
        Route::post('store', [FormsController::class, 'store']);
        Route::post('delete', [FormsController::class, 'delete']);
    });

    Route::group(['prefix' => 'newsletter'], function () {
        Route::get('getNewsletter', [NewsletterController::class, 'getNewsletter']);
        Route::post('editNewsletter', [NewsletterController::class, 'editNewsletter']);
        Route::post('store', [NewsletterController::class, 'store']);
        Route::post('delete', [NewsletterController::class, 'delete']);
    });

    Route::group(['prefix' => 'events'], function () {
        Route::get('getEvents', [EventsController::class, 'getEvents']);
        Route::post('store', [EventsController::class, 'store']);
        Route::post('delete', [EventsController::class, 'delete']);
        Route::post('editEvent', [EventsController::class, 'editEvent']);
    });
});
