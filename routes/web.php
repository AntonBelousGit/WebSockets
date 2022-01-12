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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/app', function () {
    return view('app');
});
Route::get('/order', function () {
    return view('order.index');
});
Route::post('/order', function (\Illuminate\Http\Request $request) {

//    $data = ['name'=>$request->input('name'),'product'=>$request->input('product')];
    $data = [
        'message' => 'new order',
        'value' => [
            'name' => $request->input('name'),
            'product' => $request->input('product')
        ]
    ];
    $client = new WebSocket\Client("ws://192.168.0.108:8080");
    $client->text(json_encode(['message' => 'new room', 'value' => 'one']));
    $client->text(json_encode($data));
    echo $client->receive();
    $client->close();
    return response()->redirectTo('/order');
})->name('order.store');

Route::get('/orders', function () {
    return view('order.orders');
});
Route::get('/rooms', function () {
    return view('room.rooms');
});

Route::get('/room', function (\Illuminate\Http\Request $request) {
    if ($request->input('id') == 1) {
        $room_name = 'one';
    } elseif ($request->input('id') == 2) {
        $room_name = 'two';
    } else {
        $room_name = 'tree';
    }
    return view('room.room',[
        'id'=> $request->input('id'),
        'name'=> $request->input('name'),
        'room_name' =>$room_name,

    ]);
});
