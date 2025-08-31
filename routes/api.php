<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Middleware\{CanRolePermissions, RBAC};

use App\Http\Controllers\{
    EmailVerificationController,
    UserController,
    TagController,
    AuthorsController,
    CategoryController,
    CommentsController,
    PartnersController,
    SocialMediaController,
    ArticlesController,
    AboutController,
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

    Route::get('/authors', [AuthorsController::class, 'index']);
    Route::post('/authors', [AuthorsController::class, 'store']);
    Route::get('/authors/{author_id}', [AuthorsController::class, 'show']);
    Route::put('/authors/{author_id}', [AuthorsController::class, 'update']);
    Route::delete('/authors/{author_id}', [AuthorsController::class, 'destroy']);

    Route::get('/categories', [CategoryController::class, 'index']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{category_id}', [CategoryController::class, 'show']);
    Route::put('/categories/{category_id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{category_id}', [CategoryController::class, 'destroy']);

    Route::get('/comments', [CommentsController::class, 'index']);
    Route::post('/comments', [CommentsController::class, 'store']);
    Route::get('/comments/{comment_id}', [CommentsController::class, 'show']);
    Route::put('/comments/{comment_id}', [CommentsController::class, 'update']);
    Route::delete('/comments/{comment_id}', [CommentsController::class, 'destroy']);

    Route::get('/partners', [PartnersController::class, 'index']);
    Route::post('/partners', [PartnersController::class, 'store']);
    Route::get('/partners/{partner_id}', [PartnersController::class, 'show']);
    Route::put('/partners/{partner_id}', [PartnersController::class, 'update']);
    Route::delete('/partners/{partner_id}', [PartnersController::class, 'destroy']);

    Route::get('/social-media', [SocialMediaController::class, 'index']);
    Route::post('/social-media', [SocialMediaController::class, 'store']);
    Route::get('/social-media/{social_media_id}', [SocialMediaController::class, 'show']);
    Route::put('/social-media/{social_media_id}', [SocialMediaController::class, 'update']);
    Route::delete('/social-media/{social_media_id}', [SocialMediaController::class, 'destroy']);

    Route::get('/articles', [ArticlesController::class, 'index']);
    Route::post('/articles', [ArticlesController::class, 'store']);
    Route::get('/articles/{article_id}', [ArticlesController::class, 'show']);
    Route::put('/articles/{article_id}', [ArticlesController::class, 'update']);
    Route::delete('/articles/{article_id}', [ArticlesController::class, 'destroy']);

    Route::get('/abouts', [AboutController::class, 'index']);
    Route::post('/abouts', [AboutController::class, 'store']);
    Route::get('/abouts/{about_id}', [AboutController::class, 'show']);
    Route::put('/abouts/{about_id}', [AboutController::class, 'update']);
    Route::delete('/abouts/{about_id}', [AboutController::class, 'destroy']);
})->middleware(['auth:api', RBAC::class]);

Route::apiResource('/application/users', UserController::class);
