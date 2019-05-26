<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Visit;

class HomeController extends Controller
{
    public function index()
    {
       return view('admin.home');
    }

    public function reports()
    {
       return view('admin.reports');
    }

    public function fetchReport($id)
    {
      $visits= Visit::with(['patient'])
                ->where('patient_id',$id)
                ->where('seen',1)
                ->latest()
                ->get();
      return $visits;
    }

    public function showReport($id)
    {
      $visit= Visit::with(['patient','referrals','medicalPractitioner'])->findorFail($id);
      return view('admin.report', compact('visit'));
    }


    public function allVisits()
    {
      $visits = Visit::with('patient')->where('seen',1)->latest()->get();
      return $visits;
    }
}
