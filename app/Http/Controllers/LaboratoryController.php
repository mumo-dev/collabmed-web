<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;

class LaboratoryController extends Controller
{
    public function index()
    {
        return view('laboratory.index');
    }

    public function showVisit($id)
    {
        $visit = Visit::with(['patient','referrals'])->findorFail($id);
        return view('laboratory.visit', compact('visit'));
    }
}
