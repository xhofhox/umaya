<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    protected $table = "vouchers";
    protected $primaryKey = 'id';
    protected $fillable = ['student_id', 'bank_number','referencia_voucher', 'status', 'amount','bank_id', 'concept_id', 'subconcept_assign_id', 'group_id', 'career_id', 'campus', 'fecha', 'cycle_id'];

}
