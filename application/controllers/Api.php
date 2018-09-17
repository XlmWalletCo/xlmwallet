<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {

	public function index()
	{
		echo '<h2>API page</h2>';
	}

    public function mail() {
		header('Access-Control-Allow-Origin: *');
		//header('Content-type: application/json');

		if(!isset($_POST['public_key']) || !isset($_POST['secret_key'])
			|| !isset($_POST['message']) || !isset($_POST['amount'])) {
			echo '{"detail": "invalid parameters"}';
			return false;
		}

		$mail = htmlspecialchars($_POST['email']);

		// used to prevent users from linking an email that is not their property to an account id
		$mail_split = str_split($mail);
		$mail_secret = 276;

		foreach($mail_split as $char) {
		    $mail_secret += ord($char)+85019;
		}


		$account_id = ( substr($_POST['public_key'], 0, 1) == 'G' && strlen($_POST['public_key']) == 56 ? 
						htmlspecialchars($_POST['public_key']) : $error = '{"detail": "invalid account id"}' );

		$secret_key = ( substr($_POST['secret_key'], 0, 1) == 'S' && strlen($_POST['secret_key']) == 56 ? 
						htmlspecialchars($_POST['secret_key']) : $error = '{"detail": "invalid secret key"}' );

		$tmessage =  (!empty($_POST['message']) ? htmlspecialchars($_POST['message']) : '');

		$amount = htmlspecialchars($_POST['amount']);

		if( isset($error ) ) {
			echo $error;
			return false;
		}

		$message_txt = str_replace('{{account_id}}', $account_id,
						str_replace('{{secret_key}}', $secret_key,
						str_replace('{{message}}', $tmessage,
						str_replace('{{amount}}', $amount, 
						str_replace('{{email}}', $mail, 
						str_replace('{{emailsecret}}', $mail_secret,
							file_get_contents('https://xlmwallet.co/assets/mail/claim.txt'))
						)))));		//==========
		 		 

		$message_html = str_replace('{{account_id}}', $account_id,
						str_replace('{{secret_key}}', $secret_key,
						str_replace('{{message}}', $tmessage,
						str_replace('{{amount}}', $amount, 
						str_replace('{{email}}', $mail, 
						str_replace('{{emailsecret}}', $mail_secret,
							file_get_contents('https://xlmwallet.co/assets/mail/claim.html'))
						)))));		//==========
		 		 

		 
		$boundary = "-----=".md5(rand());
		 
		$subject = "You received ".$amount." XLM!";
		 
		$header = "From: \"XLMwallet\"<payment@xlmwallet.co>".PHP_EOL;
		$header.= "Reply-to: \"XLMwallet\" <support@xlmwalelt.co>".PHP_EOL;
		$header.= "MIME-Version: 1.0".PHP_EOL;
		$header.= "Content-Type: multipart/alternative;".PHP_EOL." boundary=\"$boundary\"".PHP_EOL;
		 
		$message = PHP_EOL."--".$boundary.PHP_EOL;

		$message.= "Content-Type: text/plain; charset=\"ISO-8859-1\"".PHP_EOL;
		$message.= "Content-Transfer-Encoding: 8bit".PHP_EOL;
		$message.= PHP_EOL.$message_txt.PHP_EOL;
		$message.= PHP_EOL."--".$boundary.PHP_EOL;
		$message.= "Content-Type: text/html; charset=\"ISO-8859-1\"".PHP_EOL;
		$message.= "Content-Transfer-Encoding: 8bit".PHP_EOL;
		$message.= PHP_EOL.$message_html.PHP_EOL;
		$message.= PHP_EOL."--".$boundary."--".PHP_EOL;
		$message.= PHP_EOL."--".$boundary."--".PHP_EOL;
		 
		mail($mail,$subject,$message,$header);


		echo '{"status": "success"}';


	}
    
	public function federation() {
		header('Access-Control-Allow-Origin: *');
		header('Content-type: application/json');

		$this->load->model('federation_model');

		if( !isset($_GET['q']) || !isset($_GET['type']) )
			return $this->federation_model->error('missing parameters, excepted parameter '.
													'q and parameter type');

		$this->federation_model->handle($_GET['q'], $_GET['type']);
	}

}
