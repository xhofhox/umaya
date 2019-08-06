<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceExt extends Model
{
    protected $table = "sat_catalogs";
    
    protected $primaryKey = 'id';

    protected $fillable = array('id', 'key', 'description', 'catalog', 'orden');	
    
}

