<?php

use Illuminate\Http\Request;

Route::namespace ("APIs")->group(function () {
    ///// app
    Route::get("cities", "MobileController@cities");
    Route::post("complaint", "MobileController@complaint");
    //// patient
    Route::prefix("patients")->group(function () {
        Route::post("login", "PatientController@login");
        Route::post("register", "PatientController@register");

        Route::post("update", "PatientController@updateAccount");
        Route::get("account", "PatientController@getAccount");
    });


    Route::middleware('auth:client-api')->group(function () {
        Route::get("account", "ClientController@getAccount");
        Route::put("account/update", "ClientController@updateAccount");
        Route::post("order", "ClientController@addOrder");
        Route::post("rate-order/{id}", "ClientController@addRate");
        Route::get("client/orders", "ClientController@showOrders");
        Route::put("account/update", "ClientController@updateAccount");
    });

});
