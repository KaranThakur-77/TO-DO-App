<?php

use App\Http\Controllers\TODO_Controller;
use Illuminate\Support\Facades\Route;

Route::get('/',[TODO_Controller::class,'index']);
Route::post('/',[TODO_Controller::class,'store']);
Route::get('/todo/{id}/destroy',[TODO_Controller::class,'destroy']);
Route::put('todo/{id}/update',[TODO_Controller::class,'update']);
