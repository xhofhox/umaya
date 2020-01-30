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

//Route::resource('students', 'StudentController');

//Almacenamiento de archivos
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

//Formulario pago por depósito
Route::get('formulario', 'StorageController@index');

//Mostrar alertas
Route::get('alert/{AlertType}','sweetalertController@alert')->name('alert');

//Mostrar listado de CFDI´s
Route::get('invoice/index/{server_api}', 'InvoiceController@index');

//Descargar factura
Route::get('invoice/downloadCFDI/{server_api}/{cfdi_uid}/{format}', 'InvoiceController@downloadCFDI');

//Cancelar factura
Route::post('invoice/cancelCFDI/{server_api}/{cfdi_uid}', 'InvoiceController@cancelCFDI');

//Enviar factura
Route::post('invoice/sendCFDI/{server_api}/{cfdi_uid}', 'InvoiceController@sendCFDI');

//Listado de facturas masivas
Route::get('invoice/massive/{server_api}/{id_massive_invoice}', 'InvoiceController@massive');

//Generar facturacion masiva
Route::post('invoice/createCFDIMassive/{server_api}/{id_massive_invoice}', 'InvoiceController@createCFDIMassive');

//Actualizar información referente a  la factura
Route::post('invoice/actualizarRegistroFactura', 'InvoiceController@actualizarRegistroFactura');

//Actualizar información referente a  la facturación masiva
Route::post('invoice/actualizarRegistrosFacturas', 'InvoiceController@actualizarRegistrosFacturas');

//Generacion CFDI Global
Route::post('invoice/crearCFDIGlobal', 'InvoiceController@crearCFDIGlobal');

//Actualizar información de los recibos
Route::post('invoice/actualizarRegistroRecibos', 'InvoiceController@actualizarRegistroRecibos');

//Generar nota de crédito
Route::post('invoice/crearCFDICreditNote', 'InvoiceController@crearCFDICreditNote');

Route::get('invoice/conexion', 'InvoiceController@conexion');
Route::get('invoice/create/{id}', 'InvoiceController@create');
Route::get('invoice/mostrarConcepto/{id}', 'InvoiceController@mostrarConcepto');
Route::get('invoice/editMassive/{id}', 'InvoiceController@editMassive');
Route::get('invoice/createGlobal/{id}', 'InvoiceController@createGlobal');
Route::get('invoice/createGlobalDemo/{id}', 'InvoiceController@createGlobalDemo');
Route::post('storage/save', 'StorageController@save');
Route::post('invoice/crearCFDI', 'InvoiceController@crearCFDI');
Route::post('invoice/saveConcept', 'InvoiceController@saveConcept');
Route::post('invoice/listarCFDI', 'InvoiceController@listarCFDI');
Route::get('invoice/creditNote/{id}', 'InvoiceController@creditNote');
Route::get('invoice/descargarPDFx/{cfdi_uid}', 'InvoiceController@descargarPDFx');
//Route::get('invoice/descargarPDF/{cfdi_uid}', 'InvoiceController@descargarPDF');
Route::post('invoice/descargarXML', 'InvoiceController@descargarXML');

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
