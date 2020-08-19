<?php

Route::get('/', function () {
    return view('phonebook');
});
Route::get('/phonebook{name}',function(){
	return redirect('/');
})->where('name','[A-Za-z]+');

Route::resource('phonebook','PhonebookController');
Route::post('getData','PhonebookController@getData');
Route::get('getOne/{id}','PhonebookController@getOne');

