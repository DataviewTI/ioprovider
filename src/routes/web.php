<?php
Route::group(['prefix' => 'admin', 'middleware' => ['web','admin'], 'as' => 'admin.'],function(){
    Route::group(['prefix' => 'provider'], function () {
    Route::get('/','ProviderController@index');
    Route::get('list', 'ProviderController@list');
    Route::get('categories/{id?}', 'ProviderController@categories');
    Route::get('view/{id}', 'ProviderController@view');
    Route::post('create', 'ProviderController@create');
    Route::post('update/{id}', 'ProviderController@update');
    Route::get('toggle-state/{id}', 'ProviderController@toggleState');
    Route::get('delete/{id}', 'ProviderController@delete');			
  });
});
