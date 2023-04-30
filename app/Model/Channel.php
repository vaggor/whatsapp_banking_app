<?php
/**
* Branch Model
* The Branch model connects to the tb_branches table in the website database.
 * @package    Website-CMS
 * @author     Victor Sena Aggor
 * @version    Version1.0
*/

class Channel extends AppModel{
    var $name = 'Channel';
    var $useDbConfig = 'bot_signup';
	var $primaryKey = 'id';
	var $useTable = 'signups';
	
	var $validate = array(
			'bot_name' => array( 
            	'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please name the bot'
 			)),
			'api_key' => array( 
            	'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please enter api key'
 			)),
			'company' => array( 
            	'notempty' => array(
 				'rule' => 'notBlank',
				'message' => 'Please enter company name'
 			))
		);
		
		
	public function getChannels($status){
		return $this->find('all',array('conditions'=>array('deleted'=>0,'status'=>$status)));
	}

	public function listChannel(){
		return $this->find('list',array('conditions'=>array('deleted'=>0),'fields'=>array('channel_key','name')));	
	}

	public function validateKey($key){
		//print_r($key);exit;
		if(empty($key)){
			$count = 0;
		}
		else{
			$count = $this->find('count',array('conditions'=>array('api_key'=>$key,'deleted'=>0,'status'=>1)));	
		}
		return $count;
	}

	public function getChannelByID($id){
		return $this->find('all',array('conditions'=>array('id'=>$id,'deleted'=>0)));	
	}

	public function getChannelByChannelKey($key){
		return $this->find('all',array('conditions'=>array('channel_key'=>$key,'deleted'=>0)));	
	}

	
	public function getChannelKeyById($id){
		$data = $this->find('all',array('conditions'=>array('id'=>$id,'deleted'=>0),'fields'=>array('channel_key')));	
		return $data[0]['Channel']['channel_key'];
	}

	public function getChannelNameByKey($key){
		$data = $this->find('all',array('conditions'=>array('channel_key'=>$key,'deleted'=>0),'fields'=>array('name')));	
		return $data[0]['Channel']['name'];
	}

	public function checkUseChGLByKey($key){
		$data = $this->find('all',array('conditions'=>array('channel_key'=>$key,'deleted'=>0),'fields'=>array('use_ch_gl')));	
		return $data[0]['Channel']['use_ch_gl'];
	}

	
	public function deleteChannel($id){
		return $this->updateAll(array('deleted'=>'1'),array('id'=>$id));
	}
	
	public function updateStatus($id,$status){
		return $this->updateAll(array('status'=>$status),array('id'=>$id));
	}

	public function updateStatusChannels($id,$status,$user){
		return $this->updateAll(array('status'=>$status,'approver'=>$user,'date_approved'=>"'".date('Y-m-d H:i')."'"),array('id'=>$id));
	}

	public function generateChannelKey(){
    if (function_exists('com_create_guid')){
        $uuid = com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $uuid = chr(123)
                .substr($charid, 0, 8)
                .substr($charid, 8, 4)
                .substr($charid,12, 4)
                .substr($charid,16, 4)
                .substr($charid,20,12)
                .chr(125);
        $uuid = substr($uuid, 8,40);
    }
    return $uuid;
  }
	
	
}
?>