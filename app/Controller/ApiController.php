<?php
ini_set('max_execution_time', 300); //300 seconds = 5 minutes
class ApiController extends AppController {

	public $name = 'Api';
	public $components = array('Session','Email', 'RequestHandler');
	public $uses=array('Usergroup','User','Status','Message','Channel','Log','Chat','Setting','ChatLog','CustomerServiceChat','Shop','Category','Favourite','Product','ProductImage','Order');
	public $helpers = array('Form', 'Html', 'Text','Time', 'Number', 'Session', 'Paginator', 'Js', 'Cache');

	/*public function beforeFilter() {
		$this->Auth->allow('create_user','gat_chat_users','gat_chats','send_chat','gat_new_chats','end_chats','gat_new_chat_users','menu');
		//$this->Auth->deny('*');
		//parent::beforeFilter();
	  }*/

  //public $no_of_records_per_page = 10;
	  //public $company_whatsapp_num = '+14155238886';

	
	public function send_whatsapp_message() {	
		//print_r($phone);exit;
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		header('Content-Type: application/json; charset=utf-8');
		$data1 =  trim(file_get_contents('php://input'));
		$data = json_decode($data1,true);
		//print_r($data);exit;

		$phone = $data['phone_no'];
		//$phone2 = 'whatsapp:'.$this->company_whatsapp_num;
		$To = 'whatsapp:+'.$phone;

	    $outgoing_mess = $data['message'];
		$resp = $this->Log->sendMessage($To,$outgoing_mess);
		print_r($resp);exit;
		$type = 'whatsapp';
		$this->Log->saveChatLog($resp->sid,$To,$phone,$outgoing_mess,$type,$resp);
	    //print_r($data);exit;
	    print_r($json_obj);exit;
	}




	public function send_sms() {	
		//print_r($phone);exit;
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		header('Content-Type: application/json; charset=utf-8');
		$data1 =  trim(file_get_contents('php://input'));
		$data = json_decode($data1,true);
		$message = urlencode($data['message']);
		//print_r($data);exit;

		$from = $data['from'];
		$sms_url = 'http://api.nalosolutions.com/bulksms/?username=vaggor&password=Victor@1985&type=0&dlr=1&destination='.$data['to'].'&source='.$from.'&message='.$message;
	    /*$sms_url = 'https://api.hubtel.com/v1/messages/send/?From='.$from.'&To='.$data['to'].'&Content='.$data['message'].'&ClientID=wahugbbx&ClientSecret=cfjrfknr';*/
	    $sms_resp = file_get_contents($sms_url);
		//print_r($sms_resp);exit;
		$type = 'SMS';
		$this->Log->saveChatLog('',$from,$data['to'],$sms_url,$type,$sms_resp);
	    //print_r($data);exit;
	    print_r($sms_resp);exit;
	}




	public function send_email(){

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
		header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

		header('Content-Type: application/json; charset=utf-8');
		$data1 =  trim(file_get_contents('php://input'));
		$data = json_decode($data1,true);

		//print_r($data);exit;

		$subject = $data['subject'];

		//$to = $this->Message->checkEmailValidity($data['Message']['to']);
			//$to = explode(',',$data['Message']['to']);			

		$to = $data['to'];
		$body = $data['message'];
				// Message
		$message = '
				<html>
				<head>
				  <title>Notification</title>
				</head>
				<body>
				  <p>'.$body.'</p>
				  
				</body>
				</html>
				';

		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';
		$headers[] = 'From: '.$data['alias'].' <'.$data['from'].'>';
		
		$resp = mail($to, $subject, $message, implode("\r\n", $headers));
		$type = 'Email';
		$this->Log->saveChatLog('',$data['from'],$to,$body,$type,$resp);
	    //print_r($data);exit;
	    print_r($resp);exit;
							

	}


	


}
?>
