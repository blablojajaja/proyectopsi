<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//rutas de sectores
Route::get('sectors',[SectorController::class, 'index'])->name('sectors.index')->middleware('checkAdmins');
Route::post('sectors',[SectorController::class, 'store'])->name('sectors.store');
Route::get('sectors/create',[SectorController::class, 'create'])->name('sectors.create');
Route::get('sectors/{sector}',[SectorController::class, 'show'])->name('sectors.show');
Route::match(['put', 'patch'],'sectors/{sector}',[SectorController::class, 'update'])->name('sectors.update');
Route::get('sectors/{sector}/edit',[SectorController::class, 'edit'])->name('sectors.edit');
Route::delete('sectors/{sector}',[SectorController::class, 'destroy'])->name('sectors.destroy');
Route::get('sectors/delete/{id}', [SectorController::class, 'delete'])->name('sectors.delete');

//Route::resource('sectors', SectorController::class);

//rutas de categorias
Route::get('categories',[CategoryController::class, 'index'])->name('categories.index')->middleware('checkAdmins');
Route::post('categories',[CategoryController::class, 'store'])->name('categories.store');
Route::get('categories/create',[CategoryController::class, 'create'])->name('categories.create');
Route::get('categories/{category}',[CategoryController::class, 'show'])->name('categories.show');
Route::match(['put', 'patch'],'categories/{category}',[CategoryController::class, 'update'])->name('categories.update');
Route::get('categories/{category}/edit',[CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('categories/{category}',[CategoryController::class, 'destroy'])->name('categories.destroy');
Route::get('categories/delete/{id}', [CategoryController::class, 'delete'])->name('categories.delete');

//Route::resource('categories', CategoryController::class);

//rutas de tickets
Route::get('tickets/user',[TicketController::class, 'indexbyuser'])->name('tickets.user')->middleware('checkEmployee');
Route::get('tickets/history',[TicketController::class, 'historical'])->name('tickets.history')->middleware('checkAdmins');
Route::get('tickets/{ticket}/rate',[TicketController::class, 'rate'])->name('tickets.rate');
Route::post('tickets/{ticket}/grade',[TicketController::class, 'setGrade'])->name('tickets.setGrade');

Route::get('tickets',[TicketController::class, 'index'])->name('tickets.index')->middleware('checkAdmins');
Route::post('tickets',[TicketController::class, 'store'])->name('tickets.store')->middleware('checkEmployee');
Route::get('tickets/create',[TicketController::class, 'create'])->name('tickets.create');
Route::get('tickets/{ticket}',[TicketController::class, 'show'])->name('tickets.show');
Route::match(['put', 'patch'],'tickets/{ticket}',[TicketController::class, 'update'])->name('tickets.update');
Route::get('tickets/{ticket}/edit',[TicketController::class, 'edit'])->name('tickets.edit');

//Route::resource('tickets', TicketController::class);

//rutas de comentarios
Route::get('replies',[ReplyController::class, 'index'])->name('replies.index');
Route::post('replies',[ReplyController::class, 'store'])->name('replies.store');
Route::get('replies/{ticket}',[ReplyController::class, 'create'])->name('replies.create');
Route::get('replies/{reply}',[ReplyController::class, 'show'])->name('replies.show');

//Rutas de usuarios
Route::resource('users', UserController::class)->middleware('checkSuperAdmin');