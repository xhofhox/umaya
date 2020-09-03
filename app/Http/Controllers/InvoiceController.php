<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\ViewStudent;
use App\InvoiceExt;
use App\ConceptsInvoice;
use App\PayRecipments;
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
		
        curl_close($ch);

        return view('listInvoice')->with('list', json_decode($response, true));
    }

	/**
     * Descargar factura en formato PDF/XML
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
			return die ($response);
		}
		else {
            header('Content-type: application/json');
            $data = array(base64_encode($response));
            return die (json_encode($data));
		}
        curl_close($ch);
        
    }

	/**
     * Cancelación de CFDI
	 * @param int $server_api
	 * @param string $cfdi_uid
     * @return response
     */
	public function cancelCFDI($server_api, $cfdi_uid)
    {
		$this->returnValueAPI($server_api);
		$this->Endpoint = '/api/v3/cfdi33/'.$cfdi_uid.'/cancel';

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
        curl_close($ch);
        dd($response);

		return die ($response);
    }

	/**
     * Envío de CFDI
	 * @param int $server_api
	 * @param string $cfdi_uid
     * @return response
     */
	public function sendCFDI($server_api, $cfdi_uid)
    {
		$this->returnValueAPI($server_api);
		$this->Endpoint = '/api/v3/cfdi33/'.$cfdi_uid.'/email';

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
		curl_close($ch);

		return die ($response);
    }
	
	/**
     * Mostrar formulario de factura precargando los datos dependiendo del id
	 * @param int $id
     * @return formulario
     */
    public function create($id)
    {
        //Obtener datos de la factura y mostrarlo en la vista
        $data = InvoiceExt::find($id);
        $concepts = ConceptsInvoice::where('invoice_ext_id', $id)->get();
        $invoice = ['data' => $data, 'concepts' => $concepts];
        return view('createInvoice', compact('invoice'));         
    }
	
	/**
     * Crear CFDI 
	 * @param Request $request
     * @return response
     */
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
                    $UrlCrearCliente = 'http://devfactura.in/api/v1/clients/create';
                    $apiKey = 'JDJ5JDEwJEkuQVdxdk1XOWJBVDd3NVNBbXlYTHVBa0k2YmdVTVVKZUJJU3locVUwQ2JmQ2RmN0REaVhh';
                    $secretKey = 'JDJ5JDEwJHFya0dMTFlnei5DQmkzZjhpRGg3N3VSWFhEMkNVMk1COGgxdmlWSEd4WnBtTTVkdEl4TWx5';
                    break;
                case "2": //producción
                    $urlFactura = 'https://factura.com/api/v3/cfdi33/create';
                    $UrlConsultaCliente = 'https://factura.com/api/v1/clients/';
                    $UrlCrearCliente = 'https://factura.com/api/v1/clients/create';
                    $apiKey = 'JDJ5JDEwJEtHL0c0RVNSUUVLS09uWDRublg3c3VncURHQklZZEVMRmJuWWFTTHpUakdVVFM0UHdJQUZp';
                    $secretKey = 'JDJ5JDEwJEpvRDJKbHplNXJwZzh0SWVGWlRoUy50YlpRRWs5cEI2dC4uU0pMck1Ic3hXdU1Tb0p4UC5l';
                    break;
            }
            
            //Validar existencia de receptor UID 
            $cliente_rfc = $request->input('RFC');
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "content-type: application/json",
                "f-plugin: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
                "f-api-key: ".$apiKey,
                "f-secret-key: " .$secretKey
            ));
            $response = curl_exec($ch);
			$json = json_decode($response);

			if ($json->status == "error") {
                curl_close($ch);

				//Crear cliente
                $ch = curl_init();
                $fields = [
                    "nombre" => $invoice_ext->Nombre,
                    "apellidos" => $invoice_ext->Apellidos,
                    "email" => $invoice_ext->email,
                    "email2" => "",
                    "email3" => "",
                    "telefono" => $invoice_ext->Telefono,
                    "razons" => $request->input('razonsocial'),
                    "rfc" => $request->input('RFC'),
                    "calle" => $invoice_ext->Calle,
                    "numero_exterior" => $invoice_ext->Numero,
                    "numero_interior" => $invoice_ext->Interior,
                    "codpos" => $invoice_ext->CodigoPosal,
                    "colonia" => $invoice_ext->Colonia,
                    "estado" => $invoice_ext->Estado,
                    "ciudad" => $invoice_ext->Ciudad,
                ];

                $jsonfield = json_encode($fields);

                curl_setopt($ch, CURLOPT_URL, $UrlCrearCliente);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($ch, CURLOPT_HEADER, FALSE);
                curl_setopt($ch, CURLOPT_POST, TRUE);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonfield);

                curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                    "Content-Type: application/json",
                    "F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
                    "f-api-key: ".$apiKey,
                    "f-secret-key: " .$secretKey
                ));

                $responseCreate = curl_exec($ch);
                $json = json_decode($responseCreate);               

                if ($json->status == "error") {
                    curl_close($ch);
                    return die($responseCreate);
                }

			}
            $Receptor = $json->Data->UID;		
            curl_close($ch);
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
                        'ValorUnitario' => $concept -> precio_unitario,
                        'Descripcion' => $concept -> descripcion,
                        'Descuento' => $concept -> descuento,
                        'Impuestos' => [
                            'Traslados' => [
                                ['Base' => '100', 'Impuesto' => '002', 'TipoFactor' => 'Exento', 'TasaOCuota' => '0.00', 'Importe' => '00'],
                            ]
                        ],
                        'Complemento' => [
                            0 => [
                                'typeComplement' => 'iedu',
                                'nombreAlumno' => $request->input('NombreAlumno'),
                                'CURP' => $request->input('Curp'),
                                'nivelEducativo' => $request->input('NivelEducativo'),
                                'autRVOE' => $request->input('RVOE'),
                                'rfcPago' => $request->input('RFCPago'),               
                            ]
                        ]
                    )
                );
            }
            unset($Conceptos[0]);
        
            //$Receptor = $request->input('Receptor');
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
                "InvoiceComments" => ""
            ];

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

	/**
     * Crear CFDI 
	 * @param Request $request
     * @return response
     */
	public function crearCFDICreditNote(Request $request)
    {
         $id = $request->input('id');

        //Verificar si la factura ya existe
        $invoice_ext = InvoiceExt::where('id', $id)->first();

        if ($invoice_ext->status == 1)
        {
            $response = array();
            $response["message"] = 'La factura ya fue generada anteriormente.';
            
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
            
            //Validar existencia de receptor UID 
            $cliente_rfc = $request->input('RFC');
			
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "content-type: application/json",
                "f-plugin: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
                "f-api-key: ".$apiKey,
                "f-secret-key: " .$secretKey
            ));
            $response = curl_exec($ch);

			$json = json_decode($response);
			//dd($cliente_rfc);

			if ($json->status == "error") {
				curl_close($ch);
				return die($response);
			}
			else {
				//--------------- CREAR CFDI --------------------- //
				$Conceptos[] = array();

				//Obtener los conceptos asociados a la factura
				$Concepts = ConceptsInvoice::all()->where('invoice_ext_id', '=', $id);

				//Recorrer los conceptos y agregar unicamente la información de utilidad
				foreach($Concepts as $concept)
				{
					//dd($concept);
					array_push(
						$Conceptos,
						array(
							'ClaveProdServ' => $concept -> clave_sat,
							'Cantidad' => $concept -> cantidad,
							'ClaveUnidad' => $concept -> claveunidad,
							'Unidad' => $concept -> unidad,
							'ValorUnitario' => $concept -> precio_unitario,
							'Descripcion' => $concept -> descripcion,
							'Descuento' => $concept -> descuento,
							'Impuestos' => [
								'Traslados' => [
                                    ['Base' => '100', 'Impuesto' => '002', 'TipoFactor' => 'Exento', 'TasaOCuota' => '0.00', 'Importe' => '00'],
                                ]
							],
						)
					);
				}
				unset($Conceptos[0]);
				$TipoDocumento = $request->input('TipoDocumento');
				$UsoCFDI = $request->input('UsoCFDI');
				$FormaPago = $request->input('FormaPago');
				$MetodoPago = $request->input('MetodoPago');
				$Moneda = $request->input('Moneda');
				$CondicionesDePago = $request->input('CondicionesDePago');
				$Serie = $request->input('Serie');

				$ch = curl_init();
				$fields = [
					"Receptor" => ["UID" => $json->Data->UID],
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
					"InvoiceComments" => "Nota de crédito",
					"CfdiRelacionados" => [
						"TipoRelacion" => $request->input('relation_type'),
						"UUID" => [
							$request->input('CFDIRel')
						]
					]
				];

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
    }


	/**
     * Listar CFDI Masivo
	 * @param int $server_api
	 * @param string $id_massive_invoice
     * @return response
     */
    public function massive($server_api, $id_massive_invoice)
    {
        $Invoices = InvoiceExt::all()
			->where('id_massive_invoice', '=', $id_massive_invoice)
			->where('status', '=', 0);
        return \View::make('MassiveInvoice')->with('Invoices', $Invoices);
    }

	/**
     * Generar CFDI Masivo
	 * @param int $server_api
	 * @param string $id_massive_invoice
     * @return response
     */
    public function createCFDIMassive($server_api, $id_massive_invoice)
    {
		//Obtener facturas
        $Invoices = InvoiceExt::all()
			->where('id_massive_invoice', '=', $id_massive_invoice)
			->where('status', '=', 0);

		//Inicializar respuesta
		$Responses[] = array();
		$Conceptos[] = array();
		$Contador = 0;

		//Recorrer las facturas para generarlas
		foreach($Invoices as $invoice_ext)
		{
			//Verificar si la factura ya existe
			if ($invoice_ext->status == 1)
			{
				$Responses["message"] = 'La factura '.$invoice_ext->folio.' ya existe.';
			} 
			else {
				//Validar existencia de receptor UID 
				$cliente_rfc = $invoice_ext->rfc;
				//dd($cliente_rfc);
				$this->returnValueAPI($server_api);
				$UrlConsultaCliente;

				//Verificar Servidor para obtener los datos de conexión
				switch ($server_api) {
					case "1": //sandbox
						$UrlConsultaCliente = 'http://devfactura.in/api/v1/clients/';
						break;
					case "2": //producción
						$UrlConsultaCliente = 'https://factura.com/api/v1/clients/';
						break;
				}

				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_HEADER, false);

				curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"content-type: application/json",
					"f-plugin: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
					"f-api-key: ".$this->apiKey,
					"f-secret-key: " .$this->secretKey
				));
				$res = curl_exec($ch);

				$json = json_decode($res);

				if ($json->status == "error") {
					curl_close($ch);
					array_push(
						$Responses,
						array(
							'Response' =>  $res,
							'RFC' => $invoice_ext->rfc,
							'Id' => $invoice_ext->id 
						)
					);
				}
				else {
					//Obtener los conceptos asociados a la factura
					$Concepts = ConceptsInvoice::all()->where('invoice_ext_id', '=', $invoice_ext->id);

					//Recorrer los conceptos y agregar unicamente la información de utilidad
					foreach($Concepts as $concept)
					{
						$Contador ++;
						array_push(
							$Conceptos,
							array(
								'ClaveProdServ' => $concept -> clave_sat,
								'Cantidad' => $concept -> cantidad,
								'ClaveUnidad' => $concept -> claveunidad,
								'Unidad' => $concept -> unidad,
								'ValorUnitario' => $concept -> precio_unitario,
								'Descripcion' => $concept -> descripcion,
								'Descuento' => $concept -> descuento,
								'Impuestos' => [
									'Traslados' => [
                                        ['Base' => '100', 'Impuesto' => '002', 'TipoFactor' => 'Exento', 'TasaOCuota' => '0.00', 'Importe' => '00'],
                                    ]
								],
							)
						);
					}
					if ($Contador == 1){
						unset($Conceptos[0]);
					}

					$ch = curl_init();
					$fields = [
						"Receptor" => ["UID" => $json->Data->UID],
						"TipoDocumento" => "factura", //modificar
						"UsoCFDI" => $invoice_ext->uso_cfdi,
						"Redondeo" => 2,
						"Conceptos" => $Conceptos,
						"FormaPago" => $invoice_ext->forma_pago,
						"MetodoPago" => $invoice_ext->metodo_pago,
						"Moneda" => "MXN",
						"CondicionesDePago" => $invoice_ext->condicion_pago,
						"Serie" => $invoice_ext->serie,
						"EnviarCorreo" => 'true',
						"InvoiceComments" => "Facturación masiva"
					];

					$this->Endpoint = '/api/v3/cfdi33/create';

					$jsonfield = json_encode($fields);
					//var_dump($jsonfield);
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $this->Host.$this->Endpoint);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
					curl_setopt($ch, CURLOPT_HEADER, FALSE);
					curl_setopt($ch, CURLOPT_POST, TRUE);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonfield);

					curl_setopt($ch, CURLOPT_HTTPHEADER, array(
					"Content-Type: application/json",
						"F-PLUGIN: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
						"F-Api-Key: ".$this->apiKey,
						"F-Secret-Key: ".$this->secretKey
					));

					$response = curl_exec($ch);
					array_push(
						$Responses,
						array(
							'Response' => $response,
							'RFC' => $invoice_ext->rfc,
							'Id' => $invoice_ext->id 
						)
					);
					curl_close($ch);
					//Limpiar arreglo
					unset($Conceptos);
					$Conceptos = array();
				}
			}//Fin else
		}//Fin foreach
		return response()->json($Responses, 200);
    }

	/**
     * Actualizar el registro relacionado a la factura generada
	 * @param Request $request
     * @return 
     */
	public function actualizarRegistroFactura(Request $request)
    {
        $invoice_ext = InvoiceExt::where('id', $request->input('id'))->first();

        if ($invoice_ext != null)
        {
            //Insertar en tabla de Invoice_ext
            $invoice_ext->update(['status' => 1]);
            $invoice_ext->update(['uuid' => $request->input('uuid')]);
            $invoice_ext->update(['folio' => $request->input('folio')]);
            $invoice_ext->update(['fecha_timbrado' => $request->input('fechatimbrado')]);
            $invoice_ext->update(['num_cert' => $request->input('nocertificadosat')]);
			$invoice_ext->update(['tipo_comprobante' => $request->input('serie')]);
			
        }
    }

	/**
     * Actualizar los registros de los recibos facturados
	 * @param Request $request
     * @return 
     */
	public function actualizarRegistroRecibos(Request $request)
    {
		//Obtener los recibos asociados a la factura
		//$Concepts = PayRecipments::all()->where('id_global_invoice', '=', $request->input('id'));		
			$Concepts = PayRecipments::all()->where('invoice_ext_id', '=', $request->input('id'));	
		//Recorrer los conceptos y agregar unicamente la información de utilidad
		foreach($Concepts as $concept)
		{
			$concept->update(['invoiced' => TRUE]);
		}
    }

	/**
     * Actualizar los registros relacionados a la facturas generadas
	 * @param Request $request
     * @return 
     */
	public function actualizarRegistrosFacturas(Request $request)
    {
		dd($request);
        /*$invoice_ext = InvoiceExt::where('id', $request->input('id'))->first();

        if ($invoice_ext != null)
        {
            //Insertar en tabla de Invoice_ext            
            $invoice_ext->update(['status' => 1]);
            $invoice_ext->update(['uuid' => $request->input('uuid')]);
            $invoice_ext->update(['folio' => $request->input('folio')]);
            $invoice_ext->update(['fecha_timbrado' => $request->input('fechatimbrado')]);
            $invoice_ext->update(['num_cert' => $request->input('nocertificadosat')]);
        }*/
    }

	/* -------------------------------- Falta depurar ---------------------------------------- */
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

        //$concepts = PayRecipments::where('id_global_invoice', $id)->get();
        $concepts = PayRecipments::where('invoice_ext_id', $id)->get();
        
        $invoice = ['data' => $data, 'concepts' => $concepts];
        //dd($invoice);
        return view('createInvoiceGlobal', compact('invoice'));
    }

	/**
     * Crear CFDI Global
	 * @param Request $request
     * @return response
     */
	public function crearCFDIGlobal(Request $request)
    {
        $id = $request->input('id');

        //Verificar si la factura ya existe
        $invoice_ext = InvoiceExt::where('id', $id)->first();

        if ($invoice_ext->status == 1)
        {
            $response = array();
            $response["message"] = 'La factura ya fue generada anteriormente.';
            
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
            
            //Validar existencia de receptor UID 
            $cliente_rfc = $request->input('RFC');
			
            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $UrlConsultaCliente.$cliente_rfc);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HEADER, false);

            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                "content-type: application/json",
                "f-plugin: " . '9d4095c8f7ed5785cb14c0e3b033eeb8252416ed',
                "f-api-key: ".$apiKey,
                "f-secret-key: " .$secretKey
            ));
            $response = curl_exec($ch);

			$json = json_decode($response);

			if ($json->status == "error") {
				curl_close($ch);
				return die($response);
			}
			else {
				//--------------- CREAR CFDI --------------------- //
				$ClaveProdServ = "86121701";
				$Cantidad = 1;
				$ClaveUnidad = "ACT";
				$ValorUnitario = $request->input('to_pay');
				$Descripcion = "Recibo: ".$request->input('id');
				$Descuento = $request->input('discount');
				/*$Impuesto = $request->input('Impuesto');
				$TipoFactor = $request->input('TipoFactor');
				$TasaOCuota = $request->input('TasaOCuota');
				$Importe = $request->input('Importe');*/

				$Conceptos[] = array();

				//Obtener los conceptos asociados a la factura
				//$Concepts = PayRecipments::all()->where('id_global_invoice', '=', $id);		
				$Concepts = PayRecipments::all()->where('invoice_ext_id', '=', $id);
				//Recorrer los conceptos y agregar unicamente la información de utilidad
				foreach($Concepts as $concept)
				{
					array_push(
						$Conceptos,
						array(
							//'ClaveProdServ' => "86121701",
							'ClaveProdServ' => $concept -> clave_sat,
							'Cantidad' => '1',
							'ClaveUnidad' => "ACT",
							'Unidad' => "Actividad",
							'ValorUnitario' => $concept -> to_pay,
							'Descripcion' => "No. Recibo: ".$concept -> folio,
							'Descuento' => $concept -> discount,
							'Impuestos' => [
								'Traslados' => [
                                    ['Base' => '100', 'Impuesto' => '002', 'TipoFactor' => 'Exento', 'TasaOCuota' => '0.00', 'Importe' => '00'],
                                ]
							],
						)
					);
				}

				unset($Conceptos[0]);
            
				//$Receptor = $request->input('Receptor');
				$TipoDocumento = $request->input('TipoDocumento');
				$UsoCFDI = $request->input('UsoCFDI');
				$FormaPago = $request->input('FormaPago');
				$MetodoPago = $request->input('MetodoPago');
				$Moneda = $request->input('Moneda');
				$CondicionesDePago = $request->input('CondicionesDePago');
				$Serie = $request->input('Serie');
            
				$ch = curl_init();
				$fields = [
					"Receptor" => ["UID" => $json->Data->UID],
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
					"InvoiceComments" => "Factura Global"
				];

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
}
