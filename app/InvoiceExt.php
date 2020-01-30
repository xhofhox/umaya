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
		//'receptor_rfc', 
		//'receptor_nombre', 
		//'unidad_medida', 
		'uso_cfdi', 
		//'clave_prodServ', 
		'total_facturado', 
		//'clave_impuesto', 
		'metodo_pago', 
		'forma_pago_id', 
		'student_id', 
		'xml_file', 
		'pdf_file', 
		'error', 
		'created_at', 
		'updated_at', 
		'relateduuid',
		'relation_type', 
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
		'uid',
		'id_massive_invoice',
		'forma_pago'
	);

	protected $appends = [
		'val_uso_cfdi',
		'val_forma_pago',
		'val_metodo_pago',
		'val_producto_servicio',
		'val_status'
	];
    
    function getValUsoCfdiAttribute()
    {
        $name;
        switch($this->uso_cfdi)
        {
			case "G01":
                $name = "G01 Adquisición de mercancias";  break;

				//	...
            case "G02": $name = "G02 Devoluciones, descuentos o bonificaciones"; break;
            case "G03": $name = "G03 Gastos en general"; break;
            case "I01": $name = "I0I Construcciones"; break;
            case "I02": $name = "I02 Mobilario y equipo de oficina por inversiones"; break;
            case "I03": $name = "I03 Equipo de transporte"; break;
            case "I04": $name = "I04 Equipo de computo y accesorios"; break;
            case "I05": $name = "I05 Dados, troqueles, moldes, matrices y herramental"; break;
            case "I06": $name = "I06 Comunicaciones telefónicas"; break;
            case "I07": $name = "I07 Comunicaciones satelitales"; break;
            case "I08": $name = "I08 Otra maquinaria y equipo"; break;
            case "D01": $name = "D01 Honorarios médicos, dentales y gastos hospitalarios."; break;
            case "D02": $name = "D02 Gastos médicos por incapacidad o discapacidad"; break;
            case "D03": $name = "D03 Gastos funerales."; break;
            case "D04": $name = "D04 Donativos."; break;
            case "D05": $name = "D05 Intereses reales efectivamente pagados por créditos hipotecarios (casa habitación)."; break;
            case "D06": $name = "D06 Aportaciones voluntarias al SAR."; break;
            case "D07": $name = "D07 Primas por seguros de gastos médicos."; break;
            case "D08": $name = "D08 Gastos de transportación escolar obligatoria."; break;
            case "D09": $name = "D09 Depósitos en cuentas para el ahorro, primas que tengan como base planes de pensiones."; break;
            case "D10": $name = "D10 Pagos por servicios educativos (colegiaturas)"; break;
            case "P01": $name = "P01 Por definir"; break;
                // ...

            default:
                $name = "Pagos por servicios educativos (colegiaturas)";
                break;
        }
        return $name;
    }


	function getValFormaPagoAttribute()
    {
        $name;
        switch($this->forma_pago)
        {
          
            case "01": $name = "01 Efectivo"; break;
            case "02": $name = "02 Cheque nominativo"; break;
            case "03": $name = "03 Transferencia electrónica de fondos"; break;
            case "04": $name = "04 Tarjeta de crédito"; break;
            case "05": $name = "05 Monedero electrónico"; break;
            case "06": $name = "06 Dinero electrónico"; break;
            case "08": $name = "08 Vales de despensa"; break;
            case "12": $name = "12 Dación en pago"; break;
            case "13": $name = "13 Pago por subrogación"; break;
            case "14": $name = "14 Pago por consignación"; break;
            case "15": $name = "15 Condonación"; break;
            case "17": $name = "17 Compensación"; break;
            case "23": $name = "23 Novación"; break;
            case "24": $name = "24 Confusión"; break;
            case "25": $name = "25 Remisión de deuda"; break;
            case "26": $name = "26 Prescripción o caducidad"; break;
            case "27": $name = "27 A satisfacción del acreedor"; break;
            case "28": $name = "28 Tarjeta de débito"; break;
            case "29": $name = "29 Tarjeta de servicios"; break;
            case "30": $name = "30 Aplicación de anticipos"; break;
            case "31": $name = "31 Intermediario pagos"; break;
            case "99": $name = "99 Por definir"; break; 

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

	function getValProductoServicioAttribute()
    {
        $name;
        switch($this->claveprodserv)
        {
            case "86121701":
                $name = "Programas de pregrado";
                break;
            case "86121702":
                $name = "Programas de posgrado";
                break;
				//	...

            default:
                $name = "Programas de posgrado";
                break;
        }
        return $name;
    }

	function getValStatusAttribute()
    {
        $name;
        switch($this->status)
        {
            case 0:
                $name = "Pendiente";
                break;
            case 1:
                $name = "Facturado";
                break;
				//	...

            default:
                $name = "Pendiente";
                break;
        }
        return $name;
    }

}

