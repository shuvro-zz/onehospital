<?php

namespace patholab\Http\Controllers;

use Illuminate\Http\Request;
use patholab\Report;
use patholab\Test;
use patholab\Http\Requests;


class reportController extends Controller
{   
    use PatientContentManager;
    use passcodeNotification;
    
    public function __construct()
    {
        $this->middleware('auth');        
        $this->middleware('operator');
    }
    
    private function getInnerTestsList(Request $request)
    {
        $innerTests = [];
        foreach($request->innerTests as $value)
        {
            array_push($innerTests, $value['id']);
        }
        return $innerTests;
    }

    private function ValidateData(Request $req)
    {
        $this->validate($req, [
            'name'=>'required|max:150',
            'innerTests'=>'required',
            'user_id'=>'required|numeric'
        ]);   
    }
    
    /**
     * Store a newly created report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $this->ValidateData($request);
            
            $innerTests = $this->getInnerTestsList($request);
            Report::create([
                    'name'=>$request->name,
                    'innerTests'=>json_encode($innerTests),
                    'user_id'=>$request->user_id
                ]);

            /*
             * Automatically sends pass-code and link to user
             *
             */
          $this->sendPasscode($request->user_id);  
           return response(['status'=>'success'], 200)->header('Content-Type', 'application/json');
         
        }
        catch(\Exception $e)
        {
            echo $e;
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

    /**
     * Display the resource with its tests.
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
            $reportTests = [];
            foreach($tests as $id)
            {
                
                $test = Test::find($id);
                if(!empty($test))
                {
                    array_push($reportTests, $test->get());    
                }
                
            }
            $report['innerTests'] = $reportTests;
            return response(['status'=>'success', 'report'=>$report], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

    public function edit($id)
    {
        try
        {
            $reports = Report::where(['user_id'=>$id])->get();
            return response(['status'=>'success', 'reports'=>$reports], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {            
            return response(['status'=>'failed', 'error'=>$e], 200)
            ->header('Content-Type', 'application/json');
        }
    }   

    /**
     * Update the specified report in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try
        {
            $this->ValidateData($request);
            $innerTests = $this->getInnerTestsList();
            Report::update([
                    'name'=>$request->name,
                    'innerTests'=>json_encode($innerTests),
                    'user_id'=>$request->user_id
                ]);
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');
        }
        finally
        {
            return response(['status'=>'success'], 200)
            ->header('Content-Type', 'application/json');
        }
    }

    /**
     * Remove the specified report from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteReport($id)?
        response(['status'=>'success'], 200)->header('Content-Type', 'application/json'):
        response(['status'=>'failed'], 200)->header('Content-Type', 'application/json');
    }
}
