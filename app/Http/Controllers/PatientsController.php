<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;

class PatientsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getPatientsDepartment($department)
    {
        $visits =Visit::with(['patient'])
                    ->where('department', $department)
                    ->where('seen', false)
                    ->get();
        return $visits;
    }

    public function patienSeen(Request $request)
    {
        $visit = Visit::find($request->visitId);
        $visit->seen = true;
        $visit->notes = $request->notes;
        $visit->seen_by = auth()->user()->id;
        $visit->save();

        return response()->json([], 200);
    }

    public function getReferredPatients($department)
    {
        $referrals =Referral::with(['patient'])
                ->where('department', $department)
                ->where('seen_by',null)
                ->get();
        return $referrals;
    }


    public function patientReferralReport(Request $request)
    {
        $referral = Referral::find($request->referralId);
        $referral->reports = $request->report;
        $referral->seen_by = auth()->user()->id;
        $referral->save();

        return response()->json([], 200);
    }


   
}

