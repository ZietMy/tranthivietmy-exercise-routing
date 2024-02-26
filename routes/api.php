<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('/users')->group(function(){
    Route::get('/', function () {
        global $users;
        return $users;
    });
    Route::get('/{userIndex?}',function($userIndex=null){
        global $users;
        if (isset($users[$userIndex])){
            return $users[$userIndex];
        }else{
            return 'Cannot find with index'. $userIndex;
        }
    })->where(['userIndex' => '[0-9]+']);
    
    Route::get('/{userName?}',function($userName=null){
        global $users;
        foreach ($users as $user) {
            if ($user['name'] == $userName) {
                return $user;
            }
        };
            return 'Cannot find with user '. $userName;
    })->where(['userName' => '[a-zA-Z]+']);
    Route::get('/{userIndex?}/post/{postIndex?}', function ($userIndex = null, $postIndex = null) {
        global $users;
        foreach ($users as $index => $user) {
            if ($userIndex ==  $index) {
                if ($userIndex == $index) {
                    if (isset($user['posts'][$postIndex])) {
                        return $user['posts'][$postIndex];
                    } else {
                        return 'Cannot find the post with id ' . $postIndex . ' for user ' . $userIndex;
                    }
                }
            }
        }
    })->where(['userIndex' => '[0-9]+', 'postIndex' => '[0-9]+']);
    Route::fallback(function () {
        return "You cannot get a user like this !";
    });
});

// Route::middleware('api')->get('/api/users', function (Request $request) {
//     $users = [
//         [
//             'name' => 'rady',
//             'posts' => ['Hello !', 'Good bye !'],
//         ],
//         [
//             'name' => 'him',
//             'posts' => ['How are you ?', 'I love mangos !'],
//         ],
//     ];

//     return response()->json($users);
// });