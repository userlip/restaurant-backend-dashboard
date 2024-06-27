<?php

use App\Filament\Auth\Login;
use App\Livewire\Home;
use App\Livewire\Post\Show as PostShow;
use App\Livewire\WebsiteThemePreview;
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

// Route::get('/', Home::class)->name('home');
// Route::get('/article/{post:slug}', PostShow::class)->name('post.show');
//Route::get('/', \App\Livewire\Template::class);
Route::get('/', \App\Livewire\WebsitePageRenderContent::class);
Route::get('/preview/{website:uuid}', WebsiteThemePreview::class)->name('website-theme-preview');
