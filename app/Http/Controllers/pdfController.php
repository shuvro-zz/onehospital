<?php

namespace patholab\Http\Controllers;

use Illuminate\Http\Request;

use patholab\Http\Requests;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use patholab\User;
use patholab\Report;
use patholab\Test;

use PDF;

class pdfController extends Controller
{
    use patholabMailer;
	private function retrieveReportData($id)
	{
			$user = User::where(['username'=>Auth::user()->username])->select('name', 'email')->get();
    		$report = Report::find($id);
    		$innerTests = json_decode($report['innerTests']);
    		$tests = [];
    		foreach($innerTests as $test_id)
    		{	

    			$test = Test::find($test_id);
    			array_push($tests, $test);
    		}
    		$report['innerTests'] = count($tests);

    		$reportData = [
    			'patient'=>['user'=>$user[0]['name'], 'email'=>$user[0]['email']],
    			'report'=>$report,
    			'tests'=>$tests
    		
    		];    		

    		return $reportData;
	}
    
    public function reportPagePdf(Request $request, $id)
    {
        $reportData = $this->retrieveReportData($id);            
        $pdf = PDF::loadView('app.pdf.pdf', ['data'=>$reportData]); 
        return $pdf->stream();
    }

    public function reportPage(Request $request, $id)
    {
    	$reportData = $this->retrieveReportData($id);
    	
    	return view('app.pdf.page')->with(['data'=>$reportData]);
    }

    public function sendReporAsPdf(Request $request, $id)
    {
        try
        {
                $reportData = $this->retrieveReportData($id);            
                $pdf = PDF::loadView('app.pdf.pdf', ['data'=>$reportData]);             
                $output = $pdf->output();
                $mail = $this->getMailSettings();
                $mail->addAddress($reportData['patient']['email']);
                $mail->addStringAttachment($output, 'report4you.pdf');
                $mail->Subject ='reports4you';
                $mail->isHtml(true);
                $mail->Body = 'Hello! ' . $reportData['patient']['user'] . ' <br>This is the report you requested via email!';
                if(!$mail->send()) {
                    throw new \Exception('Email Sent Failed!');
                }else{
                    return response(['status'=>'success'], 200)
                    ->header('Content-Type', 'application/json');  
                }
        }
        catch(\Exception $e)
        {
            return response(['status'=>'failed'], 200)
            ->header('Content-Type', 'application/json');
        }
    }
}

