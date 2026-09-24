<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\AchievementController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\VisitorController;

// Visitors Tracking & Analytics
Route::post('/visitors/ping', [VisitorController::class, 'ping']);
Route::get('/visitors/stats', [VisitorController::class, 'stats']);

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

// Experiences (Career)
Route::get('/experiences', [ExperienceController::class, 'index']);
Route::get('/experiences/{id}', [ExperienceController::class, 'show']);
Route::post('/experiences', [ExperienceController::class, 'store']);
Route::put('/experiences/{id}', [ExperienceController::class, 'update']);
Route::delete('/experiences/{id}', [ExperienceController::class, 'destroy']);

// Education
Route::get('/education', [EducationController::class, 'index']);
Route::get('/education/{id}', [EducationController::class, 'show']);
Route::post('/education', [EducationController::class, 'store']);
Route::put('/education/{id}', [EducationController::class, 'update']);
Route::delete('/education/{id}', [EducationController::class, 'destroy']);

// Settings & CV Management
use App\Http\Controllers\SettingController;
Route::get('/settings', [SettingController::class, 'index']);
Route::post('/settings', [SettingController::class, 'update']);
Route::post('/settings/upload-cv', [SettingController::class, 'uploadCv']);
Route::get('/cv', [SettingController::class, 'downloadCv']);

