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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
Route::get('addadmin','GiaovuController@addadmin');
Route::get('login',['as'=>'login.new','uses'=>'Auth\AuthController@getLogin']);
Route::post('login',['as'=>'login.newpost','uses'=>'Auth\AuthController@postLogin']);
// Route::get('test',['middleware'=>'test', 'as'=>'test', function($id){
// 	echo 'test';
// 	echo $id;
// }]);
Route::get('test','GiaovuController@gettest');
Route::post('test','GiaovuController@posttest');


Route::get('importExport', 'DetaiController@importExport');
Route::get('downloadExcel/{type}', 'DetaiController@downloadExcel');
Route::post('importExcel', 'DetaiController@importExcel');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){
	Route::group(['prefix'=>'giaovu'],function(){
		Route::get('addgiaovien',['as'=>'giaovu.addgiaovien','uses'=>'GiaovuController@getaddgiaovien']);
		Route::post('addgiaovien',['as'=>'giaovu.addgiaovienpost','uses'=>'GiaovuController@postaddgiaovien']);
		Route::get('listgiaovien',['as'=>'giaovu.listgiaovien','uses'=>'GiaovuController@getlistgiaovien']);
		Route::get('infogiaovien/{id}',['as'=>'giaovu.infogiaovien','uses'=>'GiaovuController@getinfogiaovien']);


		Route::get('addsinhvien',['as'=>'giaovu.addsinhvien','uses'=>'GiaovuController@getaddsinhvien']);
		Route::post('addsinhvien',['as'=>'giaovu.addsinhvienpost','uses'=>'GiaovuController@postaddsinhvien']);
		Route::get('listsinhvien',['as'=>'giaovu.listsinhvien','uses'=>'GiaovuController@getlistsinhvien']);
		Route::get('infosinhvien/{id}',['as'=>'giaovu.infosinhvien','uses'=>'GiaovuController@getinfosinhvien']);
		Route::get('getbomon',['as'=>'giaovu.getbomon','uses'=>'GiaovuController@getbomon']);
		Route::get('getkhoa',['as'=>'giaovu.getkhoa','uses'=>'GiaovuController@getkhoa']);
		Route::get('xuatbaocaodetai',['as'=>'giaovu.xuatbaocaodetai','uses'=>'GiaovuController@baocaodetai']);
		Route::get('downdetai/{type}',['as'=>'giaovu.downdetai','uses'=>'GiaovuController@downdetai']);
	});

	Route::group(['prefix'=>'giaovien'],function(){
		Route::get('info/{id}',['as'=>'giaovien.info','uses'=>'GiaovienController@getinfo']);
		Route::post('addhnc',['as'=>'giaovien.addhncpost','uses'=>'GiaovienController@postaddhnc']);
		Route::post('edithnc',['as'=>'giaovien.edithnc','uses'=>'GiaovienController@edithnc']);
		Route::post('deletehnc',['as'=>'giaovien.deletehnc','uses'=>'GiaovienController@deletehnc']);
		Route::post('adddetai',['as'=>'giaovien.adddetaipost','uses'=>'GiaovienController@postadddetai']);
		Route::post('editdetai',['as'=>'giaovien.editdetai','uses'=>'GiaovienController@editdetai']);
		Route::post('deletedetai',['as'=>'giaovien.deletedetai','uses'=>'GiaovienController@deletedetai']);
		Route::get('listyeucau',['as'=>'giaovien.listyeucau','uses'=>'GiaovienController@getlistyeucau']);
		Route::post('listyeucau',['as'=>'giaovien.listyeucaupost','uses'=>'GiaovienController@postlistyeucau']);
		Route::get('infosinhvien/{id}',['as'=>'giaovien.infosinhvien','uses'=>'GiaovienController@getinfosinhvien']);
		Route::get('listsinhvien/{id}',['as'=>'giaovien.listsinhvien','uses'=>'GiaovienController@getlistsinhvien']);
	});
  
	Route::group(['prefix'=>'sinhvien'],function(){
		Route::get('info/{id}',['as'=>'sinhvien.info','uses'=>'SinhvienController@getinfo']);
		Route::get('listgiaovien',['as'=>'sinhvien.listgiaovien','uses'=>'SinhvienController@getlistgiaovien']);
		Route::get('adddetai/{id}',['as'=>'sinhvien.adddetai','uses'=>'SinhvienController@getadddetai']);
		Route::post('adddetai/{id}',['as'=>'sinhvien.adddetaipost','uses'=>'SinhvienController@postadddetai']);
		Route::get('infogiaovien/{id}',['as'=>'sinhven.infogiaovien','uses'=>'SinhvienController@getinfogiaovien']);
		Route::get('listhnc',['as'=>'sinhvien.listhnc','uses'=>'SinhvienController@getlisthnc']);
		Route::get('listdetai',['as'=>'sinhvien.listdetai','uses'=>'SinhvienController@getlistdetai']);
	});
});