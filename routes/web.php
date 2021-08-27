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

Route::get('/example', function(){
    return view('example');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/authorize', function(){
    return view('/vendor/passport/authorize');
});

Route::get('/get_access_token', function() {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/blog/public/oauth/token', [
        'form_params'=> [
            'grant_type'=>'password',
            'client_id'=>'7',
            'client_secret'=>'usXPoOFfUXYqYiKW2yiMtVD3uZmsV9ve4sGr52W8',
            'username' => 'andrewoshodin@gmail.com',
            'password' => 'usifoh123',
            'scope' => '',
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

Route::get('/redirect', function() {
    $query = http_build_query([
        'client_id' => '7',
        'redirect_uri' => 'http://localhost/blog/public/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost/blog/public/oauth/authorize?'.$query);
});

Route::get('/callback', function(Request $request) {
    $http = new GuzzleHttp\Client;

    $response = $http->post('http://localhost/blog/public/oauth/token', [
        'form_params'=> [
            'grant_type'=>'authorization_code',
            'client_id'=> $request->client_id,
            'client_secret'=>'usXPoOFfUXYqYiKW2yiMtVD3uZmsV9ve4sGr52W8',
            'redirect_uri' => 'http://localhost/blog/public/callback',
            'code' => $request->code,
        ],
    ]);

    return json_decode((string)$response->getBody(), true);
});

Route::get('/personal_token/{id}', function($id) {
    $user = App\User::find($id);
    $token = $user->createToken('App personal')->accessToken;
    return $token;
});

/*Route::get('/meter', function(){
    $user = Auth::user();
    return view('meter', ['meter'=>$user->meter]);
})->middleware('auth'); */

Route::get('/reg_customer', 'UserController@create')->name('reg')->middleware('can:createCustomer,App\User');
Route::get('/reg_staff', 'UserController@createStaff')->name('reg_staff')->middleware('can:createStaff,App\User');
Route::post('/reg_store', 'UserController@store')->name('reg_store')->middleware('can:createStaff,App\User');
Route::post('/reg_store_staff', 'UserController@storeStaff')->name('reg_store_staff')->middleware('can:createStaff,App\User');
Route::get('/meter', 'UserController@meter')->name('my_meter')->middleware('auth');
Route::get('/customer_recharge/{id}', 'MeterController@customer_recharge')->name('customer_recharge')->middleware('auth');
Route::get('/staff_recharge/{id}', 'MeterController@staff_recharge')->name('staff_recharge')->middleware('can:viewAll, App\Meter');
Route::post('/pin_recharge', 'RechargeController@pinRecharge')->name('pin_recharge')->middleware('auth');


Route::get('/meter/create', 'MeterController@create')->name('meter/create');
Route::post('/meter/store', 'MeterController@store')->name('meter/store');
Route::get('/all_meters', 'MeterController@all_meters')->name('all_meters')->middleware('can:viewAll, App\Meter');
Route::get('/meter/{id}', 'MeterController@show')->name('meter')->middleware('can:viewAll, App\Meter');
Route::post('/search/meter', 'MeterController@search')->name('search/meter')->middleware('can:viewAll, App\Meter');

Route::get('/power_consumed', 'PowerConsumedController@store');
Route::get('/average_power/{meter_id}/{daysAgo}', 'PowerConsumedController@getPC');
Route::get('/avgs/{meter_id}', 'PowerConsumedController@getLastSevenDaysAverage' );

Route::get('/gVoucher', 'RechargeController@generateVoucher');

Route::get('/vouchers', 'VoucherController@showAll')->name('vouchers')->middleware('can:viewAll, App\Meter');
Route::post('/generateVoucher', 'VoucherController@generate')->name('generateVoucher')->middleware('can:viewAll, App\Meter');
Route::post('/deleteVoucher', 'VoucherController@deleteVoucher')->name('deleteVoucher')->middleware('can:viewAll, App\Meter');

Route::get('/settings', 'SettingsController@showPage')->name('settings')->middleware('can:viewAll, App\Meter');