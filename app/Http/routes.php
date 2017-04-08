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
Route::get('importExport', 'DetaiController@importExport');
Route::get('downloadExcel/{type}', 'DetaiController@downloadExcel');
Route::post('importExcel', 'DetaiController@importExcel');
Route::post('SVimport', 'DetaiController@SVimport');

Route::group(['prefix'=>'admin','middleware'=>'auth'],function(){

	Route::get('listpost',['as'=>'admin.listpost','uses'=>'PostController@listPost']);
	Route::get('infopost',['as'=>'admin.infopost','uses'=>'PostController@infoPost']);

	Route::group(['prefix'=>'giaovu','middleware'=>'checkadmin'],function(){
		Route::get('addgiaovien',['as'=>'giaovu.addgiaovien','uses'=>'GiaovuController@getaddgiaovien']);
		Route::post('addgiaovien',['as'=>'giaovu.addgiaovienpost','uses'=>'GiaovuController@postaddgiaovien']);
		Route::get('listgiaovien',['as'=>'giaovu.listgiaovien','uses'=>'GiaovuController@getlistgiaovien']);
		Route::get('infogiaovien/{id}',['as'=>'giaovu.infogiaovien','uses'=>'GiaovuController@getinfogiaovien']);
		Route::get('baocaogiaovien',['as'=>'giaovu.baocaogiaovien','uses'=>'GiaovuController@postBaocaoGV']);
		Route::get('excelgiaovien/{data}',['as'=>'giaovu.excelgiaovien','uses'=>'GiaovuController@downloadExcelGiaovien']);
		Route::get('chartgiaovien',['as'=>'giaovu.chartgiaovien','uses'=>'GiaovuController@getchartgiaovien']);

		Route::get('addsinhvien',['as'=>'giaovu.addsinhvien','uses'=>'GiaovuController@getaddsinhvien']);
		Route::post('addsinhvien',['as'=>'giaovu.addsinhvienpost','uses'=>'GiaovuController@postaddsinhvien']);
		Route::get('listsinhvien',['as'=>'giaovu.listsinhvien','uses'=>'GiaovuController@getlistsinhvien']);
		Route::get('infosinhvien/{id}',['as'=>'giaovu.infosinhvien','uses'=>'GiaovuController@getinfosinhvien']);
		Route::get('baocaosinhvien',['as'=>'giaovu.baocaosinhvien','uses'=>'GiaovuController@postBaocaoSV']);
		Route::get('excelsinhvien/{data}',['as'=>'giaovu.excelsinhvien','uses'=>'GiaovuController@downloadExcelSinhvien']);

		Route::get('xuatbaocaodetai',['as'=>'giaovu.xuatbaocaodetai','uses'=>'GiaovuController@baocaodetai']);
		Route::get('downdetai/{type}',['as'=>'giaovu.downdetai','uses'=>'GiaovuController@downdetai']);
		Route::get('chart',['as'=>'giaovu.chart','uses'=>'GiaovuController@getchart']);
		Route::get('settime',['as'=>'giaovu.settime','uses'=>'ThoigianController@getSetTime']);
		Route::post('settime',['as'=>'giaovu.postsettime','uses'=>'ThoigianController@postSetTime']);
		Route::get('crawlerdata',['as'=>'giaovu.crawlerdata','uses'=>'GiaovuController@getCrawler']);
		Route::post('sendemailsv',['as'=>'giaovu.sendemailsv','uses'=>'GiaovuController@sendEmailSV']);

		Route::get('addpost',['as'=>'giaovu.getaddpost','uses'=>'PostController@getaddPost']);
		Route::post('addpost',['as'=>'giaovu.postaddpost','uses'=>'PostController@postaddPost']);
		Route::get('listpost',['as'=>'giaovu.listpost','uses'=>'PostController@listPost']);
		Route::get('infopost',['as'=>'giaovu.infopost','uses'=>'PostController@infoPost']);
		Route::get('editpost',['as'=>'giaovu.geteditpost','uses'=>'PostController@geteditPost']);
		Route::post('editpost',['as'=>'giaovu.posteditpost','uses'=>'PostController@posteditPost']);
		Route::get('deletepost',['as'=>'giaovu.deletepost','uses'=>'PostController@deletePost']);

	});

	Route::group(['prefix'=>'giaovien','middleware'=>'checkgiaovien'],function(){
		Route::get('info',['as'=>'giaovien.info','uses'=>'GiaovienController@getinfo']);
		Route::post('addhnc',['as'=>'giaovien.addhncpost','uses'=>'GiaovienController@postaddhnc']);
		Route::post('edithnc',['as'=>'giaovien.edithnc','uses'=>'GiaovienController@edithnc']);
		Route::post('deletehnc',['as'=>'giaovien.deletehnc','uses'=>'GiaovienController@deletehnc']);
		Route::post('adddetai',['as'=>'giaovien.adddetaipost','uses'=>'GiaovienController@postadddetai']);
		Route::post('editdetai',['as'=>'giaovien.editdetai','uses'=>'GiaovienController@editdetai']);
		Route::post('deletedetai',['as'=>'giaovien.deletedetai','uses'=>'GiaovienController@deletedetai']);
		Route::get('listyeucau',['as'=>'giaovien.listyeucau','uses'=>'GiaovienController@getlistyeucau']);
		Route::post('listyeucau',['as'=>'giaovien.listyeucaupost','middleware'=>'checktime','uses'=>'GiaovienController@postlistyeucau']);
		Route::get('infosinhvien/{id}',['as'=>'giaovien.infosinhvien','uses'=>'GiaovienController@getinfosinhvien']);
		Route::get('listsinhvien',['as'=>'giaovien.listsinhvien','uses'=>'GiaovienController@getlistsinhvien']);
		Route::get('changeinfo',['as'=>'giaovien.changeinfo','uses'=>'GiaovienController@getchangeinfo']);
		Route::post('changeinfo',['as'=>'giaovien.postchangeinfo','uses'=>'GiaovienController@postchangeinfo']);

		Route::get('listlichhen',['as'=>'giaovien.listlichhen','uses'=>'GiaovienController@getlistlichhen']);
		Route::get('editlichhen/{id}',['as'=>'giaovien.geteditlichhen','uses'=>'GiaovienController@geteditlichhen']);
		Route::post('editlichhen/{id}',['as'=>'giaovien.posteditlichhen','uses'=>'GiaovienController@posteditlichhen']);
		Route::get('addlichhen/{id}',['as'=>'giaovien.addlichhen','uses'=>'GiaovienController@addlichhen']);
		Route::post('addlichhen/{id}',['as'=>'giaovien.postaddlichhen','uses'=>'GiaovienController@postaddlichhen']);
		Route::get('deletelichhen/{id}',['as'=>'giaovien.deletelichhen','uses'=>'GiaovienController@deletelichhen']);

		
	});
  
	Route::group(['prefix'=>'sinhvien','middleware'=>'checksinhvien'],function(){
		Route::get('info',['as'=>'sinhvien.info','uses'=>'SinhvienController@getinfo']);
		Route::get('listgiaovien',['as'=>'sinhvien.listgiaovien','uses'=>'SinhvienController@getlistgiaovien']);
		Route::get('adddetai/{id}',['as'=>'sinhvien.adddetai','middleware'=>'checktime','uses'=>'SinhvienController@getadddetai']);
		Route::post('adddetai/{id}',['as'=>'sinhvien.adddetaipost','middleware'=>'checktime','uses'=>'SinhvienController@postadddetai']);
		Route::get('infogiaovien/{id}',['as'=>'sinhvien.infogiaovien','uses'=>'SinhvienController@getinfogiaovien']);
		Route::get('listhnc',['as'=>'sinhvien.listhnc','uses'=>'SinhvienController@getlisthnc']);
		Route::get('listdetai',['as'=>'sinhvien.listdetai','uses'=>'SinhvienController@getlistdetai']);

		Route::post('editdetai',['as'=>'sinvien.editdetai','middleware'=>'checktime','uses'=>'SinhvienController@posteditdetai']);
		Route::post('deletedetai',['as'=>'sinhvien.deletedetai','middleware'=>'checktime','uses'=>'SinhvienController@deletedetai']);

		Route::get('changeinfo',['as'=>'sinhvien.changeinfo','uses'=>'SinhvienController@getchangeinfo']);
		Route::post('changeinfo',['as'=>'sinhvien.postchangeinfo','uses'=>'SinhvienController@postchangeinfo']);

		Route::get('listlichhen',['as'=>'sinhvien.listlichhen','uses'=>'SinhvienController@getlistlichhen']);
		Route::get('addlichhen/{id}',['as'=>'sinhvien.addlichhen','uses'=>'SinhvienController@addlichhen']);
		Route::post('addlichhen/{id}',['as'=>'sinhvien.postaddlichhen','uses'=>'SinhvienController@postaddlichhen']);
		Route::get('editlichhen/{id}',['as'=>'sinhvien.geteditlichhen','uses'=>'SinhvienController@geteditlichhen']);
		Route::post('editlichhen/{id}',['as'=>'sinhvien.posteditlichhen','uses'=>'SinhvienController@posteditlichhen']);
		Route::get('deletelichhen/{id}',['as'=>'sinhvien.deletelichhen','uses'=>'SinhvienController@deletelichhen']);
	});


});