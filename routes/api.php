<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', 'AuthController@login')->middleware('api');

Route::group(['middleware' => ['api', 'jwt.verify']], function ($router) {

    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::patch('user/{id}', 'UserController@update')->name('user.update');
    Route::get('users', 'UserController@index')->name('user.list');
});

Route::post('user', 'UserController@store')->name('user.store');
Route::get('user/{id}', 'UserController@find')->name('user.detail');


Route::post('payment', 'PaymentController@create')->name('create');
Route::post('payment2', 'Payment2Controller@create')->name('create');
Route::get('payment/respone', 'PaymentController@respone')->name('respone');
Route::get('payment2/respone', 'Payment2Controller@respone')->name('respone');

Route::get('/complete-purchase', function (\Illuminate\Http\Request $request) {
    /** @var \Omnipay\Common\Message\ResponseInterface $completePurchaseResponse */
    $completePurchaseResponse = $request->attributes->get('completePurchaseResponse');

    if ($completePurchaseResponse->isSuccessful()) {
        // xử lý logic thanh toán thành công.
        return response()->json([
            'status' => '0',
            'message' => 'Thanh toán thành công!',
        ]);
    } elseif ($completePurchaseResponse->isCancelled()) {
        // khi khách hủy giao dịch.
        return response()->json([
            'status' => '1',
            'message' => 'Khách hàng huỷ giao dịch!',
        ]);
    } else {
        // các trường hợp khác
        return response()->json([
            'status' => '1',
            'message' => 'Lỗi!',
        ]);
    }
})->middleware('completePurchase:OnePayDomestic');
