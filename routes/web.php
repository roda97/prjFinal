<?php

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
    return view('index');
});

Route::get('/awardslist', function () {
    return view('awards_view');
});

Route::get('/projectslist', function () {
    return view('projects_view');
});

Route::get('/laboratorieslist', function () {
    return view('labs_view');
});

Route::get('/newslist', function () {
    return view('news_view');
});

Route::get('/userslist','RoleController@getRolesFront');

Route::get('/teamslist','TeamsController@getTeamsFront');

//Route::get('/', 'IndexController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('{path}', 'HomeController@index')->where('path', '([A-z\/_.\d-]+)?');


Auth::routes();

