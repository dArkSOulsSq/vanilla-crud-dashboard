<?php use Illuminate\Support\Facades\Route;

Route::get('/tasks', fn() => view('tasks.index'));
Route::get('/', fn() => redirect('/tasks'));