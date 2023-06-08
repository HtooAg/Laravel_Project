<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

class UserController extends Controller
{
    public function show() {
        return view('student.profile', ['student' => Student::findorFail($id)]);
    }
}