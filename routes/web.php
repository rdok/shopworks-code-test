<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('staff_shift', 'StaffShiftController', ['only' => 'index']);
