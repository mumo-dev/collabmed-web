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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/patients/{department}', 'PatientsController@getPatientsDepartment');
Route::get('/patients/referral/{department}', 'PatientsController@getReferredPatients');
Route::post('/patient/seen/','PatientsController@patienSeen');
Route::post('/referral/record/','PatientsController@patientReferralReport');

Route::group(['prefix'=>'admin', 'middleware'=>['auth','admin']], function(){
    Route::get('/', 'Admin\HomeController@index')->name('admin.home'); 
    Route::get('/accounts', 'Admin\AccountsController@index')->name('admin.accounts'); 
    Route::get('/accounts/create', 'Admin\AccountsController@create')->name('admin.accounts.create'); 
    Route::post('/accounts', 'Admin\AccountsController@store')->name('admin.accounts.store'); 
});

Route::group(['prefix'=>'reception', 'middleware'=>['auth','reception']], function(){
    Route::get('/', 'Reception\HomeController@index')->name('reception.home');   
    Route::get('/patient/create', 'Reception\HomeController@createPatient')->name('reception.patient.create'); 

    Route::post('/patient','Reception\HomeController@storePatient');
    Route::get('/patient/get/{id}','Reception\HomeController@fetchPatient');

    Route::post('/checkin', 'Reception\HomeController@recordVisit');
});

Route::group(['prefix'=>'treatment', 'middleware'=>['auth','treatment']], function(){
    Route::get('/', 'TreatmentController@index')->name('treatment.home');  
    Route::post('/patient/seen','TreatmentController@patienSeen');
    Route::post('/patient/savenotes','TreatmentController@savePatientNotes');
    Route::post('/referral','TreatmentController@saveReferral');
    Route::get('/visit/{id}','TreatmentController@showVisit');
});

Route::group(['prefix'=>'laboratory', 'middleware'=>['auth','laboratory']], function(){
    Route::get('/', 'LaboratoryController@index')->name('lab.home');  
    Route::get('/referrals', 'LaboratoryController@referrals')->name('lab.referrals');
    Route::get('/referrals/{id}', 'LaboratoryController@showReferral');
    Route::get('/visit/{id}','LaboratoryController@showVisit');    
});
