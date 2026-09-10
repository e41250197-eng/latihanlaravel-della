<?php

use Illuminate\Support\Facades\Route;

// 1. Basic Routing
Route::get('/hello', function () {
    return 'Hello World';
});

// 2. Route Parameters
Route::get('/user/{id}', function ($id) {
    return 'User ID: ' . $id;
});

// 2b. Route Parameters Opsional
Route::get('/user-name/{name?}', function ($name = 'Guest') {
    return 'Hello, ' . $name;
});

// 3. Named Routes
Route::get('/Dashboard', function () {
    return 'Ini Halaman Dashboard';
})->name('Dashboard');

// Rute untuk membuktikan fungsi helper route('Dashboard')
Route::get('/tes-dashboard', function () {
    $url = route('Dashboard');
    return 'URL dari route yang bernama Dashboard adalah: ' . $url;
});
