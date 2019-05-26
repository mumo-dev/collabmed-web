<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;

class TreatmentController extends Controller
{
    public function index()
    {
        return view('treatment.index');
    }

    public function fetchPatients()
    {
        $visits =Visit::with(['patient'])
                    ->where('department', 'treatment')
                    ->where('seen', false)
                    ->get();
        return $visits;
    }


    public function showVisit($id)
    {
        $visit = Visit::findorFail($id);
        return view('treatment.visit', compact('visit'));
    }
}
