<?php
class User extends AppModel {

	var $name = 'User';
	var $primaryKey = 'id';
	var $useTable = 'users';
	

	public function listActiveUsers(){
		$data = $this->find('list',array('conditions'=>array('deleted'=>0)));
		return $data;
	}


	public function listRiders(){
		$data = $this->find('list',array('conditions'=>array('deleted'=>0,'usergroup_id'=>3)));
		return $data;
	}


	public function listUsers(){
		$data = $this->find('list');
		return $data;
	}

	public function getActiveUsers(){
		$data = $this->find('all',array('conditions'=>array('deleted'=>0)));
		return $data;
	}

	public function getUsers(){
		$data = $this->find('all');
		return $data;
	}

	public function getDetailUserById($id){
		$data = $this->find('all',array('conditions'=>array('id'=>$id),'order'=>array('name')));
		return $data;
	}

	public function getUsersByStatus($status){
		$data = $this->find('all',array('conditions'=>array('status_id'=>$status,'deleted'=>0)));
		return $data;
	}

	public function getDetailUserByEPhone($phone){
		$data = $this->find('all',array('conditions'=>array('phone'=>$phone)));
		return $data;
	}

	public function getDetailUserByEmailVerificationCode($code){
		$data = $this->find('all',array('conditions'=>array('email_verification_code'=>$code)));
		return $data;
	}

	public function getUserById($id){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('id'=>$id)));
		return $data;
	}


	public function getUserByPhone($phone){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('deleted'=>0,'phone'=>$phone)));
		return $data;
	}


	public function getUserByIdJson($id){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('id'=>$id)));
		$resp = array();
		$resp['User'][0]['id'] = $data[0]['User']['id'];
		$resp['User'][0]['name'] = $data[0]['User']['name'];
		$resp['User'][0]['phone'] = $data[0]['User']['phone'];
		$resp['User'][0]['email'] = $data[0]['User']['email'];
		$resp['User'][0]['usergroup'] = $data[0]['User']['usergroup_id'];
		return $resp;
	}


	public function getNameById($id){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('id'=>$id),'fields'=>array('name')));
		return $data[0]['User']['name'];
	}


	public function getFirstNameByPhoneNo($phone_no){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('phone'=>$phone_no,'deleted'=>0),'fields'=>array('fname')));
		return $data[0]['User']['fname'];
	}


	public function getCIFByPhoneNo($phone_no){
		//print_r($phone_no);exit;
		$data = $this->find('all',array('conditions'=>array('phone'=>$phone_no,'deleted'=>0),'fields'=>array('cif')));
		return $data[0]['User']['cif'];
	}


	public function getSessionStatusByPhoneNo($phone_no){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('phone'=>$phone_no,'deleted'=>0),'fields'=>array('session_status')));
		return $data[0]['User']['session_status'];
	}


	public function getUserIdByApiKey($api_key){
		//print_r('expression');exit;
		$data = $this->find('all',array('conditions'=>array('api_key'=>$api_key),'fields'=>array('id')));
		return $data[0]['User']['id'];
	}

	public function login($email,$pass){
		$count = $this->find('count',array('conditions'=>array('email'=>$email,'password'=>$pass,'status_id'=>2,'deleted'=>0)));
		return $count;

	}

	public function getCustomerIdByEmailAndPassword($email,$pass){
		$data = $this->find('all',array('conditions'=>array('email'=>$email,'password'=>$pass,'status_id'=>7,'deleted'=>0),'fields'=>array('id')));
		return $data[0]['User']['id'];

	}

	public function getCustomerInfoByEmailAndPassword($email,$pass){
		$data = $this->find('all',array('conditions'=>array('email'=>$email,'password'=>$pass,'deleted'=>0),'fields'=>array('id','name','phone','email','api_key','verify_email_status','verify_phone_status','usergroup_id')));
		return $data;

	}

	public function verifyPhone($phone_no,$code){
		//print_r($code);exit;
		$count = $this->find('count',array('conditions'=>array('phone'=>$phone_no,'phone_verification_code'=>$code,'verify_phone_status'=>1,'deleted'=>0)));	
		return $count;
	}


	public function updateVerifyPhoneStatus($phone_no,$code){
		$data = $this->updateAll(array('verify_phone_status'=>2),array('phone'=>$phone_no,'phone_verification_code'=>$code,'deleted'=>0));
		return $data;
	}

	public function verifyEmail($code){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('email_verification_code'=>$code,'verify_email_status'=>1,'deleted'=>0)));	
		return $count;
	}

	public function chkPhoneNoExist($phone){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('phone'=>$phone,'deleted'=>0)));	
		return $count;
	}


	public function chkEmailExist($email){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('email'=>$email,'deleted'=>0)));	
		return $count;
	}


	public function checkUserExist($phone){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('phone'=>$phone,'deleted'=>0,'status'=>1)));	
		return $count;
	}


	public function checkActiveEmailExistence($email){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('email'=>$email,'status_id'=>2,'deleted'=>0)));	
		return $count;
	}


	public function checkActivePhoneExistence($phone){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('phone'=>$phone,'status_id'=>2,'deleted'=>0)));	
		return $count;
	}


	public function checkPasswordExistence($password,$id){
		//print_r($password);exit;
		$count = $this->find('count',array('conditions'=>array('password'=>$password,'id'=>$id,'status_id'=>2,'deleted'=>0)));	
		//print_r($count);exit;
		return $count;
	}


	public function checkHashExistence($hash){
		//print_r($key);exit;
		$count = $this->find('count',array('conditions'=>array('pass_reset_hash'=>$hash,'status_id'=>2,'deleted'=>0)));	
		return $count;
	}

	public function getExistenceUserByHash($hash){
		$data = $this->find('all',array('conditions'=>array('email_verification_code'=>$hash,'deleted'=>0)));	
		//print_r($data);exit;
		return $data;
	}

	public function countEmailStatusByPhone($phone){
		$data = $this->find('count',array('conditions'=>array('phone'=>$phone,'verify_email_status'=>2,'deleted'=>0)));
		return $data;
	}

	public function countPhoneStatusByHash($hash){
		$data = $this->find('count',array('conditions'=>array('email_verification_code'=>$hash,'verify_phone_status'=>2,'deleted'=>0)));
		return $data;
	}

	public function getUserDataByPhone($phone){
		$data = $this->find('all',array('conditions'=>array('phone'=>$phone,'deleted'=>0)));	
		//print_r($data);exit;
		return $data;
	}


	public function updateVerifyEmailStatus($code){
		$data = $this->updateAll(array('verify_email_status'=>7),array('email_verification_code'=>$code,'deleted'=>0));
		return $data;
	}

	public function updatePhoneVerificationCode($code,$phone){
		$data = $this->updateAll(array('phone_verification_code'=>"'".$code."'"),array('phone'=>$phone,'deleted'=>0));
		return $data;
	}

	public function updateEmailActivationCode($code,$email){
		$data = $this->updateAll(array('email_verification_code'=>"'".$code."'"),array('email'=>$email,'deleted'=>0));
		return $data;
	}

	public function updatePasswordRequestHash($email,$hash){
		$data = $this->updateAll(array('pass_reset_hash'=>"'".$hash."'"),array('email'=>$email,'deleted'=>0));
		return $data;
	}

	public function updatePasswordByHash($password,$hash){
		$data = $this->updateAll(array('password'=>"'".$password."'"),array('pass_reset_hash'=>$email,'deleted'=>0,'status_id'=>2));
		return $data;
	}

	public function updatePasswordById($new_pass,$id){
		$data = $this->updateAll(array('password'=>"'".$new_pass."'"),array('id'=>$id,'deleted'=>0,'status_id'=>2));
		return $data;
	}

	public function updateStatus($id){
		$data = $this->updateAll(array('status_id'=>7),array('id'=>$id,'deleted'=>0));
		return $data;
	}


	public function updateSessionStatus($phone,$status){
		$data = $this->updateAll(array('session_status'=>$status),array('phone'=>$phone,'deleted'=>0));
		return $data;
	}


	public function updateName($id,$name){
		$data = $this->updateAll(array('name'=>"'".$name."'",'date_modified'=>"'".date('Y-m-d H:i')."'"),array('id'=>$id,'deleted'=>0));
		return $data;
	}

	public function updatePhone($id,$phone){
		$data = $this->updateAll(array('phone'=>"'".$phone."'",'date_modified'=>"'".date('Y-m-d H:i')."'"),array('id'=>$id,'deleted'=>0));
		return $data;
	}

	public function deleteUser($id){
		$data = $this->updateAll(array('deleted'=>1),array('id'=>$id));
		return $data;
	}
  	
	
}
?>