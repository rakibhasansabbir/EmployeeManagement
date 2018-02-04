<?php

namespace App\Http\Controllers;

use App\EmployeeInfo;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('adminPages.login');
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
        //field validate
        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required',
            'contactNumber'=> 'required',
            'dob'=> 'required',
            'password'=> 'required'
        ]);



        //create post
        $EmployeeInfo = new EmployeeInfo();

        $EmployeeInfo->employeeName = $request->input('name');
        $EmployeeInfo->employeeEmail = $request->input('email');
        $EmployeeInfo->employeePassword = $request->input('password');
        $EmployeeInfo->employeeContactNumber = $request->input('contactNumber');
        $EmployeeInfo->employeeDateOfBirth = $request->input('dob');
        $EmployeeInfo->save();

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
        $SingleEmployee = EmployeeInfo::find($id);
        return view('adminPages.edit')->with('SingleEmployee',$SingleEmployee);
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
            'email'=> 'required',
            'contactNumber'=> 'required',
            'dob'=> 'required',
            'password'=> 'required'
        ]);



        //create post
        $EmployeeInfo = EmployeeInfo::find($id);

        $EmployeeInfo->employeeName = $request->input('name');
        $EmployeeInfo->employeeEmail = $request->input('email');
        $EmployeeInfo->employeePassword = $request->input('password');
        $EmployeeInfo->employeeContactNumber = $request->input('contactNumber');
        $EmployeeInfo->employeeDateOfBirth = $request->input('dob');
        $EmployeeInfo->save();
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
        $EmployeeInfo = EmployeeInfo::find($id);
        $EmployeeInfo->delete();
        return redirect('/home')->with('success','Employee Deleted');
    }
}
