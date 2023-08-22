<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\authentication\AuthenticationController;
use App\Http\Controllers\Admin\AdminDashController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\SectiontypeController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/',[AuthenticationController::class,'index']);
Route::post('/loginprocc',[AuthenticationController::class,'loginProcc']);
Route::get('/logout',[AuthenticationController::class,'logout']);


//admin
Route::group(['middleware' =>['admin']],function(){
Route::get('/admin-dashboard',[AdminDashController::class,'index']);
//events
Route::get('/admin-dashboard/events',[EventController::class,'index']);
Route::post('/admin-dashboard/events/save',[EventController::class,'submitProc']);
Route::post('/admin-dashboard/events/update',[EventController::class,'update']);

Route::get('/admin-dashboard/event-list',[EventController::class,'eventlist']);
Route::get('/admin-dashboard/edit/{slug}',[EventController::class,'edit']);
Route::get('/admin-dashboard/event/delete/{id}',[EventController::class,'delete']);


//sectiontype
Route::get('/admin-dashboard/section/delete/{id}',[SectionController::class,'delete']);
Route::post('/admin-dashboard/section/update/',[SectionController::class,'update']);

Route::post('/admin-dashboard/section/removeimage/',[SectionController::class,'removeimage']);
Route::post('/admin-dashboard/section/updatesectionnumber/',[SectionController::class,'updatesectionnumber']);


});
