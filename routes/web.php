<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',

//     'verified',
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->get('/dashboard', function () {

    if (Auth::user()->is_admin == 1) {
        return "hello admin";
    }
    return view('dashboard');
})->name('dashboard');


Route::middleware(['auth', 'adminrole'])->group(function () {
    Route::get('/admin-dashboard', function () {
        return "hello admin";
    });
});

Route::get('/profile', function () {
    return  "profile page";
})->middleware('auth');
