<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AdminAuthController;

// Admin Auth
Route::post('/admin/login', [AdminAuthController::class, 'login']);

// Guestbook
Route::get('/guestbook', [GuestbookController::class, 'index']);
Route::post('/guestbook', [GuestbookController::class, 'store']);
Route::post('/guestbook/{id}/like', [GuestbookController::class, 'like']);

// Contact
Route::post('/contact', [ContactMessageController::class, 'store']);

// Projects
Route::get('/projects', [ProjectController::class, 'index']);
Route::get('/projects/{slug}', [ProjectController::class, 'show']);
Route::post('/projects', [ProjectController::class, 'store']);
Route::put('/projects/{id}', [ProjectController::class, 'update']);
Route::delete('/projects/{id}', [ProjectController::class, 'destroy']);

// Achievements
Route::get('/achievements', [AchievementController::class, 'index']);
Route::post('/achievements', [AchievementController::class, 'store']);
Route::put('/achievements/{id}', [AchievementController::class, 'update']);
Route::delete('/achievements/{id}', [AchievementController::class, 'destroy']);
