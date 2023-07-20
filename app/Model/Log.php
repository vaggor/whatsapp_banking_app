<?php
class Log extends AppModel{
    var $name = 'Log';
	var $primaryKey = 'id';
	var $useTable = 'logs';


	public function saveChatLog($session_id,$from,$to,$body,$type,$params){
		$data = array();
		$data['Log']['session_id'] = $session_id;
		$data['Log']['from'] = $from;
		$data['Log']['to'] = $to;
		$data['Log']['body'] = $body;
		$data['Log']['type'] = $type;
		$data['Log']['date'] = date('Y-m-d H:i');
		$data['Log']['params'] = $params;
		//print_r($data);exit;
		$this->saveAll($data);
		return;
	}


	public function sendMessage($to,$body){
		//print_r(array($to,$body));exit;
		App::import('Vendor', 'Autoload', array('file' => 'twilio_sdk/autoload.php'));

		// Use the REST API Client to make requests to the Twilio REST API
		//use Twilio\Rest\Client;
		// Your Account SID and Auth Token from twilio.com/console
		$sid = '';
		$token = '';
		//$twilio = new Client($sid, $token);
		$twilio = new Twilio\Rest\Client($sid, $token);

		$message = $twilio->messages
        			->create($to, // to
                           array(
                               "from" => "whatsapp:+14155238886",
                               "body" => $body
                           )
                  	);

		return $message;
	}

}
?>