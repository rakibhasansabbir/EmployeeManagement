<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmployeeActivity;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

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

    public function index()
    {
        date_default_timezone_set("Asia/Dhaka");
        $EmployeeActivity = EmployeeActivity::where('employee_id', Auth::user()->id)
            ->whereDate('created_at', date("Y-m-d"))
            ->get();
        $totalSec = 0;
        foreach ($EmployeeActivity as $emp) {
            $totalSec += (($emp->updated_at)->diffInSeconds($emp->created_at));
            $latInTime = $emp->created_at;
        }

        $this->value = EmployeeActivity::where('employee_id', Auth::user()->id)
            ->orderBy('id', 'desc')
            ->get();
        $currentStatus = EmployeeActivity::where('employee_id', Auth::user()->id)
            ->where('stay', 'YES')
            ->whereDate('created_at', date("Y-m-d"))
            ->get();
        foreach ($currentStatus as $cStatus) {

            session(['time' => ($latInTime->subSeconds($totalSec))]);
        }

        return view('employee')
            ->with('Activities', $this->value)
            ->with('time', session('time', 'default'));
    }

    public function store(Request $request)
    {
        date_default_timezone_set("Asia/Dhaka");
        $this->validate($request, [
            'id' => 'required',
            'ip' => 'required',
            'mac' => 'required',
            'pcName' => 'required',
        ]);
        $EmployeeActivity = EmployeeActivity::where('employee_id', $request->input('id'))
            ->where('stay', 'YES')
            ->whereDate('created_at', date("Y-m-d"))
            ->get();
        foreach ($EmployeeActivity as $emp) {
            return redirect('/employee')->with('error', 'You Already in press STOPPED button to leave');
        }
        $EmployeeActivity = new EmployeeActivity();
        $EmployeeActivity->stay = "YES";
        $EmployeeActivity->employee_id = $request->input('id');
        $EmployeeActivity->ipAddress = $request->input('ip');
        $EmployeeActivity->macAddress = $request->input('mac');
        $EmployeeActivity->pcName = $request->input('pcName');
        $EmployeeActivity->save();

        $EmployeeActivity = EmployeeActivity::where('employee_id', Auth::user()->id)
            ->whereDate('created_at', date("Y-m-d"))
            ->orderBy('id', 'desc')
            ->get();
        $totalSec = 0;
        foreach ($EmployeeActivity as $emp) {
            $totalSec += (($emp->updated_at)->diffInSeconds($emp->created_at));

        }
        session(['time' => (Carbon::now()->subSeconds($totalSec))]);

        return redirect('employee')
            ->with('success', 'Welcome to our company your time start now');
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
        session(['time' => "stop"]);

        return redirect('/employee')->with('success', 'Thanks for stay here ');
    }
}
