<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/', function () {
    return view('welcome');
})->name('password.reset');
