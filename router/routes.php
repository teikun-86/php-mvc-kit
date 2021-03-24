<?php

use App\Controllers\MainController;
use App\Helpers\Route;

function start_routing() {
    Route::get('/', function() {
        return view('index');
    });
    Route::get('/welcome', [MainController::class, 'welcome']);
}

?>