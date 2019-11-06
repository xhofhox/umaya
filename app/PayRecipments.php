<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayRecipments extends Model
{
    //
        protected $table = "pay_recipments";

		protected $primaryKey = 'id';

		protected $fillable = array
		(
			'id',
                        'folio',
			'payment_id',
			'to_pay',
			'discount',
			'scholarship_id',
			'created_at',
			'updated_at',
			'scholarship_validation',
                        'invoiced',
			//'id_global_invoice'
                        'invoice_ext_id',
                        'clave_sat',
			
		);	
}
