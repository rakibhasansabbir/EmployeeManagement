<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;
use App\EmployeeActivity;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;

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
        $Activity = EmployeeActivity::orderBy('id', 'desc')->get();
        return view('activityTable')->with('Activities', $Activity);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        if (App::runningInConsole())
        {
            echo "I'm in the console, baby!";
        }
        date_default_timezone_set("Asia/Dhaka");
        $singleActivity = EmployeeActivity::where('employee_id', $id)
            ->orderBy('id', 'desc')
            ->get();
        $name = Employee::find($id);

        $EmployeeActivity = EmployeeActivity::where('employee_id', $id)
            ->whereDate('created_at', date("Y-m-d"))
            ->get();
        $totalSec = 0;
        foreach ($EmployeeActivity as $emp) {
            $totalSec += (($emp->updated_at)->diffInSeconds($emp->created_at));
        }

        $last7DaysRecords = EmployeeActivity::where('employee_id', $id)
            ->whereDate('created_at', '>=', Carbon::now()->subDays(7))
            ->get();
        $last7DaysTotalSec = 0;
        foreach ($last7DaysRecords as $emp) {
            $last7DaysTotalSec += (($emp->updated_at)->diffInSeconds($emp->created_at));
        }

        /*
            per day 9hr * 6 working days per week
            194400 => 3240m => 54h => 6days (perDay 9 hr)
        */
        $last7DaysPercentage = $last7DaysTotalSec / 194400 * 100;

        return View('singleActivity')
            ->with('Activities', $singleActivity)
            ->with('Name', $name->name)
            ->with('todayTotalTime', gmdate("H:i:s", $totalSec))
            ->with('last7DaysTotalTime', gmdate("H:i:s", $last7DaysTotalSec))
            ->with('last7DaysPercentage', (int)$last7DaysPercentage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',

            'email' => 'required|unique:employees,email',

            'contactNumber' => 'required|unique:employees,contactNumber',
            'dateOfBirth' => 'required',
            'password' => 'required'
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
        return redirect('/home')->with('success', 'Employee Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $SingleEmployee = Employee::find($id);
        return view('edit_employee')->with('SingleEmployee', $SingleEmployee);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',

            'email' => 'required',

            'contactNumber' => 'required',
            'dateOfBirth' => 'required',
            'password' => 'required'
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

        return redirect('/home')->with('success', 'Employee Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Employee = Employee::find($id);
        $Employee->delete();
        return redirect('/home')->with('success', 'Employee Deleted');
    }
}
