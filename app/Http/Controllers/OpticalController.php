<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;

class OpticalController extends Controller
{
    public function index()
    {
        return view('optical.index');
    }

    public function showVisit($id)
    {
        $visit = Visit::with(['patient','referrals'])->findorFail($id);
        return view('optical.visit', compact('visit'));
    }


    public function referrals()
    {
        return view('optical.referrals');
    }

    public function showReferral($id)
    {
        $referral =Referral::with(['patient','referredBy'])->findorFail($id);
        
        if($referral->department == 'optical'){
            return view('optical.referral', compact('referral'));
        }else {
            \abort(404);
        }

    }
}
