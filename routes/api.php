<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AchievementController;

Route::get('/guestbook', [GuestbookController::class, 'index']);
Route::post('/guestbook', [GuestbookController::class, 'store']);
Route::post('/guestbook/{id}/like', [GuestbookController::class, 'like']);

Route::post('/contact', [ContactMessageController::class, 'store']);

Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);

Route::get('/achievements', [AchievementController::class, 'index']);
