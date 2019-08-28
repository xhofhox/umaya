<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\ViewStudent;
use App\InvoiceExt;
use App\ConceptsInvoice;
use DB;
use Alert;
use Codedge\Fpdf\Facades\Fpdf;
use Response;
use File;
use Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class InvoiceController extends Controller
{
	//Inicializar variables API
	private $Host;
	private $Endpoint;
	private $apiKey;
	private $secretKey;

	public function __construct()
    {
		//sandbox
        $this->Host = 'http://devfactura.in';
		$this->apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
		$this->secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
    }

	public function returnValueAPI($server_api)
    {
		//Verificar Servidor para obtener los datos de conexión
        switch ($server_api) {
            case "1": 
				//sandbox
                $this->Host = 'http://devfactura.in';
				$this->apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
				$this->secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
                break;
            case "2": 
				//producción
                $this->Host = 'https://factura.com';
                $this->apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
                $this->secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
                break;
        }
    }

    /**
     * Mostrar la lista de facturas generadas
	 * @param int $server_api
     * @return \Illuminate\Http\Response
     */
    public function index($server_api)
    {
        $this->returnValueAPI($server_api);
		$this->Endpoint = '/api/v3/cfdi33/list';

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $this->Host.$this->Endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ".$this->apiKey,
            "F-Secret-Key: ".$this->secretKey
        ));
        
        $response = curl_exec($ch);
		//dd(json_decode($response, true));
        curl_close($ch);

        return view('listInvoice')->with('list', json_decode($response, true));
    }

	/**
     * Descargar fatura en formato PDF/XML
	 * @param int $server_api
	 * @param string $cfdi_uid
	 * @param string $format
     * @return response
     */
	public function downloadCFDI($server_api, $cfdi_uid, $format)
    {
		$this->returnValueAPI($server_api);
		$this->Endpoint = '/api/v3/cfdi33/'.$cfdi_uid.'/'.$format;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->Host.$this->Endpoint);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ".$this->apiKey,
            "F-Secret-Key: ".$this->secretKey
        ));

        $response = curl_exec($ch);

		if ($format == "pdf")
		{
			header('Content-type: application/pdf');
		}
		else {
			# code...
		}

        return die ($response);

        curl_close($ch);
    }

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function massive()
    {
        $Invoices = InvoiceExt::all();
        return \View::make('MassiveInvoice')->with('Invoices', $Invoices);
    }
    
    public function conexion()
    {
        return \View::make('formInvoice');
    }
    
    public function creditNote($id)
    {
        //return \View::make('createCreditNote');
        
        //Obtener datos de la factura y mostrarlo en la vista
        $data = InvoiceExt::find($id);
        $concepts = ConceptsInvoice::where('invoice_ext_id', $id)->get();
        $invoice = ['data' => $data, 'concepts' => $concepts];
        return view('createCreditNote', compact('invoice'));
    }


    public function listarCFDI(Request $request)
    {
        $urlListCFDI;
        $apiKey;
        $secretKey;
        $server_api = $request->input('Servidor');
        //$list = array();
        //$listCFDIs = array();
        
        //Verificar Servidor para obtener los datos de conexión
        switch ($server_api) {
            case "1": //sandbox
                $urlListCFDI = 'http://devfactura.in/api/v3/cfdi33/list';
                $apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
                $secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
                break;
            case "2": //producción
                $urlListCFDI = 'https://factura.com/api/v3/cfdi33/list';
                $apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
                $secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
                break;
        }
        
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $urlListCFDI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ".$apiKey,
            "F-Secret-Key: " .$secretKey
        ));
        
        $response = curl_exec($ch);
        return die($response);
        //return response()->json($response, 200);
        
        curl_close($ch);
        //$data = InvoiceExt::all();
        //return \View::make('listInvoice')->with('data', $response);
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //Obtener datos de la factura y mostrarlo en la vista
        $data = InvoiceExt::find($id);
		$data->forma_pago_id = "0".(string)$data->forma_pago_id;
        //dd($data);
        $concepts = ConceptsInvoice::where('invoice_ext_id', $id)->get();
		//dd($concepts);
        $invoice = ['data' => $data, 'concepts' => $concepts];

		//dd($invoice);

        return view('createInvoice', compact('invoice'));         
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function editMassive($id)
    {
        //Obtener datos de la factura y mostrarlo en la vista
        $data = InvoiceExt::find($id);
        $concepts = ConceptsInvoice::where('invoice_ext_id', $id)->get();
        $invoice = ['data' => $data, 'concepts' => $concepts];
        return view('editMassiveInvoice', compact('invoice'));         
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createGlobal($id)
    {
        //Obtener datos de la factura y mostrarlo en la vista
        $data = InvoiceExt::find($id);
        $concepts = ConceptsInvoice::where('invoice_ext_id', $id)->get();
        $invoice = ['data' => $data, 'concepts' => $concepts];
        return view('createGlobalInvoice', compact('invoice'));         
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function mostrarConcepto($id)
    {
        //Obtener información del concepto
        $concept = ConceptsInvoice::find($id);
        dd($concept);
        return view('modalConcept', compact('concept'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    
    public function validarCliente($cliente_rfc, $UrlConsultaCliente, $UrlCrearCliente, $apiKey, $secretKey)
    {
        $ch = curl_init();
    
        curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ".$apiKey,
            "F-Secret-Key: " .$secretKey
        ));
        $response = curl_exec($ch);
        curl_close($ch);
        
        var_dump($response);
        //dd($response);
        
    }

	public function saveConcept(Request $request)
    {
		//Obtener información del concepto
		$concept = ConceptsInvoice::find($request->input('id'));
		dd($request->input('id'));

		$concept->descripcion = $request->input('descripcion');
		$concept->cantidad = $request->input('cantidad');
		$concept->unidad = $request->input('unidad');
		$concept->precio_unitario = $request->input('precio_unitario');
		$concept->subtotal = $request->input('subtotal');
		$concept->clave_sat = $request->input('clave_sat');
		$concept->sku = $request->input('NoIdentificacion');
		
		$concept->save();		

		$response = array();
        $response["message"] = 'La factura ya existe.';
            
        return response()->json(
            collect([
                'response' => 'warning',
                'message' => $response,
                    
            ])->toJson()
        ); 
	}
    
    public function crearCFDI(Request $request)
    {
        $id = $request->input('id');

        //Verificar si la factura ya existe
        $invoice_ext = InvoiceExt::where('id', $id)->first();

        if ($invoice_ext->status == 1)
        {
            $response = array();
            $response["message"] = 'La factura ya existe.';
            
            return response()->json(
                collect([
                    'response' => 'warning',
                    'message' => $response,
                    
                ])->toJson()
            ); 
        } 
        else 
        {
            //Generar factura
            $urlFactura;
            $apiKey;
            $secretKey;
            $UrlConsultaCliente;
            $UrlCrearCliente;
            $server_api = $request->input('Servidor');
            
            //Verificar Servidor para obtener los datos de conexión
            switch ($server_api) {
                case "1": //sandbox
                    $urlFactura = 'http://devfactura.in/api/v3/cfdi33/create';
                    $UrlConsultaCliente = 'http://devfactura.in/api/v1/clients/';
                    $UrlCrearCliente = 'http://devfactura.in/api/v1/clients/create/';
                    $apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
                    $secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
                    break;
                case "2": //producción
                    $urlFactura = 'https://factura.com/api/v3/cfdi33/create';
                    $UrlConsultaCliente = 'https://factura.com/api/v1/clients/';
                    $UrlCrearCliente = 'https://factura.com/api/v1/clients/create/';
                    $apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
                    $secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
                    break;
            }
            
            //Validar Receptor UUID 
            //$cliente_rfc = $request->input('RFC');
            //dd($cliente_rfc);
            //validarCliente($cliente_rfc, $UrlConsultaCliente, $UrlCrearCliente, $apiKey, $secretKey);
            // $ch = curl_init();
            //
            //curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
            //curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //curl_setopt($ch, CURLOPT_HEADER, FALSE);
            //
            //curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //    "Content-Type: application/json",
            //    "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            //    "F-Api-Key: ".$apiKey,
            //    "F-Secret-Key: " .$secretKey
            //));
            //$response = curl_exec($ch);
            //dd($response);
            //curl_close($ch);
            //
            //var_dump($response);
            
            
            //--------------- CREAR CFDI --------------------- //
            
            $ClaveProdServ = $request->input('ClaveProdServ');
            $Cantidad = $request->input('Cantidad');
            $ClaveUnidad = $request->input('ClaveUnidad');
            $ValorUnitario = $request->input('ValorUnitario');
            $Descripcion = $request->input('Descripcion');
            $Descuento = $request->input('Descuento');
            $Impuesto = $request->input('Impuesto');
            $TipoFactor = $request->input('TipoFactor');
            $TasaOCuota = $request->input('TasaOCuota');
            $Importe = $request->input('Importe');

			$Conceptos[] = array();

			//Obtener los conceptos asociados a la factura
			$Concepts = ConceptsInvoice::all()->where('invoice_ext_id', '=', $id);

			
			//$Concepts = ConceptsInvoice::all()->where('invoice_ext_id', '=', $id)->toArray();

			//Recorrer los conceptos y agregar unicamente la información de utilidad
			foreach($Concepts as $concept)
			{
				array_push(
					$Conceptos,
					array(
						'ClaveProdServ' => $concept -> clave_sat,
						'Cantidad' => $concept -> cantidad,
						'ClaveUnidad' => $concept -> claveunidad,
						'Unidad' => $concept -> unidad,
						//'Unidad' => 'Unidad de servicio',
						'ValorUnitario' => $concept -> precio_unitario,
						'Descripcion' => $concept -> descripcion,
						'Descuento' => $concept -> descuento,
						'Impuestos' => [
							'Traslados' => []
						],
					)
				);
			}

			unset($Conceptos[0]);

			//dd($Conceptos);
            
            /*for ($x = 1; $x <= 1; $x++) {
				
                $Conceptos[] = [
                    'ClaveProdServ' => $ClaveProdServ,
                    'Cantidad' => $Cantidad,
                    'ClaveUnidad' => $ClaveUnidad,
                    'Unidad' => 'Unidad de servicio',
                    'ValorUnitario' => $ValorUnitario,
                    'Descripcion' => $Descripcion,
                    'Descuento' => $Descuento,
                    'Impuestos' => [
                        'Traslados' => [
                            [
                             'Base' => $ValorUnitario,
                             'Impuesto' => $Impuesto,
                             'TipoFactor' => $TipoFactor,
                             'TasaOCuota' => $TasaOCuota,
                             'Importe' => $Importe
                            ],
                        ]
                    ],
                ];
            }*/
            
            $Receptor = $request->input('Receptor');
            $TipoDocumento = $request->input('TipoDocumento');
            $UsoCFDI = $request->input('UsoCFDI');
            $FormaPago = $request->input('FormaPago');
            $MetodoPago = $request->input('MetodoPago');
            $Moneda = $request->input('Moneda');
            $CondicionesDePago = $request->input('CondicionesDePago');
            $Serie = $request->input('Serie');
            
            $ch = curl_init();
            $fields = [
                "Receptor" => ["UID" => $Receptor],
                "TipoDocumento" => $TipoDocumento,
                "UsoCFDI" => $UsoCFDI,
                "Redondeo" => 2,
                "Conceptos" => $Conceptos,
                "FormaPago" => $FormaPago,
                "MetodoPago" => $MetodoPago,
                "Moneda" => $Moneda,
                "CondicionesDePago" => $CondicionesDePago,
                "Serie" => $Serie,
                "EnviarCorreo" => 'true',
                "InvoiceComments" => "Prueba"
            ];

			//dd($fields);
            
            $jsonfield = json_encode($fields);
            
            curl_setopt($ch, CURLOPT_URL, $urlFactura);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_HEADER, FALSE);
            curl_setopt($ch, CURLOPT_POST, TRUE);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonfield);
            
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "Content-Type: application/json",
                "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
                "F-Api-Key: ".$apiKey,
                "F-Secret-Key: " .$secretKey
            ));
            
            $response = curl_exec($ch);
            
            return die($response);
            
            curl_close($ch);
            
        }
    }
    
    public function actualizarRegistroFactura(Request $request)
    {
          //dd ($request);  
        $invoice_ext = InvoiceExt::where('id', $request->input('id'))
                                    ->first();
                                
        //dd($invoice_ext);
        if ($invoice_ext != null)
        {
            //Insertar en tabla de Invoice_ext            
            $invoice_ext->update(['status' => 1]);
           $invoice_ext->update(['uuid' => $request->input('uuid')]);
            $invoice_ext->update(['folio' => $request->input('folio')]);

        }          
    }


    // public function descargarPDF(Request $request)
    // {
    //     //dd($request);
    //     $urlDownloadCFDI;
    //     $apiKey;
    //     $secretKey;
    //     $server_api = $request->input('servidor');
    //     $cfdi_uid = $request->input('cfdi_uid');
        
    //     //Verificar Servidor para obtener los datos de conexión
    //     switch ($server_api) {
    //         case "1": //sandbox
    //             $urlDownloadCFDI = 'http://devfactura.in/api/v3/cfdi33/'.$cfdi_uid.'/pdf';
    //             $apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
    //             $secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
    //             break;
    //         case "2": //producción
    //             $urlDownloadCFDI = 'https://factura.com/api/v3/cfdi33/'.$cfdi_uid.'/pdf';
    //             $apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
    //             $secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
    //             break;
    //     }
    //     $ch = curl_init();

    //     curl_setopt($ch, CURLOPT_URL, $urlDownloadCFDI);
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    //     curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
    //     curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    //         "Content-Type: application/json",
    //         "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
    //         "F-Api-Key: ".$apiKey,
    //         "F-Secret-Key: " .$secretKey
    //     ));
        
    //     $response = curl_exec($ch);

    //     header('Content-type: application/pdf');
    //     return die ($response);

    //     curl_close($ch);
    // }

	/*
    public function descargarPDF($cfdi_uid)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://devfactura.in/api/v3/cfdi33/'.$cfdi_uid.'/pdf');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ". 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh',
            "F-Secret-Key: " . 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5'
        ));

        $response = curl_exec($ch);

        header('Content-type: application/pdf');
        // return die ($response);
        return response()->download($response);
        curl_close($ch);
        
    }*/

    public function descargarPDFx($cfdi_uid)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://devfactura.in/api/v3/cfdi33/'.$cfdi_uid.'/pdf');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);

        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ". 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh',
            "F-Secret-Key: " . 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5'
        ));

        $response = curl_exec($ch);

        header('Content-type: application/pdf');
        return die ($response);

        curl_close($ch);
    }



    public function descargarXML(Request $request)
    {
        //dd($request);
        $urlDownloadCFDI;
        $apiKey;
        $secretKey;
        $server_api = $request->input('servidor');
        $cfdi_uid = $request->input('cfdi_uid');
        
        //Verificar Servidor para obtener los datos de conexión
        switch ($server_api) {
            case "1": //sandbox
                $urlDownloadCFDI = 'http://devfactura.in/api/v3/cfdi33/'.$cfdi_uid.'/xml';
                $apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
                $secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
                break;
            case "2": //producción
                $urlDownloadCFDI = 'https://factura.com/api/v3/cfdi33/' + $cfdi_uid + '/xml';
                $apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
                $secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
                break;
        }
        //dd($urlDownloadCFDI);
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $urlDownloadCFDI);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Content-Type: application/json",
            "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
            "F-Api-Key: ".$apiKey,
            "F-Secret-Key: " .$secretKey
        ));
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        var_dump($response);
    }


}
