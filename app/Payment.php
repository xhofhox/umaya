<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";

    protected $fillable = array('subconcept_assign_id', 'amount', 'payment_method_id', 'date', 'description', 'adjustment_description', 'transfer_description','created_at','updated_at','status','student_id','invoice_id','reference','cajero','cycle_id','ciclo','subciclo','campus','matricula');	
    
}
