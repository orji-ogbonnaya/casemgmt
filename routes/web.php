<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file contains all the web routes for this application
|
|
| AUTHOR: ORJI OGBONNAYA ORJI JR
| DATE: 13-07-2019
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/records/create', 'RecordsController@showCreateForm');