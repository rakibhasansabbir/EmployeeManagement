<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeActivity;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct()
     {
         $this->middleware('auth');
     }

    public function index()
    {
      $Activity = EmployeeActivity::all();
      return view('activityTable')->with('Activities',$Activity);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request,[
         'name'=> 'required',

         'email'=>'required|unique:employees,email',

         'contactNumber'=> 'required|unique:employees,contactNumber',
         'dateOfBirth'=> 'required',
         'password'=> 'required'
     ]);



     //create post
     $Employee = new Employee();

     $Employee->designation = $request->input('designation');
     $Employee->department = $request->input('department');
     $Employee->name = $request->input('name');
     $Employee->email = $request->input('email');
     $Employee->password = bcrypt($request->input('password'));
     $Employee->contactNumber = $request->input('contactNumber');
     $Employee->dateOfBirth = $request->input('dateOfBirth');

     // $request['password'] = bcrypt($request->password);

     $Employee->save();
     return redirect('/home')->with('success','Employee Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $SingleEmployee = Employee::find($id);
    return view('edit_employee')->with('SingleEmployee',$SingleEmployee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $this->validate($request,[
        'name'=> 'required',

        'email'=>'required',

        'contactNumber'=> 'required',
        'dateOfBirth'=> 'required',
        'password'=> 'required'
    ]);



    // //create post
      $Employee = Employee::find($id);

    $Employee->designation = $request->input('designation');
    $Employee->department = $request->input('department');
    $Employee->name = $request->input('name');
    $Employee->email = $request->input('email');
    $Employee->password = bcrypt($request->input('password'));
    $Employee->contactNumber = $request->input('contactNumber');
    $Employee->dateOfBirth = $request->input('dateOfBirth');
    $Employee->save();

    return redirect('/home')->with('success','Employee Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $Employee = Employee::find($id);
      $Employee->delete();
      return redirect('/home')->with('success','Employee Deleted');
    }
}
