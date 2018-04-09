<?php

namespace patholab\Http\Controllers;

use Illuminate\Http\Request;

use patholab\Http\Requests;
use Illuminate\Support\Facades\DB;
use patholab\User;
use patholab\Report;
use patholab\Test;
use Illuminate\Database\Eloquent\FactoryBuilder;
use Faker;


class patientController extends Controller
{
    

    /**
     * Prevent unauthorized access
     *
     */    
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('operator');
    }

    /**
     * Creats a random passcode for patients
     *
     */

    protected function getPasscode()
    {
        $faker = Faker\Factory::create();
        return $faker->numberBetween(100,999) . "-" . $faker->numberBetween(100,999);
    }

    /**
     * Validates the form data
     *
     */    

    private function ValidateData(Request $request)
    {
        $this->validate($request, [
                'name'=> 'required|max:60|min:10',
                'email'=> 'required|unique:users',
                'username'=> 'required|min:5|max:15'
            ]);
    }

    /**
     *
     *   Determines wheather or not the user is an operator to provide automatic passcodes to patients
     *   @param $operator = 0|1
     *   @return array with password and passcode
     */


    private function getPassaccess (Request $request)
    {
        if($request->operator != 1)
        {
            $password = $this->getPasscode();
            $passcode = $password;
            $password = bcrypt($passcode);
        }
        else
        {
            $password = bcrypt($request->password);
            $passcode = 'nopasscode';   
        }
        return ['password'=>$password, 'passcode'=>$passcode];
    }
    /**
     * Retrive Patient list excluding operators
     * @param Request      
     * @return Illuminate\Foundation\Http\Response
     */

    public function index(Request $req)
    {
        try
        {       
            $patients = DB::table('users')
            ->selectRaw('users.id, users.name, (select count(reports.user_id) from reports where reports.user_id = users.id) as reports')
            ->where(['operator'=>0])
            ->get();

            return response(['status'=>'success', 'patients'=>$patients], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json'); 
        }
    }

    
    /**
     * Store a newly created patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->ValidateData($request);
        try
        {
            $passaccess = $this->getpassaccess($request);
            User::create([
                    'name'=> $request->name,
                    'username'=> $request->username,
                    'password'=> $passaccess['password'],
                    'passcode'=> $passaccess['passcode'],
                    'email' => $request->email,
                    'operator' => empty($request->operator)? 0:1,
                ]);            

            return response(['status'=>'success'], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {            
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }
    }

    /**
     * Display the specified patient.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try
        {      
            $patient = User::find($id);

            return response(['status'=>'success', 'patient'=>$patient], 200)
            ->header('Content-Type', 'application/json');
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');   
        }

    }

    /**
     * Update the specified patient in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {      
        $this->ValidateData($request);     
        try
        {    
           

            $passaccess = $this->getpassaccess($request);

            if(empty($user = User::find($id)))
            {
                throw new \Exception('not valid data');
            }else
            {
                $user->update([
                'name'=> $request->name,
                'username'=> $request->username,
                'password'=> $passaccess['password'],
                'passcode'=> $passaccess['passcode'],
                'email' => $request->email,
                'operator' => $request->operator,
                ]);        
            }
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
     * Remove the specified patient from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        try
        {    
            $user = User::find($id);
            if(!empty($user))        
            {
                $user_id = $user['id'];
                $user->delete();
                Report::where(['user_id'=>$user_id])->delete();
                Test::where(['user_id'=>$user_id])->delete();
            }    
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
}
