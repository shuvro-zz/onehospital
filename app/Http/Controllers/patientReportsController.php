<?php

namespace patholab\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use patholab\Http\Requests;
use Illuminate\Support\Facades\DB;
use patholab\Report;
use patholab\Test;
use patholab\User;

class patientReportsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('patient');
    }
    /**
     * Display an object containing the report list to display it to the patient
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try
        {
            $user_id = User::where(['username'=>Auth::user()->username])
            ->select('id')
            ->get();

            $reports = Report::where(['user_id'=>$user_id[0]['id']])->get();
            foreach($reports as $key=>$report)
            {
                $counter = json_decode($report['innerTests']);
                $counter = count($counter);
                $reports[$key]['innerTests'] = $counter;
            }

            return response(['status'=>'success', 'reports'=>$reports], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

    /**
     * Display the a report and its test including details
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {            
            $report = Report::find($id);
            $tests = json_decode($report['innerTests']);
            $report['innerTests'];
            $reportTests = [];
            foreach($tests as $id)
            {
                $test = Test::find($id);
                array_push($reportTests, $test);
            }
            
            return response(['status'=>'success', 'tests'=>$reportTests], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            echo $e;
            return response(['status'=>'failed', 'error'=>$e], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

}
