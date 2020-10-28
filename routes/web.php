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

Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Auth::routes(['verify'=>true]);
Route::group(['middleware'=>['auth']], function(){
    Route::group(['middleware'=>['role:admin']], function(){
        Route::get('/admin', 'AdminController@index')->name('admin');

        Route::post('users/change/role', 'UsersController@addRole')->name('add.role');
        Route::any('user/delete/role', 'UsersController@deleteRole')->name('delete.role');


    });
    Route::group(['middleware'=>['role:moderator']], function(){
        Route::any('/moderator', 'ModeratorController@index')->name('moderator');
        Route::any('/moderator/verify', 'ModeratorController@verify')->name('user.verify');
        Route::get('/admin/user/{id}','AdminController@show');
        Route::any('/admin/user/{id}/edit','AdminController@edit')->name('admin.edit');

    });
    Route::group(['middleware'=>['user']], function(){
        Route::get('/profile/{id}','ProfileController@profile')->where(['id' => '[0-9]+']);

        Route::patch('/profile/edit','ProfileController@edit')->name("user.edit");
        Route::get('/profile/{id}/skills','UserSkillsController@show')->name("user.skills");
        Route::post('/profile/{id}/skills/add','UserSkillsController@add')->name("user.skillsAdd");
        Route::post('/profile/{id}/skills/edit','UserSkillsController@edit')->name("user.skillsEdit");
        Route::post('/profile/{id}/skills/delete','UserSkillsController@delete')->name("user.skillsDelete");
        Route::post('/profile/image/add','ProfileController@addImage')->name("image.add");



    });

    Route::get('/profile/skills','UserSkillsController@toSkills')->name("user.skills");
    Route::get('/profile','ProfileController@toProfile')->name('profile');
    Route::get('/profile/{id}/skills','UserSkillsController@show')->name("user.skills");
    Route::any('users', 'UsersController@show')->name('users');
    Route::any('users/search', 'UsersController@search')->name('users.search');
    Route::get('/home', 'ProfileController@toProfile')->name('profile');
});




