<?php

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
    return redirect('/filmes');
});



Route::get('/filmes', 'FilmesController@index', function () {
    return view('filmes.index');
})->middleware(['auth'])->name('filmes.index');
Route::get('/favoritos', 'FilmesController@favoritos', function () {
    return view('filmes.index');
})->middleware(['auth'])->name('filmes.index');

Route::get('/import', 'FilmesController@import')->middleware('auth')->name('filmes.import');
Route::get('/importgenre', 'FilmesController@importgenre')->middleware('auth')->name('filmes.importgenre');
Route::get('/filme/{filme}', 'FilmesController@show')->middleware('auth')->name('filmes.show');
Route::get('/favorito/{filmeid}/{userid}', 'FilmesController@favorito')->middleware('auth')->name('filmes.favorito');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->middleware('auth')
                ->name('logout');

require __DIR__.'/auth.php';

