<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Visit;
use App\Referral;
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
        $visit = Visit::with(['patient','referrals'])->findorFail($id);
        return view('treatment.visit', compact('visit'));
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

    public function savePatientNotes(Request $request)
    {
        $visit = Visit::find($request->visitId);
        $visit->notes = $request->notes;
        $visit->seen_by = auth()->user()->id;
        $visit->save();

        return response()->json([], 200);
    }


    public function saveReferral(Request $request)
    {
        Referral::create([
            'patient_id'=>$request->patientId,
            'visit_id'=>$request->visitId,
            'department'=>$request->department,
            'referred_by'=>auth()->user()->id,
            'notes'=>$request->notes
        ]);

        return response()->json([
            'message'=>'Referral sent successfully'
        ], 201); 
    }
}
