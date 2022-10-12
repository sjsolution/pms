<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/clear', function () {
    $response = '';
    $response .= 'APP_ENV = ' . getenv('APP_ENV') . '<br/>';
    Artisan::call('config:clear');
    $response .= 'config cleared !<br/>';
    Artisan::call('cache:clear');
    $response .= 'cache cleared !<br/>';
    Artisan::call('view:clear');
    $response .= 'view cleared !<br/>';
    Artisan::call('route:clear');
    $response .= 'route cleared !<br/>';
    return $response;
});

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();
Route::prefix('admin')->middleware(['auth', 'admin'])->namespace('Backend\Admin')->name('admin.')->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::post('/dashboard/show-room', 'DashboardController@getroom')->name('dashboard.getroom');

    //Property Registration
    Route::resource('property', 'PropertyController');
    //property additional Route
    Route::prefix('property')->group(function () {
        Route::post('/bulk-action', 'PropertyController@bulkAction')->name('property.bulk-action');
        Route::get('/{id}/status', 'PropertyController@update_status')->name('property.status');
        Route::post('/store/buildingname', 'PropertyController@store_building')->name('property.building.store');
    });
    //Flattype routes
    Route::resource('flattype', 'FlatTypeController');
    //Room routes
    Route::resource('room', 'RoomController');
    //Property Rental Monthly routes
    Route::resource('propertyrental', 'PropertyRentalController');
    Route::get('propertyrental/{id}/getroom', 'PropertyRentalController@getroom')->name('propertyrental.getroom');
    Route::post('propertyrental/change-bookingstatus', 'PropertyRentalController@changestatus')->name('propertyrental.changestatus');
    Route::get('propertyrental/{id}/pdf', 'PropertyRentalController@pdf')->name('propertyrental.pdf');
    Route::post('propertyrentail/checkout', 'PropertyRentalController@checkout')->name('propertyrental.checkout');

    Route::post('propertyrental-terminate','PropertyRentalController@terminate')->name('propertyrental.terminate');
    Route::post('store/contract-payment', 'PropertyRentalController@storecontractpayment')->name('propertyrental.storecontract');

    //Property Rental Daily basis routes
    Route::resource('propertyrentaldaily', 'PropertyRentalDailyController');



    //Roles And Permission Routes
    Route::get('users/create', 'UserController@create')->name('user.create');
    Route::post('user/store', 'UserController@store')->name('user.store');
    Route::get('users', 'UserController@index')->name('user.index');
    Route::get('user/{id}/edit', 'UserController@edit')->name('user.edit');
    Route::delete('user/{id}/destroy', 'UserController@destroy')->name('user.destroy');

    //Document route
    Route::resource('document', 'DocumentController');


    //Report Routes
    Route::get('period-wise-report', 'ReportController@index')->name('report.index');
    Route::post('search-period-wise', 'ReportController@searchperiod')->name('report.periodwise');

    Route::get('property-status', 'ReportController@propertystatus')->name('report.prostatus');
    Route::post('get-property-status', 'ReportController@getpropertystatus')->name('report.getpropertystatus');

    Route::get('property-wise-report', 'ReportController@propertywise')->name('report.propertywise');
    Route::post('get-property-wise-report', 'ReportController@getpropertywise')->name('report.getpropertywise');

    Route::get('property-receiveabel-status', 'ReportController@receiveable_status')->name('report.receiveable_status');
    Route::post('get-property-receiveabel-status', 'ReportController@getreceiveable_status')->name('report.getreceiveable_status');

    Route::get('payment-report-properties', 'ReportController@paymentproperty')->name('report.paymentproperty');
    Route::post('get-payment-report-properties', 'ReportController@getpaymentproperty')->name('report.getpaymentproperty');
});
