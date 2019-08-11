<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        return view('index', compact('students'));
    }
}
