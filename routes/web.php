<?php

// ПОказываем главную страницу
Route::get('/', 'UrlController@index');

// маршрут к UrlController
Route::resource('urls', 'UrlController')->names('urls');

// Маршрут к методу переадресация с короткого на длинный URL
Route::get('{path}', 'UrlController@shortenLink')->name('shorten.link');