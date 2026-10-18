<?php

use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home')->name('home');

Route::get('/portfolios', [PortfolioController::class, 'index'])->name('portfolios.index');
Route::get('/portfolios/create', [PortfolioController::class, 'create'])->name('portfolios.create');
Route::post('/portfolios', [PortfolioController::class, 'store'])->name('portfolios.store');
Route::get('/portfolios/{portfolio}/edit', [PortfolioController::class, 'edit'])->name('portfolios.edit');
Route::put('/portfolios/{portfolio}', [PortfolioController::class, 'update'])->name('portfolios.update');
Route::delete('/portfolios/{portfolio}', [PortfolioController::class, 'destroy'])->name('portfolios.destroy');
Route::get('/portfolios/{portfolio}/templates', [PortfolioController::class, 'templates'])->name('portfolios.templates');
Route::post('/portfolios/{portfolio}/templates', [PortfolioController::class, 'selectTemplate'])->name('portfolios.select');
Route::get('/portfolios/{portfolio}/preview', [PortfolioController::class, 'preview'])->name('portfolios.preview');
