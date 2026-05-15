<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'storeContact'])->name('contact.store');

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function (): void {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/about', [AdminController::class, 'updateAbout'])->name('about.update');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::patch('/services/{service}/toggle', [AdminController::class, 'toggleService'])->name('services.toggle');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::patch('/applications/{application}/status', [AdminController::class, 'updateApplicationStatus'])->name('applications.status');
    Route::patch('/messages/{message}/read', [AdminController::class, 'markMessageRead'])->name('messages.read');
});
