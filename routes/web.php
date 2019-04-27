<?php

use App\User;
use Illuminate\Http\Request;

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// admin route for dashboard
Route::prefix('admin')->group(function () {
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/', 'AdminController@index')->name('admin.dashboard');
    Route::get('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

    Route::resource('users', 'UserController');
    Route::get('userShowModal/{id}', 'UserController@userShowModal');
    Route::get('userEditModal/{id}', 'UserController@userEditModal');

    // faculty
    Route::resource('faculty', 'Backend\FacultyController');
    Route::get('editFaculty/{id}', 'Backend\FacultyController@editFaculty')->name('editFaculty');
    
    // course
    Route::resource('course', 'Backend\CourseController');
    Route::get('editCourse/{id}', 'Backend\CourseController@editCourse');

    // time slot
    Route::resource('timeslot', 'Backend\TimeSlotController');
    Route::get('editTimeSlot/{id}', 'Backend\TimeSlotController@editTimeSlot');

    // semester
    Route::resource('semester', 'Backend\SemesterController');
    Route::get('editSemester/{id}', 'Backend\SemesterController@editSemester');

    // classroom
    Route::resource('classroom', 'Backend\ClassRoomController');
    Route::get('editClassRoom/{id}', 'Backend\ClassRoomController@editClassRoom');


});


