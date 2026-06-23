<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;


// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

// Admin Controllers
use App\Http\Controllers\Auth\DashboardController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\ClassSessionController;
use App\Http\Controllers\Admin\MembershipPlanController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\SettingsController;

// Public controllers
use App\Http\Controllers\PublicApi\ClassController as PublicClassController;
use App\Http\Controllers\PublicApi\TrainerController as PublicTrainerController;
use App\Http\Controllers\PublicApi\PricingController as PublicPricingController;
use App\Http\Controllers\PublicApi\BlogController as PublicBlogController;
use App\Http\Controllers\PublicApi\ContactController;
use App\Http\Controllers\PublicApi\SettingsController as PublicSettingsController;


// Public api Routes (no authentication)

Route::prefix('v1')->group(function(){
    // Authentication
    Route::post('auth/login',[AuthController::class, 'login'])->middleware('throttle:5,1');

    // Public endpoints
    Route::get('classes', [PublicClassController::class, 'index']);
    Route::get('trainers',[PublicTrainerController::class, 'index']);
    Route::get('pricing', [PublicPricingController::class, 'index']);
    Route::get('blogs', [PublicBlogController::class, 'index']);
    Route::get('blogs/{slug}', [PublicBlogController::class, 'show']);
    Route::post('contact', [ContactController::class, 'store']);
    Route::get('settings', [PublicSettingsController::class, 'index']);
});


// Protected Api Routes
Route::prefix('v1')->middleware(['auth:sanctum'])->group(function (){
    // Auth
    Route::post('auth/logout',[AuthController::class, 'logout']);
    Route::get('auth/me',[AuthController::class, 'me']);

    // Admin routes
    Route::prefix('admin')->middleware('admin')->group(function (){
        // Dashboard
        Route::get('dashboard/stats', [DashboardController::class, 'stats']);
        // Members
        Route::apiResource('members',MemberController::class);
        // Trainers
        Route::apiResource('trainers',TrainerController::class);
        // Classes
        Route::apiResource('classes',ClassSessionController::class);
        // Pricing/membership Plans
        Route::apiResource('pricing', MembershipPlanController::class);
        // Blog
        Route::apiResource('blog', BlogController::class);
        // Messages
        Route::get('messages', [MessageController::class, 'index']);
        Route::get('messages/{id}',[MessageController::class, 'show']);
        Route::patch('messages/{id}/read',[MessageController::class, 'marklAsRead']);
        Route::patch('messages/{id}/unread',[MessageController::class, 'marklAsUnread']);
        Route::delete('messages/{id}',[MessageController::class, 'destroy']);

        // Settings
        Route::get('settings',[SettingsController::class, 'index']);
        Route::put('settings',[SettingsController::class,'update']);
    });
});
