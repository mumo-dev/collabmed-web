<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;

class NursingController extends Controller
{
    public function index()
    {
        return view('nursing.index');
    }

    public function showVisit($id)
    {
        $visit = Visit::with(['patient','referrals'])->findorFail($id);
        return view('nursing.visit', compact('visit'));
    }


    public function referrals()
    {
        return view('nursing.referrals');
    }

    public function showReferral($id)
    {
        $referral =Referral::with(['patient','referredBy'])->findorFail($id);
        
        if($referral->department == 'optical'){
            return view('nursing.referral', compact('referral'));
        }else {
            \abort(404);
        }

    }
}
