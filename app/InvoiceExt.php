<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceExt extends Model
{
    protected $table = "invoices_ext";
    
    protected $primaryKey = 'id';

    protected $fillable = array('id', 'uuid', 'folio', 'num_cert', 'tipo_comprobante', 'fecha_timbrado', 'condicion_pago', 'lugar_expedicion', 'regimen_fiscal', 'emisor_rfc', 'emisor_nombre', 'receptor_rfc', 'receptor_nombre', 'unidad_medida', 'uso_cfdi', 'clave_prodServ', 'total_facturado', 'clave_impuesto', 'metodo_pago', 'forma_pago_id', 'student_id', 'xml_file', 'pdf_file', 'error', 'created_at', 'updated_at', 'relatedUUID', 'serie', 'razonsocial', 'RFC', 'Calle', 'Numero', 'Interior', 'Colonia', 'CodigoPosal', 'Ciudad', 'Delegacion', 'Estado', 'NumRegIdTrib', 'Nombre', 'Apellidos', 'Email', 'Telefono', 'ClaveProdServ', 'cantidad', 'ClaveUnidad', 'Unidad', 'valorunitario', 'descripcion', 'Descuento', 'Tipo_Impuestos', 'monto_impuesto', 'nombre_alumno', 'curp', 'roev', 'status');	
    
}

