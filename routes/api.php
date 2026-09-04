<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\GuestbookController;
use App\Http\Controllers\ContactMessageController;

Route::get('/guestbook', [GuestbookController::class, 'index']);
Route::post('/guestbook', [GuestbookController::class, 'store']);
Route::post('/guestbook/{id}/like', [GuestbookController::class, 'like']);

Route::post('/contact', [ContactMessageController::class, 'store']);
