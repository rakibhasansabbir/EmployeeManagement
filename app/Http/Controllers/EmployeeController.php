<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeActivity;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:employee');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

     private $last;
    public function index()
    {
        return view('employee');
    }

    public function store(Request $request)
    {

      $this->validate($request,[
        'id'=> 'required',

        'ip'=>'required',

        'mac'=> 'required',
        'pcName'=> 'required',
    ]);
    $EmployeeActivity = EmployeeActivity::where('employee_id', $request->input('id'))
    ->where( 'stay', 'YES')
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

        return redirect('/employee')->with('success','Welcome to our company your time start now');


  }

    public function update(Request $request){
      $EmployeeActivity = EmployeeActivity::where('employee_id', $request->input('id'))
      ->whereDate( 'created_at', '2018-02-11')
      ->get();

      foreach ($EmployeeActivity as $emp) {
        $Activity = EmployeeActivity::find($emp->id);

        $Activity->stay = "NO";
        $Activity->employee_id =$request->input('id');
        $Activity->ipAddress = $request->input('ip');
        $Activity->macAddress = $request->input('mac');
        $Activity->pcName = $request->input('pcName');
        $Activity->save();
      }

      return redirect('/employee')->with('success','Thanks for stay here ');
    }
}
