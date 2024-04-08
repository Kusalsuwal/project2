<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AuthenticateMiddleware;


Route::get('/', function () {
    return view('welcome');
});
  
Route::get('/LoginProfile', [HomeController::class, 'LoginProfile'])->name('LoginProfile');
Route::get('/Register', [HomeController::class, 'Register'])->name('Register');
Route::get('/verifymail', [HomeController::class, 'verifymail'])->name('verifymail');
Route::get('/login', [HomeController::class, 'login'])->name('login');
Route::post('/Slogin', [HomeController::class, 'Slogin'])->name('Slogin');
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::get('sendmail', [HomeController::class, 'index'])->name('index');
Route::get('/landingpage', [HomeController::class, 'landingpage'])->name('landingpage');
Route::get('/profile', [HomeController::class, 'profile'])->name('profile');

Route::middleware(['auth.custom'])->group(function () {
Route::get('/Dashboard', [HomeController::class, 'Dashboard'])->name('Dashboard');
Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
Route::get('/Member', [HomeController::class, 'Member'])->name('Member');
Route::get('{id}/edit', [HomeController::class, 'edit'])->name('edit');
Route::get('{id}/view', [HomeController::class, 'view'])->name('view');
Route::get('{id}/delete', [HomeController::class, 'delete'])->name('delete');
Route::put('{id}/update', [HomeController::class, 'update'])->name('update');
Route::get('/restore', [HomeController::class, 'restore'])->name('restore');
Route::post('/restore/{id}', [HomeController::class, 'restores'])->name('restores');
});


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
