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
    Route::get('/reports', 'Admin\HomeController@reports')->name('admin.reports'); 
    Route::get('/accounts', 'Admin\AccountsController@index')->name('admin.accounts'); 
    Route::get('/accounts/create', 'Admin\AccountsController@create')->name('admin.accounts.create'); 
    Route::post('/accounts', 'Admin\AccountsController@store')->name('admin.accounts.store'); 

    Route::get('/reports/patient/{id}', 'Admin\HomeController@fetchReport');
    Route::get('/reports/{id}', 'Admin\HomeController@showReport');
    Route::get('/reports/all/visits', 'Admin\HomeController@allVisits' );
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


Route::group(['prefix'=>'optical', 'middleware'=>['auth','optical']], function(){
    Route::get('/', 'OpticalController@index')->name('optical.home');  
    Route::get('/referrals', 'OpticalController@referrals')->name('optical.referrals');
    Route::get('/referrals/{id}', 'OpticalController@showReferral');
    Route::get('/visit/{id}','OpticalController@showVisit');    
});

Route::group(['prefix'=>'nursing', 'middleware'=>['auth','nursing']], function(){
    Route::get('/', 'NursingController@index')->name('nursing.home');  
    Route::get('/referrals', 'NursingController@referrals')->name('nursing.referrals');
    Route::get('/referrals/{id}', 'NursingController@showReferral');
    Route::get('/visit/{id}','NursingController@showVisit');    
});

Route::group(['prefix'=>'radiology', 'middleware'=>['auth','radiology']], function(){
    Route::get('/', 'RadiologyController@index')->name('radiology.home');  
    Route::get('/referrals', 'RadiologyController@referrals')->name('radiology.referrals');
    Route::get('/referrals/{id}', 'RadiologyController@showReferral');
    Route::get('/visit/{id}','RadiologyController@showVisit');    
});
