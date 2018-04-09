<?php

namespace patholab\Http\Controllers;

use Illuminate\Http\Request;
use patholab\Test;
use patholab\Http\Requests;
use Illuminate\Facades\Support\DB;

class testController extends Controller
{
    use patientContentManager;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('operator');
    }
    private function ValidateData(Request $request)
    {
        $this->validate($request, [
                'name'=> 'required|max:55',
                'created_at'=> 'required|date',
                'type'=> 'required',
                'result'=> 'required|max:55',
                'comments'=> 'max:55',
                'user_id'=>'required|numeric'
            ]);
    }

    
    
    /**
     * Store a newly created test in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->ValidateData($request);
        Test::create([
           'name'=>$request->name,
           'created_at'=>$request->created_at,
           'type'=>$request->type,
           'result'=>$request->result,     
           'user_id'=>$request->user_id
        ]);

        return response(['status'=>'success'], 200)
        ->header('Content-Type', 'application/json');
    }

    /**
     * Display all the test for the patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tests = Test::where(['user_id'=>$id])->get();
        return response(['status'=>'success','tests'=>$tests], 200)
        ->header('Content-Type', 'application/json');
    }

    /**
     * Display the information for one test.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try
        {
            $test = Test::find($id)->get();
            return response(['status'=>'success', 'test'=>$test], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

    /**
     * Update the specified test in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->deleteTest($id)?
        response(['status'=>'success'], 200)->header('Content-Type', 'application'):
        response(['status'=>'failed'], 200)->header('Content-Type', 'application');
    }
}
