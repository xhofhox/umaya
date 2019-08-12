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
Route::get('invoice/index', 'InvoiceController@index');
Route::get('invoice/massive', 'InvoiceController@massive');
Route::get('invoice/conexion', 'InvoiceController@conexion');
Route::get('invoice/create/{id}', 'InvoiceController@create');
Route::get('invoice/mostrarConcepto/{id}', 'InvoiceController@mostrarConcepto');

Route::get('invoice/editMassive/{id}', 'InvoiceController@editMassive');
Route::get('invoice/createGlobal/{id}', 'InvoiceController@createGlobal');

Route::post('storage/save', 'StorageController@save');
Route::post('invoice/crearCFDI', 'InvoiceController@crearCFDI');
Route::post('invoice/actualizarRegistroFactura', 'InvoiceController@actualizarRegistroFactura');
Route::post('invoice/listarCFDI', 'InvoiceController@listarCFDI');

Route::get('invoice/descargarPDFx/{cfdi_uid}', 'InvoiceController@descargarPDFx');
Route::get('invoice/descargarPDF/{cfdi_uid}', 'InvoiceController@descargarPDF');
Route::post('invoice/descargarXML', 'InvoiceController@descargarXML');

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

Route::get('pdf/{archivo}', function($archivo){
  Fpdf::AddPage();
  Fpdf::SetFont('Arial','B',16);
  Fpdf::Cell(40,10,'Hello World!');
  if (preg_match("/MSIE/i", $_SERVER["HTTP_USER_AGENT"])){
    header("Content-type: application/PDF");
  } else {
      header("Content-type: application/PDF");
      header("Content-Type: application/pdf");
  }
  Fpdf::Output('doc.pdf', 'I');
  exit;
 
});