<?php
Route::view('/', 'welcome');
Auth::routes();


Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm')->name('login.admin');
Route::get('/login/owner', 'Auth\LoginController@showOwnerLoginForm')->name('login.owner');
Route::get('/login/staff', 'Auth\LoginController@showStaffLoginForm')->name('login.staff');

Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm')->name('register.admin');
Route::get('/register/owner', 'Auth\RegisterController@showOwnerRegisterForm')->name('register.owner');
Route::get('/register/staff', 'Auth\RegisterController@showStaffRegisterForm')->name('register.staff');

Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::post('/login/owner', 'Auth\LoginController@ownerLogin');
Route::post('/login/staff', 'Auth\LoginController@staffLogin');


Route::post('/register/admin', 'Auth\RegisterController@createAdmin')->name('register.admin');
Route::post('/register/owner', 'Auth\RegisterController@createOwner')->name('register.owner');
Route::post('/register/staff', 'Auth\RegisterController@createStaff')->name('register.staff');

Route::view('/home', 'home')->middleware('auth');
Route::get('/table/barang','barangController@dataTable')->name('table.barang');
Route::get('/barang/edit','barangController@dataTable')->name('barang.edit');
Route::get('/barang/delete','barangController@dataTable')->name('barang.destroy');
Route::group(['middleware' => 'auth:admin'], function () {
	Route::get('/admin','barangController@index');
    Route::post('/admin/barang/proses','barangController@proses');
    Route::get('/admin/barang/{id}','barangController@editbarang');
    Route::get('/admin/barang/hapus/{id}','barangController@hapusBarang');
});

Route::group(['middleware' => 'auth:owner'], function () {
    Route::get('/owner','barangController@index');
    Route::post('/owner/barang/proses','barangController@proses');
    Route::get('/owner/barang/{id}','barangController@editbarang');
    Route::get('/owner/barang/hapus/{id}','barangController@hapusBarang');
});

Route::group(['middleware' => 'auth:staff'], function () {
    Route::get('/staff','barangController@index');
    Route::post('/staff/barang/proses','barangController@proses');
    Route::get('/staff/barang/{id}','barangController@editbarang');
    Route::get('/staff/barang/hapus/{id}','barangController@hapusBarang');
});