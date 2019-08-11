<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ConceptsInvoice extends Model
{
    protected $table = "invoices_ext";
    
    protected $primaryKey = 'id';

     protected $fillable = array  ('id',  'invoice_ext_id', 'descripcion', 'cantidad, unidad',  'precio_unitario', 'subtotal',  'traslado_id',  'retencion_id',  'locales_id,  descuento',  'aduana_state',  'sku',  'clave_sat',  'cuenta_predial');
}
