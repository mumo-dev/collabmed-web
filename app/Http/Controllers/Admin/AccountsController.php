<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;
class AccountsController extends Controller
{
    public function index()
    {
        $users = User::where('department','!=','admin')->get();
        return view('admin.accounts.index', compact('users'));
    }


    public function create()
    {
        return view('admin.accounts.create');
    }

    
    public function store(Request $request)
    {

        $this->validate($request,[
            'name'=>'required|string',
            'email'=>'required|string|email|unique:users',
            'password'=>'required|string|min:8|confirmed',
            'department'=>'required|string' 
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department'=>$request->department
        ]);

        return redirect()->route('admin.accounts');
    }

}
