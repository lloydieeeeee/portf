<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PortfolioController;

Route::get('/', [
    PortfolioController::class, 'index'
])->name('home');

Route::get('/projects/{slug}', [
    PortfolioController::class, 'show'
])->name('projects.show');