<?php
Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/login/client', 'Auth\LoginController@showClientLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');
Route::get('/register/client', 'Auth\RegisterController@showClientRegisterForm');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/client', 'Auth\LoginController@clientLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');
Route::post('/register/client', 'Auth\RegisterController@createClient');

Route::view('/home', 'home')->middleware('auth');
Route::view('/admin', 'admin');
Route::view('/client', 'client');

Route::get('logout', 'Auth\LoginController@logout');


//Tickets Route


Route::get('new_ticket','TicketsController@create');
Route::post('new_ticket', 'TicketsController@store');

Route::get('update_ticket', 'TicketsController@update'); //admin only
Route::get('show_ticket', 'TicketsController@show'); //admin only


Route::get('view_ticket', 'TicketsController@view');


Route::post('/update/{id}', 'TicketsController@update');


Route::get('/ticket/detail/{slug}', 'TicketsController@showTicketDetail')->name('ticket.detail');
Route::get('/ticket/status/{slug}', 'TicketsController@viewTicketDetail')->name('ticket.status');
