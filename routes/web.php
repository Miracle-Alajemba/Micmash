<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventRsvpController;
use App\Http\Controllers\EventLikeController;
use App\Http\Controllers\EventCommentController;

// Admin Controllers
use App\Http\Controllers\Admin\AdminEventController;
use App\Http\Controllers\Admin\AdminCategoryController;
use App\Http\Controllers\Admin\AdminUserController;

/*
|--------------------------------------------------------------------------
| Public Routes (Everyone can see)
|--------------------------------------------------------------------------
*/

Route::get('/', function () { return view('layouts.welcome'); })->name('home');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::view('/about', 'about')->name('about');
/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Must be logged in)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {

    // Event Management (Create, Edit, Delete)
    Route::resource('events', EventController::class)->except(['index', 'show']);

    // Interactions
    Route::post('/events/{event}/rsvp', [EventRsvpController::class, 'toggle'])->middleware('throttle:5,1')->name('events.rsvp');
    Route::post('/events/{event}/like', [EventLikeController::class, 'toggle'])->middleware('throttle:10,1')->name('events.like');
    Route::post('/events/{event}/comment', [EventCommentController::class, 'store'])->middleware('throttle:5,1')->name('events.comment');

    // User Profile (Default Breeze routes)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (Must be Admin)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth', 'is_admin'])->name('admin.')->group(function () {

    // Events
    Route::get('/events', [AdminEventController::class, 'index'])->name('events.index');
    Route::post('/events/{event}/approve', [AdminEventController::class, 'approve'])->name('events.approve');
    Route::post('/events/{event}/reject', [AdminEventController::class, 'reject'])->name('events.reject');

    // Categories (This creates admin.categories.index)
    Route::resource('categories', AdminCategoryController::class)->except(['show']);

    // Users
    Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');
});
// Speaker Management
Route::get('/events/{event}/speakers/create', [App\Http\Controllers\EventSpeakerController::class, 'create'])->name('events.speakers.create');
Route::post('/events/{event}/speakers', [App\Http\Controllers\EventSpeakerController::class, 'store'])->name('events.speakers.store');
Route::delete('/speakers/{speaker}', [App\Http\Controllers\EventSpeakerController::class, 'destroy'])->name('events.speakers.destroy');
Route::get('/speakers/{speaker}/edit', [App\Http\Controllers\EventSpeakerController::class, 'edit'])->name('events.speakers.edit');
Route::put('/speakers/{speaker}', [App\Http\Controllers\EventSpeakerController::class, 'update'])->name('events.speakers.update');

/*
|--------------------------------------------------------------------------
| Wildcard Route (Must be LAST)
|--------------------------------------------------------------------------
*/
// This catches /events/1, /events/2, etc.
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');


require __DIR__ . '/auth.php';
