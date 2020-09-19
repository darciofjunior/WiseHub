<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@create')->name('user.create');
Route::post('/', 'UserController@store')->name('user.store');
Route::get('/enviar_email', 'UserController@enviar_email')->name('user.enviar_email');
Route::get('/senha/{user?}/{email?}', 'UserController@senha')->name('user.senha');
Route::put('/salvar_senha/{id}', 'UserController@salvar_senha')->name('user.salvar_senha');
Route::get('/edit', 'UserController@edit')->name('user.edit');
Route::put('/{id}', 'UserController@update')->name('user.update');
Route::get('/users', 'UserController@users')->name('user.users');

Route::get('/habilidades', function () {
    return view('habilidades.index');
});

Route::get('/locals', function () {
    return view('locals.index');
});

Route::get('/vagas', function () {
    return view('vagas.index');
});

Route::get('/divulgar', 'ControlarVagaController@divulgar')->name('vaga.divulgar');
Route::post('/divulgar', 'ControlarVagaController@atualizar_interesse')->name('vaga.atualizar_interesse');
Route::get('/feedback', 'ControlarVagaController@feedback')->name('vaga.feedback');
Route::get('/feedback_detalhes/{id}', 'ControlarVagaController@feedback_detalhes')->name('vaga.feedback_detalhes');

Auth::routes();

Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');