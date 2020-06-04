<?php

use Illuminate\Http\Request;

// Route::namespace ("APIs")->group(function () {
//     ///// app
//     Route::get("cities", "MobileController@cities");
//     Route::post("complaint", "MobileController@complaint");
//     //// patient
//     Route::prefix("patients")->group(function () {
//         Route::post("login", "PatientController@login");
//         Route::post("register", "PatientController@register");

//         Route::put("update", "PatientController@updateAccount");
//         Route::get("account", "PatientController@getAccount");
//     });


//     Route::middleware('auth:client-api')->group(function () {
//         Route::get("account", "ClientController@getAccount");
//         Route::put("account/update", "ClientController@updateAccount");
//         Route::post("order", "ClientController@addOrder");
//         Route::post("rate-order/{id}", "ClientController@addRate");
//         Route::get("client/orders", "ClientController@showOrders");
//         Route::put("account/update", "ClientController@updateAccount");
//     });

// });
Route::prefix("hospital")->group(function () { 
    Route::post('register', 'HospitalController@store');
    Route::post("login", "HospitalController@login");
   
    Route::get('info', 'HospitalController@getAccount');
    Route::put('update', 'HospitalController@update');
    Route::get('search', 'HospitalController@search');

});

Route::prefix("admin")->group(function () { 
    Route::get('/', 'AdminController@index');
    Route::post("login", "AdminController@login");
    Route::put('approve-hospital/{id}', 'AdminController@approveHospital');
});