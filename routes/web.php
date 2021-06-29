<?php

use App\Http\Controllers\Conversations\ConversationController;
use App\Http\Livewire\Profile;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth:sanctum'], static function () {
    Route::get('/dashboard', [ConversationController::class, 'index'])->name('dashboard');
    Route::get('/profile/{user:username}', Profile::class)->name('profile');
    Route::get('/dashboard/create', [ConversationController::class, 'create'])->name('conversations.create');
    Route::get('/dashboard/{conversation:uuid}', [ConversationController::class, 'show'])->name('conversations.show');
});
