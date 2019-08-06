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

Route::resource('students', 'StudentController');
	
Route::get('formulario', 'StorageController@index');
Route::get('invoice/formulario', 'InvoiceController@index');
Route::get('invoice/create/{id}', 'InvoiceController@create');
//Route::get('invoice/actualizarRegistroFactura/{id}', 'InvoiceController@actualizarRegistroFactura');

Route::post('storage/save', 'StorageController@save');
Route::post('invoice/crearCFDI', 'InvoiceController@crearCFDI');
//Route::post('invoice/actualizarRegistroFactura/{id}', 'InvoiceController@actualizarRegistroFactura');
Route::post('invoice/actualizarRegistroFactura', 'InvoiceController@actualizarRegistroFactura');

Route::get('storage/{archivo}', function ($archivo) {
     $public_path = public_path();
     $url = $public_path.'/storage/'.$archivo;
     //verificamos si el archivo existe y lo retornamos
     if (Storage::exists($archivo))
     {
       return response()->download($url);
     }
     //si no se encuentra lanzamos un error 404.
     abort(404);
 
});

Route::get('alert/{AlertType}','sweetalertController@alert')->name('alert');