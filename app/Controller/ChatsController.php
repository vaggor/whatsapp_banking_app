<?php
class ChatsController extends AppController {
	public $name = 'Chats';
	//public $components = array('Twilio.Twilio');
	public $uses=array('Log','Chat','User','CustomerServiceChat');

	public $endpoint = 'https://02efba0f68a8.ngrok.app';


	public function test(){
		$data = $this->User->getUserByPhone('+233544331036');
		print_r($data);exit;
	}

	
	public function start_chat(){
		$data1 =  @trim(file_get_contents('php://input'));
		$SmsMessageSid = $_POST['SmsMessageSid'];
		$NumMedia = $_POST['NumMedia'];
		$SmsSid = $_POST['SmsSid'];
		$SmsStatus = $_POST['SmsStatus'];
		$body = $_POST['Body'];
		$To = $_POST['To'];
		$NumSegments = $_POST['NumSegments'];
		$MessageSid = $_POST['MessageSid'];
		$AccountSid = $_POST['AccountSid'];
		$From = $_POST['From'];


		$type = 'Incoming';
		$this->Log->saveChatLog($SmsMessageSid,$From,$To,$body,$type,$data1);

		$phone_no = $this->Log->formatePhoneNumber($From);

		/*$body = 'Hi';
		$From = 'whatsapp:+233242158047';
		$To = 'whatsapp:+14155238886';
		$phone_no = $this->Log->formatePhoneNumber($From);*/

		//print_r($phone_no);exit;

		$check_if_user_exist = $this->User->checkUserExist($phone_no);
		if($check_if_user_exist == 1){
			$session_status = $this->User->getSessionStatusByPhoneNo($phone_no);
			if($session_status == 0){
				$this->enter_pin($To,$From);
			}
			elseif($session_status == 2){
				if($body == 'Q'){
					$this->endCustomerServiceChat($To,$From);
				}
				else{
					$this->sendMessageToCustomerService($To,$From,$body);
				}
			}
			elseif($session_status == 1){
				if($body == 'Hi'){
					$this->menu($To,$From);
				}
				elseif($body == 'A'){
					$this->checkBalance($To,$From);
				}
				elseif($body == 'D'){
					$this->connectToCustomerService($To,$From);
				}
				elseif($body == 'Y'){
					$this->menu($To,$From);
				}
				elseif($body == 'N' or $body == 'Z'){
					$this->exit($To,$From);
				}
				else{
					$this->unknownCommand($To,$From);
				}
			}
			
		}
		else{
			$this->signup($To,$From);
		}


		exit;

	}



	public function signup($To,$From){
		$outgoing_mess = "Hi\nwelcome to Omni Bank chat assistant. Kindly click on the link below to signup and create PIN:\n\n".$this->endpoint."/omni_chat_signup/users/signup\n";
		$resp = $this->Chat->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}



	public function enter_pin($To,$From){
		$exp = explode(':', $From);
		$phone_no = $exp[1];
		$fname = $this->User->getFirstNameByPhoneNo($phone_no);

		$outgoing_mess = "Welcome back ".$fname.",\n\nTo be sure it's you click on the link below to enter you PIN:\n\n".$this->endpoint."/omni_chat_signup/users/auth_user";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}


	public function menu($To,$From){
		$outgoing_mess = "Please reply with a letter of your choice:\n\n*A.* Check Balance\n*B.* Airtime topup\n*C.* Money Transfer\n*D.* Chat with a customer service representative\n\n*Z.* To Exit";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}


	public function checkBalance($To,$From){
		$outgoing_mess = "Here is your account balances:\n\n*1* 2014******23\nEmmanuel Adu\nCurrent Account\n*GHS 2000*\n\n2013********56\nEmmanuel Adu\nSavings Account\n*GHS 5000*";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);

		$outgoing_mess = "Do you want to perform another transaction?\n\n*Y.*  Yes\n*N.* No";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}


	public function connectToCustomerService($To,$From){
		$from_exp = explode(':', $From);
		$from_phone_no = $from_exp[1];
		$to_exp = explode(':', $To);
		$to_phone_no = $to_exp[1];

		$cust_data = $this->User->getUserByPhone($from_phone_no);
		$message = 'Hi';
		$customer_service_message_type = 'Incomming';
		$this->CustomerServiceChat->saveChat($cust_data[0]['User']['cif'],$cust_data[0]['User']['fname'],$from_phone_no,$to_phone_no,$message,$customer_service_message_type);
		$this->User->updateSessionStatus($from_phone_no,2);

		$outgoing_mess = "Hold on while we connect you to a customer service representative. Enter Q to exit customer service chat and return to menu.";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}



	public function sendMessageToCustomerService($To,$From,$message){
		$from_exp = explode(':', $From);
		$from_phone_no = $from_exp[1];
		$to_exp = explode(':', $To);
		$to_phone_no = $to_exp[1];

		$cust_data = $this->User->getUserByPhone($from_phone_no);
		$customer_service_message_type = 'Incomming';
		$this->CustomerServiceChat->saveChat($cust_data[0]['User']['cif'],$cust_data[0]['User']['fname'],$from_phone_no,$to_phone_no,$message,$customer_service_message_type);

		return;
	}


	public function endCustomerServiceChat($To,$From){
		$exp = explode(':', $From);
		$phone_no = $exp[1];
		$this->User->updateSessionStatus($phone_no,1);
		$this->menu($To,$From);
		return;
	}


	public function exit($To,$From){
		$exp = explode(':', $From);
		$phone_no = $exp[1];
		
		$outgoing_mess = "Thank you for banking with us. Enjoy the rest of the day";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->User->updateSessionStatus($phone_no,0);
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}


	public function unknownCommand($To,$From){
		$outgoing_mess = "Sorry, I don't understand this letter";
		$resp = $this->Log->sendMessage($From,$outgoing_mess);
		$type = 'Outgoing';
		$this->Log->saveChatLog($resp->sid,$To,$From,$outgoing_mess,$type,$resp);
		return;
	}

}
?>