<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\{CanRolePermissions, RBAC};

use App\Http\Controllers\{
    EmailVerificationController,
    UserController,
    TagController,
};




Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::prefix('/auth')->group( function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword']);
    Route::post('/check-user-token', [AuthController::class, 'checkUserToken']);
    Route::post('/update-your-self', [AuthController::class, 'updateYourself']);
})->middleware(['auth:api', RBAC::class]);


Route::post('/email-verification', [EmailVerificationController::class, 'sendEmailVerification']);
Route::post('/check-email-verification', [EmailVerificationController::class, 'checkEmailVerification']);


Route::prefix('/application')->group( function (): void {
    // Route::apiResource('/tags', TagController::class);

    Route::get('/tags', [TagController::class, 'index']);
    Route::post('/tags', [TagController::class, 'store']);
    Route::get('/tags/{tag_id}', [TagController::class, 'show']);
    Route::put('/tags/{tag_id}', [TagController::class, 'update']);
    Route::delete('/tags/{tag_id}', [TagController::class, 'destroy']);
})->middleware(['auth:api', RBAC::class]);

Route::apiResource('/application/users', UserController::class);










