<?php

use App\Http\Controllers\MovieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/',[MovieController::class,'index']);
Route::view('/view','home',[
    'baseUrl' => 'test',
    'imageBaseUrl' => env('MOVIE_DB_IMAGE_BASE_URL'),
    'apiKey' => 'test',
    'data' => [
        [
            'title' => 'jdudl',
        'overview' => 'pppp',
        'id' => 1,
        'backdrop_path' => 'p.jpg'
        ]
    ],
]);
