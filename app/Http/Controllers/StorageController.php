<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Session;
use Alert;
use Illuminate\Support\Collection as Collection;
use App\Voucher;
use App\Payment;
use App\SatCatalog;

class StorageController extends Controller
{
    /**
    * muestra el formulario para guardar archivos
    *
    * @return Response
    */
    public function index()
    {
        return \View::make('new');
    }

    /**
    * Guarda un archivo en nuestro directorio local.
    *
    * @return Response
    */
    public function save(Request $request)
    {
        // dd($request);
        $directorio ='';
        switch ($request->input('bank_name')) {
            case "1":
                $directorio = 'Banorte/';
                break;
            case "2":
                $directorio = 'Santander/';
                break;
        }


        //Obtenemos el campo file definido en el formulario
        $file =$request->file('file'); //$request->file('file');
        // dd($file);
        // $dataFile = $request->input('file');
        $nombre = $file->getClientOriginalName();

        //indicamos que queremos guardar un nuevo archivo en el disco local
        // \Storage::disk('local')->put($nombre,  \File::get($file));\Storage::disk('local')->put($nombre,  \File::get($file));
        \Storage::disk('local')->put($directorio.$nombre,  file_get_contents($file));
        
        //Obtenemmos el contenido del archivo
        $contents = File::get($file);
        //dd(file_get_contents($file));

        $public_path = public_path();
        $url = $public_path.'/storage/'.$directorio.$nombre;

        $file_open = fopen($url, "rb");

        $miarray = array();
        $listaRegistros = array();
        $numRegistro;
        
        if ($file_open == false)
        {
            abort(404);
        }
        else{
            switch ($request->input('bank_name')) {
                case "1": //Banorte
                    while(!feof($file_open))
                    {
                        $numRegistro = fread($file_open, 1);
                        $miarray["registro"] = $numRegistro;
                                                    
                        switch($numRegistro)
                        {
                            case 0:
                                $miarray["tipo"] = "1";
                                $miarray["empresa"] = fread($file_open, 6);
                                $miarray["fecha"] = fread($file_open, 8);
                                $miarray["cuenta_cheque"] = fread($file_open, 16);
                                $miarray["filler"] = fread($file_open, 220);
                                array_push($listaRegistros, $miarray);
                                break;                        
                            case 2:
                                $miarray["tipo"] = "2";
                                $miarray["folio"] = fread($file_open, 21);
                                $miarray["metodo_pago"] = fread($file_open, 2);
                                $miarray["forma_pago"] = fread($file_open, 2);
                                $miarray["importe_bruto"] = fread($file_open, 14);
                                $miarray["importe_recargo"] = fread($file_open, 8);
                                $miarray["id_recargo"] = fread($file_open, 1);
                                $miarray["importe_neto"] = fread($file_open, 14);
                                $miarray["alterna"] = fread($file_open, 5);
                                $miarray["referencia"] = fread($file_open, 14);
                                $miarray["referencia2"] = fread($file_open, 21);
                                $miarray["referencia3"] = fread($file_open, 20);
                                $miarray["referencia4"] = fread($file_open, 20);
                                $miarray["vencimiento"] = fread($file_open, 8);
                                $miarray["sucursal"] = fread($file_open, 4);
                                $miarray["hora"] = fread($file_open, 6);
                                $miarray["estatus"] = fread($file_open, 1);
                                $miarray["filler"] = fread($file_open, 89);
                                
                                //Obtener el registro correspondiente de la tabla voucher por medio de la alterna y la referencia
                                $bank_number = $miarray["alterna"];
                                $referencia =  $miarray["referencia"];
                                $ref_voucher = $bank_number.$referencia;
                                //dd ($ref_voucher);
                                
                                
                                if ($bank_number != "" && $referencia != "")
                                {
                                    $voucher = Voucher::where('bank_number', $bank_number)
                                    //->where('referencia_voucher', $referencia)
                                    ->where('referencia_voucher', $ref_voucher)
                                    ->where('status', false)
                                    ->first();

                                    if ($voucher != null)
                                    {
                                        //Insertar en tabla de pagos
                                        $payment = new Payment;
                                        $payment->subconcept_assign_id = $voucher['subconcept_assign_id'];
                                        $payment->amount = $voucher['amount'];
                                        $payment->payment_method_id = 1;
                                        $payment->date = date('Y-m-d', strtotime($voucher['fecha']));
                                        $payment->description = null;
                                        $payment->adjustment_description = null;
                                        $payment->transfer_description = null;
                                        //$payment->created_at = getdate();
                                        //$payment->updated_at = getdate();
                                        $payment->status = true;
                                        $payment->student_id = $voucher['student_id'];
                                        $payment->invoice_id = null;
                                        $payment->reference = $miarray["referencia"];
                                        $payment->cajero = "";
                                        $payment->cycle_id = $voucher['cycle_id'];
                                        $payment->ciclo = null;
                                        $payment->subciclo = null;
                                        $payment->campus = $voucher['campus'];
                                        $payment->matricula = null;
                                        if ($miarray["forma_pago"] = '01')
                                        {
                                            $payment->payment_form = 1;
                                        }
                                        else 
                                        {
                                            $payment->payment_form = 2;
                                        }
                                        
                                        $payment->save();
                                        
                                        $voucher->update(['status' => true]);
                                    }                                    
                                }                                
                                array_push($listaRegistros, $miarray);                                
                                break;
                            case 4:
                                $miarray["tipo"] = "3";
                                $miarray["num_pagos_acreditados"] = fread($file_open, 6);
                                $miarray["importe_pagos_acreditados"] = fread($file_open, 14);
                                $miarray["num_pagos_devueltos"] = fread($file_open, 6);
                                $miarray["importe_pagos_devueltos"] = fread($file_open, 14);
                                $miarray["num_pagos_cancelados"] = fread($file_open, 6);
                                $miarray["importe_pagos_cancelados"] = fread($file_open, 14);
                                $miarray["num_total_pagos"] = fread($file_open, 6);
                                $miarray["importe_total_pagos"] = fread($file_open, 14);
                                $miarray["indicador"] = fread($file_open, 170);
                                array_push($listaRegistros, $miarray);
                                break;                                                   
                        }
                    }
                    break;
                case "2": //Santander
                    while(!feof($file_open))
                    {
                       // $miarray["registro"] = fread($file_open, 1);
                        // $miarray["tipo"] = "4";
                        $miarray["numero_cuenta"] = fread($file_open, 16);
                        $miarray["fecha"] = fread($file_open, 8);
                        $miarray["hora_movimiento"] = fread($file_open, 4);
                        $miarray["sucursal"] = fread($file_open, 4);
                       // $miarray["dato"] = fread($file_open, 4);
                        $miarray["descripcion"] = fread($file_open, 40);
                        $miarray["signo"] = fread($file_open, 1);
                        $miarray["importe"] = fread($file_open, 14);
                        $miarray["saldo"] = fread($file_open, 14);
                        $miarray["folio_referencia_interna"] = fread($file_open, 8);
                        $miarray["alterna"] = fread($file_open, 5);
                        $miarray["referencia"] = fread($file_open, 14);
                        $miarray["referencia_ext"] = fread($file_open, 23);
                       // $miarray["num_pago"] = fread($file_open, 2);
                        //$miarray["subciclo"] = fread($file_open, 2);
                        //$miarray["ciclo"] = fread($file_open, 2);
                        //$miarray["concepto_referencia_pago"] = fread($file_open, 31);
                        
                        //Obtener el registro correspondiente de la tabla voucher por medio de la alterna y la referencia
                        $bank_number = $miarray["alterna"];
                        $referencia =  $miarray["referencia"];
                        $descripcion = $miarray["descripcion"];
                        
                         $ref_voucher = $bank_number.$referencia;
                       // dd ($ref_voucher);
                        if (strpos($descripcion, 'DEP') !== false)
                        {
                            $voucher = Voucher::where('bank_number', $bank_number)
                           //->where('referencia_voucher', $referencia)
                            ->where('referencia_voucher', $ref_voucher)
                            ->where('status', false)
                            ->first();

                            if ($voucher != null)
                            {
                                //Insertar en tabla de pagos
                                $payment = new Payment;
                                $payment->subconcept_assign_id = $voucher['subconcept_assign_id'];
                                $payment->amount = $voucher['amount'];
                                $payment->payment_method_id = 5;
                                $payment->date = date('Y-m-d', strtotime($voucher['fecha']));
                                $payment->description = null;
                                $payment->adjustment_description = null;
                                $payment->transfer_description = null;
                                //$payment->created_at = getdate();
                                //$payment->updated_at = getdate();
                                $payment->status = true;
                                $payment->student_id = $voucher['student_id'];
                                $payment->invoice_id = null;
                                $payment->reference = $miarray["referencia"];
                                $payment->cajero = "";
                                $payment->cycle_id = $voucher['cycle_id'];
                                $payment->ciclo = null;
                                $payment->subciclo = null;
                                $payment->campus = $voucher['campus'];
                                $payment->matricula = null;
                                
                                
                                switch ($descripcion) 
                                {
                                case "DEP EFECT ATM                           ":
                                    $payment->payment_form = 1;
                                    break;
                                case "DEP CHEQUE NO                           ":
                                    $payment->payment_form = 2;
                                    break;
                                }
                                ////
                                /*
                                if ($miarray["forma_pago"] = "EFECT ATM                           ")
                                        {
                                            $payment->payment_form = 1;
                                        }
                                        if ($miarray["forma_pago"] = "DEP CHEQUE NO                           ")
                                        {
                                            $payment->payment_form = 2;
                                        }
                                */
                                ////
                                
                                
                                $payment->save();
                                
                                $voucher->update(['status' => true]);
                            }                                    
                        }
        
                        array_push($listaRegistros, $miarray);
                    }
                    break;
            }
        }
        
        return response()->json($listaRegistros, 200);
    }
}
