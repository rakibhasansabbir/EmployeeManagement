<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\EmployeeActivity;

class EmployeeLoginController extends Controller
{
    public function __construct(){

        $this->middleware('guest:employee');
    }

    public function showLoginForm(){
        return view('auth.employee-login');
    }

    public function login(Request $request){

        //form validate
        $this->validate($request,[
           'email' => 'required|email',
           'password' => 'required|min:6',
        ]);

       if ( Auth::guard('employee')->attempt(['email' => $request->email,
           'password' => $request->password], $request->remember)){
             $Activity = EmployeeActivity::all();
           return redirect()->intended(route('employee.dashboard'));
       }

       return redirect()->back()->withInput($request->only('email', 'remember'));
    }


}
