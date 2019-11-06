<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInvoiceApi extends Model
{
    //
    protected $table = "user_invoice_api";

    protected $fillable = array
    (
    'id',
    'rfc'
    'uuid',
    'alias'
    );	
}
