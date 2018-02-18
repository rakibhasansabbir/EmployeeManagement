<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */




     private $value;
     private $Time = "click to start";
//     $_SESSION['variable'] = "rakib";



    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        date_default_timezone_set("Asia/Dhaka");
        $this->value = EmployeeActivity::where('employee_id', Auth::user()->id)->get();
//        global $value;

//        Session::('value',$this->Time);
        $_SESSION['variable'] = "new man";

        return view('employee')
            ->with('Activities', $this->value)
            ->with('time', $this->Time);
    }

    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        $this->validate($request,[
            'id'=> 'required',
            'ip'=>'required',
            'mac'=> 'required',
            'pcName'=> 'required',
        ]);
        $EmployeeActivity = EmployeeActivity::where('employee_id', $request->input('id'))
            ->where( 'stay', 'YES')
            ->whereDate( 'created_at', date("Y-m-d"))
            ->get();
        foreach ($EmployeeActivity as $emp) {
            return redirect('/employee')->with('error','You Already in press STOPPED button to leave');
        }
        $EmployeeActivity = new EmployeeActivity();
        $EmployeeActivity->stay = "YES";
        $EmployeeActivity->employee_id = $request->input('id');
        $EmployeeActivity->ipAddress = $request->input('ip');
        $EmployeeActivity->macAddress = $request->input('mac');
        $EmployeeActivity->pcName = $request->input('pcName');
        $EmployeeActivity->save();
        $Time = EmployeeActivity::where('employee_id', $request->input('id'))
            ->whereDate( 'created_at', date("Y-m-d"))
            ->get();
        foreach ($Time as $time){
            $InTime = $time->created_at;
        }
        return redirect('employee')
            ->with('success','Welcome to our company your time start now')
            ->with('Activities', $this->value)
            ->with('time', date('M d, Y H:i:s'));
    }

    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");


        $EmployeeActivity = EmployeeActivity::where('employee_id', $request->input('id'))
            ->whereDate('created_at', date("Y-m-d"))
            ->get();

        foreach ($EmployeeActivity as $emp) {
            $Activity = EmployeeActivity::find($emp->id);

            $Activity->stay = "NO";
            $Activity->employee_id = $request->input('id');
            $Activity->ipAddress = $request->input('ip');
            $Activity->macAddress = $request->input('mac');
            $Activity->pcName = $request->input('pcName');
            $Activity->save();
        }

        return redirect('/employee')->with('success', 'Thanks for stay here ');
    }
}
