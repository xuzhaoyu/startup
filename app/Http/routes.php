<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/newIdea', array(
    'as' => 'newIdea',
    'uses' => 'HomeController@getIdea'
));
Route::get('/sort/{column}', array(
    'as' => 'sort',
    'uses' => 'HomeController@getSort'
));
Route::get('/myIdea', array(
    'as' => 'myIdea',
    'uses' => 'HomeController@getMyIdea'
));
Route::get('/graph', array(
    'as' => 'graph',
    'uses' => 'HomeController@getGraph'
));
Route::get('/details/{id}', array(
    'as' => 'details',
    'uses' => 'HomeController@getDetails'
));
Route::get('/like/{id}', array(
    'as' => 'like',
    'uses' => 'HomeController@getLike'
));
Route::get('/myIdea/delete/{id}', array(               // display all entries in the table ip2name
    'as' => 'delete',
    'uses' => 'HomeController@getDelete'
));
Route::get('/myIdea/edit/{id}', array(               // display all entries in the table ip2name
    'as' => 'edit',
    'uses' => 'HomeController@getEdit'
));
Route::post('/newIdea/data', array(
    'as' => 'submit',
    'uses' => 'HomeController@postIdea'
));
Route::post('/myIdea/data', array(
    'as' => 'edited',
    'uses' => 'HomeController@postEdit'
));
Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
