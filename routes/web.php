<?php

use App\Http\Controllers\LessonController;
use Illuminate\Support\Facades\Route;

Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
