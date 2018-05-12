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
Route::group(['prefix'=>'admin/mdw', 'middleware' => 'auth'], function(){
	Route::get('/',['uses'=>'adminController@index', 'as' =>'admin.index']);
	Route::get('logo',['uses'=>'adminController@logo', 'as' =>'admin.logo']);
	Route::post('logo',['uses'=>'adminController@uploadlogo', 'as' =>'admin.logo.store']);
	Route::post('register',['uses'=>'adminController@register', 'as' =>'admin.register.store']);
	Route::post('edit/{id}',['uses'=>'adminController@edit', 'as' =>'admin.edit.store']);
	Route::delete('delete/{id}',['uses'=>'adminController@delete', 'as' =>'admin.delete.store']);
	Route::get('banner', ['uses'=>'adminController@banner', 'as' =>'admin.banner']);
	Route::post('banner',['uses'=>'adminController@uploadbanner', 'as' =>'admin.banner.store']);
	Route::delete('banner_delete/{id}',['uses'=>'adminController@banner_delete', 'as' =>'admin.banner_delete.store']);
	Route::get('homepage_service', ['uses'=>'adminController@homepage_service', 'as' =>'admin.homepage_service']);
	Route::post('homepage_service',['uses'=>'adminController@homepage_service_post', 'as' =>'admin.homepage_service.store']);
	Route::delete('h_service_delete/{id}',['uses'=>'adminController@h_service_delete', 'as' =>'admin.h_service_delete.store']);
	Route::get('homepage_service_e/{id}',['uses'=>'adminController@homepage_service_e', 'as' =>'admin.homepage_service_edit.edit']);
	Route::post('service_edit/{id}',['uses'=>'adminController@service_edit', 'as' =>'admin.service_edit.store']);
	Route::get('aboutus',['uses'=>'adminController@aboutus', 'as' =>'admin.aboutus']);
	Route::post('aboutus', ['uses'=>'adminController@aboutusupload', 'as' =>'admin.aboutus.store']);
	Route::delete('aboutdelete/{id}', ['uses'=>'adminController@aboutdelete', 'as' =>'admin.aboutdelete.store']);
	Route::get('partners', ['uses'=>'adminController@partners', 'as' =>'admin.partners']);
	Route::post('partners', ['uses'=>'adminController@partnerstore', 'as' =>'admin.partners.store']);
	Route::delete('partners/{id}', ['uses'=>'adminController@partnerdelete', 'as' =>'admin.partner.store']);
	Route::get('contactarea', ['uses'=>'adminController@contactarea', 'as' =>'admin.contactarea']);
	Route::post('contactarea', ['uses'=>'adminController@contactarea_upload', 'as' =>'admin.contactarea.store']);
	Route::post('contactarea/{id}', ['uses'=>'adminController@contactarea_update', 'as' =>'admin.contactarea.update']);
	Route::get('package', ['uses'=>'adminController@package', 'as' =>'admin.package']);
	Route::get('packagecat', ['uses'=>'adminController@packagecat', 'as' =>'admin.packagecat']);
	Route::post('packagecat', ['uses'=>'adminController@packagecatupload', 'as' =>'admin.packagecat.store']);
	Route::delete('packagecat/{id}', ['uses'=>'adminController@packagecatdelete', 'as' =>'admin.packagecat.delete']);
	Route::post('packagecat/{id}', ['uses'=>'adminController@packagecatupdate', 'as' =>'admin.packagecat.update']);
	Route::post('package', ['uses'=>'adminController@packageupload', 'as' =>'admin.package.store']);
	Route::post('package/{id}', ['uses'=>'adminController@packageupdate', 'as' =>'admin.package.update']);
	Route::delete('package/{id}', ['uses'=>'adminController@packagedelete', 'as' =>'admin.package.delete']);
	Route::get('service', ['uses'=>'adminController@service', 'as' =>'admin.service']);
	Route::post('service', ['uses'=>'adminController@serviceupload', 'as' =>'admin.service.store']);
	Route::delete('service/{id}', ['uses'=>'adminController@servicedelete', 'as' =>'admin.service.delete']);
	Route::get('portfolio', ['uses'=>'adminController@portfolio', 'as' =>'admin.portfolio']);
	Route::post('portfolio', ['uses'=>'adminController@portfolioupload', 'as' =>'admin.portfolio.store']);
	Route::delete('portfolio/{id}', ['uses'=>'adminController@portfoliodelete', 'as' =>'admin.portfolio.delete']);
	Route::get('information', ['uses'=>'adminController@information', 'as' =>'admin.information']);
	Route::post('information', ['uses'=>'adminController@info_upload', 'as' =>'admin.information.store']);
	Route::get('skill', ['uses'=>'adminController@skill', 'as' =>'admin.skill']);
	Route::post('skill', ['uses'=>'adminController@skillstore', 'as' =>'admin.skill.store']);
	Route::post('skill/{id}', ['uses'=>'adminController@skillupdate', 'as' =>'admin.skill.update']);
	Route::delete('skill/{id}', ['uses'=>'adminController@skilldelete', 'as' =>'admin.skill.delete']);
	Route::get('team', ['uses'=>'adminController@team', 'as' =>'admin.team']);
	Route::post('team', ['uses'=>'adminController@teampost', 'as' =>'admin.team.post']);
	Route::delete('team/{id}', ['uses'=>'adminController@teamdelete', 'as' =>'admin.team.delete']);
	Route::get('template',['uses'=>'adminController@template', 'as' =>'admin.template']);
	Route::post('template',['uses'=>'adminController@templatepost', 'as' =>'admin.template.post']);
	Route::post('template/{id}',['uses'=>'adminController@templateupdate', 'as' =>'admin.template.update']);
	Route::delete('template/{id}',['uses'=>'adminController@templatedelete', 'as' =>'admin.template.delete']);
	Route::resource('blog','BlogController');
	Route::put('/settings/', 'PostController@settings')->name('post.settings');
	Route::get('/upload/images/' , 'PostController@getImages');
	Route::post('/upload/images/' , 'PostController@storeImages');
	Route::post('/upload/images/delete' , 'PostController@deleteImages');
	Route::delete('signup/{id}',['uses'=>'adminController@signupdelete', 'as' =>'admin.signup.delete']);
});
Route::get('/',['uses'=>'homepageController@index', 'as' =>'homepage.index']);
Route::get('about',['uses'=>'homepageController@about', 'as' =>'homepage.about']);
Route::get('services',['uses'=>'homepageController@services', 'as' =>'homepage.services']);
// Route::get('package',['uses'=>'homepageController@package', 'as' =>'homepage.package']);
// Route::get('templates',['uses'=>'homepageController@templates', 'as' =>'homepage.templates']);
Route::get('portfolio',['uses'=>'homepageController@portfolio', 'as' =>'homepage.portfolio']);
Route::get('contact',['uses'=>'homepageController@contact', 'as' =>'homepage.contact']);
Route::get('Readblog',['uses'=>'homepageController@Readblog', 'as' =>'homepage.Readblog']);
Route::post('contact',['uses'=>'homepageController@contactpost', 'as' =>'homepage.contact.store']);
Route::delete('contact/{id}',['uses'=>'homepageController@contactdelete', 'as' =>'homepage.contact.delete']);
Route::get('reply',['uses'=>'homepageController@reply', 'as' =>'homepage.reply']);
Route::get('template/{id}',['uses'=>'homepageController@templateview', 'as' =>'homepage.templateview.edit']);
Route::get('signup/{id}', ['uses'=>'homepageController@signup', 'as' =>'homepage.signup']);
Route::get('blog/single/{slug}', ['uses'=>'BlogController@single', 'as' =>'blog.single']);
Route::get('blog', ['uses'=>'homepageController@blogread', 'as' =>'blog.read']);
Route::post('signup', ['uses'=>'homepageController@signuppost', 'as' =>'homepage.signup.post']);
Route::get('plainblog',['uses'=>'homepageController@plainblog', 'as' =>'homepage.plainblog']);
#AUTH
Route::get('/admin/login', ['as' => 'login' ,'uses' => 'Auth\LoginController@getLogin'] );
Route::post('/admin/login', 'Auth\LoginController@postLogin')->name('post.login');
Route::get('/admin/logout', 'Auth\LoginController@getLogout')->name('logout');

