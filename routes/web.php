<?php

use App\User;
use App\Models\Favourite;
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
    return view('welcome');
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
    // region
    Route::resource('region', 'Backend\RegionController');
    Route::get('regionEdit/{id}', 'Backend\RegionController@regionEdit');
    // group
    Route::resource('chatroom', 'Backend\ChatRoomDetailsController');
    Route::get('chatroomEdit/{id}', 'Backend\ChatRoomDetailsController@chatroomEdit');

    // promocode
    Route::resource('promocode', 'Backend\PromoCodeController');
    Route::post('custom', 'Backend\PromoCodeController@customCode')->name('custom');
    Route::post('exportCSV', 'Backend\PromoCodeController@exportCSV');
    Route::post('exportXL', 'Backend\PromoCodeController@exportXL');

    // Announcement
    Route::resource('announcement', 'Backend\AnnouncementController');
    Route::get('announcementEdit/{id}', 'Backend\AnnouncementController@announcementEdit');
    Route::get('announcements', 'Backend\AnnouncementController@announcementList')->name('announcement.list');

});


