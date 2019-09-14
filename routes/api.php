<?php
Route::resource('Alert', 'AlertsController');

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

});
