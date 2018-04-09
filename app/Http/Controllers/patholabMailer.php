<?php
	namespace patholab\Http\Controllers;	
	use PHPMailer;
	
	trait patholabMailer
	{
		/**
		 * Controlls the mail Settings
		 * @return PHPMailer
		 */

		public function getMailSettings()
		{
			    $mail = new PHPMailer();
                $mail->isSMTP();                                      
                $mail->Host = 'sg2plcpnl0102.prod.sin2.secureserver.net';  
                $mail->SMTPAuth = true;                               
                $mail->Username = 'robot@eoss.ml';                 
                $mail->Password = '!robot!eos#16';                          
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;              
                $mail->setFrom('robot@eoss.ml', 'patholab');
                return $mail;
		}		
	}
?>