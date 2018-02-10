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

    $EmployeeActivity = new EmployeeActivity();

    $EmployeeActivity->employee_id = $request->input('id');
    $EmployeeActivity->ipAddress = $request->input('ip');
    $EmployeeActivity->macAddress = $request->input('mac');
    $EmployeeActivity->pcName = $request->input('pcName');
    $EmployeeActivity->save();
    $this->last = $EmployeeActivity->id;

      return redirect('/employee')->with('success',$this->last);
    }

    public function update(Request $request){

      // $EmployeeActivity = EmployeeActivity::find($id);
      // $EmployeeActivity->save();
      //
      // return redirect('/employee')->with('success','STOPPED');
      return $this->last;

    }
}
