<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate;

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



Auth::routes();
Route::get('/', function(){
    return redirect('dashboard/main');
});

Route::prefix('dashboard')->middleware(['auth'])->group(function(){
 Route::get('/main', 'HomeController@index')->name('home');
 Route::get('/update/userinfo','userController@showUserUpdateForm')->name('updateUserInfo');
 Route::put('/update/userinfo','userController@updateUserInfo')->name('updateUserInfo');
 Route::get('/new/task','taskController@showNewTaskForm')->name('newTask');
 Route::post('/new/task','taskController@createNewTask')->name('createNewTask');
 Route::post('/edit/task/{id}', 'taskController@showEditTaskForm')->name('showEditTaskForm');
 Route::put('/edit/task/{id}','taskController@updateTask')->name('updateTask');
 Route::delete('/delete/task','taskController@deleteTask')->name('deleteTask');
});


