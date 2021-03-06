<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function redirectTo()
    {
        $type =auth()->user()->department;

        switch($type){
            case 'admin': 
                return '/admin';

            case 'reception':
                return '/reception';

            case 'treatment':
                return '/treatment'; 

            case 'laboratory':
                return '/laboratory'; 

            case 'optical':
                return '/optical'; 

            case 'nursing':
                return '/nursing'; 

            case 'radiology':
                return '/radiology'; 

            default:
                return '/home';
        }
    
    }
}
