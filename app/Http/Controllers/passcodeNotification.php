<?php
namespace patholab\Http\Controllers;
use patholab\User;

trait passcodeNotification
	{

		use patholabMailer;


		public function sendPasscode($user_id)
		{
			
				$user = User::where(['id'=>$user_id])->select('email', 'passcode', 'username', 'name')->get();				
				$redirectPath = env('APP_URL', 'localhost:8000') . '/login/' . $user[0]['username'];
				$body = 'Hello ' . $user[0]['name'] . '!<br><br>';
				$body .= 'A new report under your name has been isssued.<br>';
				$body .= 'Your passcode is <b>' . $user[0]['passcode'] . '</b> (include dash)<br>';
				$body .= '<a href=' . $redirectPath . '>';
				$body .= 'Please Follow this link to access</a><br>';
				$body .= 'or paste this into your browser bar: <br>';
				$body .= $redirectPath;
				$body .= '<br><br>Thank you for choosing us!';
				

				$mail = $this->getMailSettings();
				$mail->addAddress($user[0]['email']);
				$mail->Subject = "New Report Created";
				$mail->isHtml(true);
				$mail->Body = $body;
				try
				{
					$mail->send();
				}
				catch(\Exception $e)
				{
					return false;
				}
				finally
				{				
					return true;
				}
			
						
		}
	}
?>