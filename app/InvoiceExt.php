<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceExt extends Model
{    
    protected $table = "invoices_ext";
    
    protected $primaryKey = 'id';

    protected $fillable = array(
		'id', 
		'uuid', 
		'folio', 
		'num_cert', 
		'tipo_comprobante', 
		'fecha_timbrado', 
		'condicion_pago', 
		'lugar_expedicion', 
		'regimen_fiscal', 
		'emisor_rfc', 
		'emisor_nombre', 
		'receptor_rfc', 
		'receptor_nombre', 
		'unidad_medida', 
		'uso_cfdi', 
		'clave_prodServ', 
		'total_facturado', 
		'clave_impuesto', 
		'metodo_pago', 
		'forma_pago_id', 
		'student_id', 
		'xml_file', 
		'pdf_file', 
		'error', 
		'created_at', 
		'updated_at', 
		'relatedUUID', 
		'serie', 
		'razonsocial', 
		'RFC', 
		'Calle', 
		'Numero', 
		'Interior', 
		'Colonia', 
		'CodigoPosal', 
		'Ciudad', 
		'Delegacion', 
		'Estado', 
		'NumRegIdTrib', 
		'Nombre', 
		'Apellidos', 
		'Email', 
		'Telefono', 
		'claveprodserv', 
		'cantidad', 
		'ClaveUnidad', 
		'Unidad', 
		'valorunitario', 
		'descripcion', 
		'Descuento', 
		'Tipo_Impuestos', 
		'monto_impuesto', 
		'nombre_alumno',
		'curp', 
		'roev',
		'status',
		'uid'
	);

	protected $appends = [
		'val_uso_cfdi',
		'val_forma_pago',
		'val_metodo_pago'
	];
    
    function getValUsoCfdiAttribute()
    {
        $name;
        switch($this->uso_cfdi)
        {
			case "G01":
                $name = "Adquisición de mercancias";
                break;

				//	...

            case "D10":
                $name = "Pagos por servicios educativos (colegiaturas)";
                break;
            default:
                $name = "Pagos por servicios educativos (colegiaturas)";
                break;
        }
        return $name;
    }


	function getValFormaPagoAttribute()
    {
        $name;
        switch($this->forma_pago_id)
        {
            case "01":
                $name = "01 Efectivo";
                break;

				//	...

            default:
                $name = "01 Efectivo";
                break;
        }
        return $name;
    }

	function getValMetodoPagoAttribute()
    {
        $name;
        switch($this->metodo_pago)
        {
            case "PUE":
                $name = "PUE Pago en una sola exhibición";
                break;
			case "PPD":
                $name = "PPD Pago en parcialidades o diferido";
                break;
            default:
                $name = "PUE Pago en una sola exhibición";
                break;
        }
        return $name;
    }

}

