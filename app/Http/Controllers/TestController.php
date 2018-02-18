<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeActivity;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $global = 7777;

    public function index()
    {
        $this->global = 1234;
        return view('test2');
    }

    public function create()
    {
        return $this->global;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return 999;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $Activity = EmployeeActivity::find($id);
        $Activity->employee_id = $request->input('id');
        $Activity->ipAddress = $request->input('ip');
        $Activity->macAddress = $request->input('mac');
        $Activity->pcName = $request->input('pcName');
        $Activity->save();
        return redirect('/employee')->with('success','STOP');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
