<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;

class RadiologyController extends Controller
{
    public function index()
    {
        return view('radiology.index');
    }

    public function showVisit($id)
    {
        $visit = Visit::with(['patient','referrals'])->findorFail($id);
        return view('radiology.visit', compact('visit'));
    }


    public function referrals()
    {
        return view('radiology.referrals');
    }

    public function showReferral($id)
    {
        $referral =Referral::with(['patient','referredBy'])->findorFail($id);
        
        if($referral->department == 'optical'){
            return view('radiology.referral', compact('referral'));
        }else {
            \abort(404);
        }

    }
}
