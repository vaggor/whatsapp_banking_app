<?php
App::import('Model', 'User');
class CustomerServiceChat extends AppModel{
    var $name = 'CustomerServiceChat';
	var $primaryKey = 'id';
	var $useTable = 'customer_service_chats';


	public function saveChat($cif,$name,$from,$to,$message,$type){
		$data = array();
		$data['CustomerServiceChat']['cif'] = $cif;
		$data['CustomerServiceChat']['name'] = $name;
		$data['CustomerServiceChat']['from_phone_no'] = $from;
		$data['CustomerServiceChat']['to'] = $to;
		$data['CustomerServiceChat']['message'] = $message;
		$data['CustomerServiceChat']['type'] = $type;
		$data['CustomerServiceChat']['date'] = date('Y-m-d H:i');
		$this->saveAll($data);
		return;
	}


	public function getUser(){
		/*$sql = "select distinct(phone_no) as phone from customer_service_chats where status = 0 and deleted = 0";
		$data = $this->query($sql);*/
		$data = $this->find('all',array('conditions'=>array('status'=>0,'deleted'=>0,'pull_new_user'=>array(0,1),'type'=>'Incomming'),'fields'=>array('distinct(from_phone_no) as phone')));
		//print_r($data);exit;
		$user = new User();
		$resp = array();
		$i=0;
		foreach ($data as $data) {
			$resp[$i]['phone'] = explode('+', $data['CustomerServiceChat']['phone'])[1];
			$resp[$i]['name'] = $user->getFirstNameByPhoneNo($data['CustomerServiceChat']['phone']);
			$this->updateNewUserPulled($data['CustomerServiceChat']['phone']);
			$i++;
		}
		return $resp;
	}


	public function getNewUsers(){
		/*$sql = "select distinct(phone_no) as phone from customer_service_chats where status = 0 and deleted = 0";
		$data = $this->query($sql);*/
		$data = $this->find('all',array('conditions'=>array('status'=>0,'deleted'=>0,'pull_new_user'=>0,'type'=>'Incomming'),'fields'=>array('distinct(from_phone_no) as phone')));
		//print_r($data);exit;
		$user = new User();
		$resp = array();
		$i=0;
		foreach ($data as $data) {
			$resp[$i]['phone'] = explode('+', $data['CustomerServiceChat']['phone'])[1];
			$resp[$i]['name'] = $user->getFirstNameByPhoneNo($data['CustomerServiceChat']['phone']);
			$this->updateNewUserPulled($data['CustomerServiceChat']['phone']);
			$i++;
		}
		return $resp;
	}


	public function getChats($phone){
		//print_r($phone);exit;
		$data = $this->find('all',array('conditions'=>array('status'=>0,'deleted'=>0,'from_phone_no'=>$phone),'fields'=>array('distinct(from_phone_no) as phone')));
		$chats = $this->find('all',array('conditions'=>array('status'=>0,'deleted'=>0,'OR'=>array('from_phone_no'=>$phone,'to'=>$phone)),'fields'=>array('message','date','type')));
		$chats_arr = array();
		$j=0;
		foreach($chats as $chat){
			$chats_arr[$j]['message'] = $chat['CustomerServiceChat']['message'];
			$chats_arr[$j]['type'] = $chat['CustomerServiceChat']['type'];
			$chats_arr[$j]['date'] = date('d M Y H:i',strtotime($chat['CustomerServiceChat']['date']));
			$j++;
		}
		//print_r($chats_arr);exit;
		$user = new User();
		$resp = array();
		$i=0;
		foreach ($data as $data) {
			$resp[$i]['phone'] = $data['CustomerServiceChat']['phone'];
			$resp[$i]['name'] = $user->getFirstNameByPhoneNo($data['CustomerServiceChat']['phone']);
			$resp[$i]['chats'] = $chats_arr;
			$i++;

		}
		return $resp;
	}


	public function getNewChats($phone){
		//print_r($phone);exit;
		$data = $this->find('all',array('conditions'=>array('status'=>0,'deleted'=>0,'from_phone_no'=>$phone),'fields'=>array('distinct(from_phone_no) as phone')));
		$chats = $this->find('all',array('conditions'=>array('status'=>0,'pulled'=>0,'deleted'=>0,'OR'=>array('from_phone_no'=>$phone,'to'=>$phone)),'fields'=>array('message','date','type')));
		$chats_arr = array();
		$j=0;
		foreach($chats as $chat){
			$chats_arr[$j]['message'] = $chat['CustomerServiceChat']['message'];
			$chats_arr[$j]['type'] = $chat['CustomerServiceChat']['type'];
			$chats_arr[$j]['date'] = date('d M Y H:i',strtotime($chat['CustomerServiceChat']['date']));
			$this->updatePulled($phone);
			$j++;
		}
		//print_r($chats_arr);exit;
		$user = new User();
		$resp = array();
		$i=0;
		foreach ($data as $data) {
			$resp[$i]['phone'] = $data['CustomerServiceChat']['phone'];
			$resp[$i]['name'] = $user->getFirstNameByPhoneNo($data['CustomerServiceChat']['phone']);
			$resp[$i]['chats'] = $chats_arr;
			$i++;

		}
		return $resp;
	}



	public function updateStatus($phone_no){
		$data = $this->updateAll(array('status'=>1),array('type'=>'Incomming','deleted'=>0,'status'=>0,'from_phone_no'=>$phone_no));
		return $data;
	}


	public function updatePulled($phone_no){
		//print_r($phone_no);exit;
		$data = $this->updateAll(array('pulled'=>1),array('deleted'=>0,'status'=>0,'OR'=>array('from_phone_no'=>$phone_no,'to'=>$phone_no)));
		return $data;
	}

	public function updateNewUserPulled($phone_no){
		//print_r($phone_no);exit;
		$data = $this->updateAll(array('pull_new_user'=>1),array('deleted'=>0,'status'=>0,'OR'=>array('from_phone_no'=>$phone_no,'to'=>$phone_no)));
		return $data;
	}


	public function removeFromChatUserList($phone_no){
		//print_r($phone_no);exit;
		$data = $this->updateAll(array('pull_new_user'=>2),array('deleted'=>0,'pull_new_user'=>1,'OR'=>array('from_phone_no'=>$phone_no,'to'=>$phone_no)));
		return $data;
	}



	public function successResponse($err_mess,$model){
		$json = '{
	        "'.$model.'": {
	            "status_id": "1",
	            "status": "Success",
	            "description": "'.$err_mess.'",
	            "date":"'.date('d M Y H:i').'"
	        }
	    }';
		return $json;
	}

}
?>