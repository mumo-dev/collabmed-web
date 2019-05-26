<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;

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


    public function referrals()
    {
        return view('laboratory.referrals');
    }

    public function showReferral($id)
    {
        $referral =Referral::with(['patient','referredBy'])->findorFail($id);
        
        if($referral->department == 'laboratory'){
            return view('laboratory.referral', compact('referral'));
        }

    }
}
