<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PayRecipments extends Model
{
    //
        protected $table = "pay_recipments";

    protected $fillable = array
    (
    'id',
    'payment_id',
    'to_pay',
    'discount',
    'scholarship_id',
    'created_at',
    'updated_at',
    'scholarship_validation',
    'invoiced',
    'id_global_invoice' 
    );	
    
    
}
