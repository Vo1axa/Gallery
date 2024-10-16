<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

/* AUTH, LOGIN/REGISTER */
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

/* RESOURCE ROUTES */
Route::resource('galleries', GalleryController::class);
Route::resource('albums', AlbumController::class);

/* MIDDLEWARE PROTECTED ROUTES */
Route::middleware(['auth', 'nocache'])->group(function () {
    /* GALLERY CRUD */
    Route::get('/galleries/{gallery}/edit', [GalleryController::class, 'edit'])->name('galleries.edit');
    Route::put('/galleries/{gallery}', [GalleryController::class, 'update'])->name('galleries.update');
    Route::delete('/galleries/{gallery}', [GalleryController::class, 'destroy'])->name('galleries.destroy');
    Route::post('/galleries', [GalleryController::class, 'store'])->name('galleries.store');
    Route::get('/galleries/create', [GalleryController::class, 'create'])->name('galleries.create');
    Route::get('galleries/download/{id}', [GalleryController::class, 'download'])->name('galleries.download');

    /* PROFILE */
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');

    /* LIKE & COMMENTS */
    Route::post('/galleries/{gallery}/like', [LikeController::class, 'toggleLike'])->name('galleries.like');
    Route::post('/galleries/{gallery}/comments', [CommentController::class, 'store'])->name('galleries.comment');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');

    /* ALBUM CRUD */
    Route::post('/albums/{album}/save', [AlbumController::class, 'saveToAlbum'])->name('albums.saveToAlbum');
    Route::post('/albums/{album}/removeGallery', [AlbumController::class, 'removeGallery'])->name('albums.removeGallery');
    Route::get('/albums/{album}/edit', [AlbumController::class, 'edit'])->name('albums.edit');
    Route::put('/albums/{album}', [AlbumController::class, 'update'])->name('albums.update'); // Ensure PUT for update
    Route::get('/albums/{album}', [AlbumController::class, 'show'])->name('albums.show'); // Correct route for showing album
});

/* ADMIN ROUTES */
Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
   /* USER MANAGEMENT */
    Route::get('/admin/users', [AdminController::class, 'manageUsers'])->name('admin.users');
    Route::patch('/admin/users/{user}', [AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.delete');
    
    /* GALLERY MANAGEMENT */
    Route::get('/admin/galleries', [GalleryController::class, 'adminIndex'])->name('admin.galleries.index');
    Route::get('/admin/galleries/{gallery}/edit', [GalleryController::class, 'adminEdit'])->name('admin.galleries.edit');
    Route::put('/admin/galleries/{gallery}', [GalleryController::class, 'adminUpdate'])->name('admin.galleries.update');
    Route::delete('/admin/galleries/{gallery}', [GalleryController::class, 'adminDestroy'])->name('admin.galleries.destroy');
    
    /* ALBUM MANAGEMENT */
    Route::get('/admin/albums', [AlbumController::class, 'adminIndex'])->name('admin.albums.index');
    Route::get('admin/albums/{album}/images', [AlbumController::class, 'showAlbumImages'])->name('admin.albums.images');
    Route::get('/admin/albums/{album}/edit', [AlbumController::class, 'adminEdit'])->name('admin.albums.edit');
    Route::put('/admin/albums/{album}', [AlbumController::class, 'adminUpdate'])->name('admin.albums.update');
    Route::delete('/admin/albums/{album}', [AlbumController::class, 'adminDestroy'])->name('admin.albums.destroy');
});
