<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreatmentController extends Controller
{
    public function index()
    {
        return view('treatment.index');
    }
}
