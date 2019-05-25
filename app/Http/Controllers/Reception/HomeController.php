<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;
use App\Visit;

class HomeController extends Controller
{
    public function index()
    {
        return view('reception.home');
    }

    public function createPatient()
    {
        return view('reception.add-patient');
    }

    public function storePatient(Request $request)
    {
        $this->validate($request, [
            'name'=>'required|string',
            'age'=>'required|numeric',
            'gender'=>'required|string'
        ]);

        $patient = Patient::create($request->only(['name','age', 'gender']));
        return response()->json([
            'message'=>'Patient saved successfully',
            'patient'=>$patient
        ], 201);
    }


    public function fetchPatient($id)
    {
        $patient =Patient::find($id);
        if($patient == null){
            return response()->json([
                'message'=>'Oops (:- Patient Not Found'
            ], 404); 
        }else {
            return response()->json($patient, 200);
        }
    }


    public function recordVisit(Request $request)
    {
        $this->validate($request, [
            'patientId'=>'required|numeric',
            'department'=>'required|string'
        ]);

        Visit::create([
            'patient_id'=> $request->patientId,
            'department'=>$request->department,
            'checked_in_by'=> auth()->user()->id
        ]);

        return response()->json([
            'message'=>'Patient Successfully Checked In'
        ], 201); 

    }
}
