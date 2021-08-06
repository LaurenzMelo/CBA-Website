<?php

use App\Http\Controllers\API\AnnouncementsController;
use App\Http\Controllers\API\BlogsController;
use App\Http\Controllers\API\EventsController;
use App\Http\Controllers\API\FormsController;
use App\Http\Controllers\API\ReportsController;
use App\Http\Controllers\API\WebsiteController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('pages/website/index');
});

Auth::routes();

//Website
Route::group(['prefix' => '/'], function () {
    Route::get('index', [WebsiteController::class, 'index'])->name('website.index');
    Route::get('processes', [WebsiteController::class, 'processes'])->name('website.processes');
    Route::get('forms', [WebsiteController::class, 'forms'])->name('website.forms');
    Route::get('events', [WebsiteController::class, 'events'])->name('website.events');
    Route::get('blog', [WebsiteController::class, 'blog'])->name('website.blog');
    Route::get('know_us', [WebsiteController::class, 'know_us'])->name('website.know_us');
    Route::get('directories', [WebsiteController::class, 'directories'])->name('website.directories');

    Route::group(['prefix' => 'reports'], function () {
        Route::get('getProgressReports', [ReportsController::class, 'getProgressReports']);
        Route::get('getTransparencyReports', [ReportsController::class, 'getTransparencyReports']);
    });

    Route::group(['prefix' => 'announcements'], function () {
        Route::get('getThreeAnnouncement', [AnnouncementsController::class, 'getThreeAnnouncement']);
        Route::get('all', [AnnouncementsController::class, 'allAnnouncement']);
    });

    Route::group(['prefix' => 'blog'], function () {
        Route::get('getBlog', [BlogsController::class, 'getBlog']);
        Route::get('{id}', [BlogsController::class, 'getIndBlog'])->name('website.ind_blog');
    });
});

//Dashboard
Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('home', [HomeController::class, 'index'])->name('home');
    Route::get('forms/processes', [FormsController::class, 'process_index'])->name('forms.processes');
    Route::get('forms/downloadable_forms', [FormsController::class, 'download_index'])->name('forms.download');
    Route::get('blogs', [BlogsController::class, 'index'])->name('blogs');
    Route::get('reports', [ReportsController::class, 'index'])->name('reports');
    Route::get('announcements', [AnnouncementsController::class, 'index'])->name('announcements');
    Route::get('admin/events', [EventsController::class, 'index'])->name('events');
});
