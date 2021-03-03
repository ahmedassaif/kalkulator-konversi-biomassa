<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\testingcontroller;
use App\Http\Controllers\WoodFuelCalc;
use App\Http\Controllers\CalcSMWoodFuel;
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
//     return view('welcome');
// });

// route::get('testpage','testingcontroller@index');
// Route::get('/testpage', [testingcontroller::class, 'index']);

Route::get('/', [WoodFuelCalc::class, 'index']);
Route::post('/calcresult', [WoodFuelCalc::class, 'mainconversioncalculator']);

Route::get('/calcsmwoodfuel', [CalcSMWoodFuel::class, 'index']);
Route::post('/smwoodfuelresult', [CalcSMWoodFuel::class, 'maincalc']);
// Route::get('/howtouse', [WoodFuelCalc::class, 'viewpetunjuk']);



// Route::get('/calcresult', [WoodFuelCalc::class, 'calcresult']);
// Route::get('/calcresult', [WoodFuelCalc::class, 'mainconversioncalculator']);
