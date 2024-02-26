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

// Route::get('/', function () {
//     global $users;
//     return $users;
// });
Route::get('/users',function(){
    global $users;
    $userNames = array_column($users,'name');
    return 'The user are: '. implode(' ,',$userNames);
});
