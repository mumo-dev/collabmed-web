<?php

namespace App\Http\Controllers\Reception;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Patient;

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
            'message'=>'Patient saved successfully'
        ]);
    }
}
