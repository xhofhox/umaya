<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = "students";
	
	protected $fillable = array('student_id', 'name', 'last_name', 'second_lastname', 'email');
}

