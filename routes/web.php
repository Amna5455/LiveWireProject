<?php

use App\Http\Controllers\ProfileController;
use App\Http\Livewire\Chat\CreateChatComponent;
use App\Http\Livewire\Chat\MainComponent;
use App\Http\Livewire\User\UserComponent;
use App\Http\Livewire\UserUpdateComponent;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('users')->group(function () {

        Route::get('/',UserComponent::class)->name('user.index');
        Route::get('/edit/{id}',UserUpdateComponent::class)->name('user.edit');
    });
    Route::prefix('chat-users')->group(function () {

        Route::get('/create',CreateChatComponent::class)->name('chat-users.create-user');
        Route::get('/chats',MainComponent::class)->name('chat-users.main');
    });
});


require __DIR__.'/auth.php';
