<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	public function formatePhoneNumber($phone){
		$exp = explode(':', $phone);
		$phone_no = $exp[1];
		return $phone_no;
	}

	public function failureResponse($err_mess,$model){
		$json = '{
	        "'.$model.'": {
	            "status_id": "00",
	            "status": "Failed",
	            "description": "'.$err_mess.'"
	        }
	    }';
		return $json;
	}


	public function failureResponse2($err_mess){
		$json = '{
	        "status_id": "00",
	        "status": "Failed",
	        "description": "'.$err_mess.'"
	    }';
		return $json;
	}

	public function successResponse($err_mess,$model){
		$json = '{
	        "'.$model.'": {
	            "status_id": "1",
	            "status": "Success",
	            "description": "'.$err_mess.'"
	        }
	    }';
		return $json;
	}

	public function successResponseCreateUser($mess){
		$json = '{
	        "User": {
	            "status_id": "1",
	            "status": "Success",
	            "description": "'.$mess.'"
	        }
	    }';
		return $json;
	}

	public function successResponseLoginUser($cust_info,$mess){
		$json = '{
	        "User": {
	            "status_id": "1",
	            "status": "Success",
	            "description": "'.$mess.'",
	            "phone_no_status": "'.$cust_info[0]['User']['verify_phone_status'].'",
	            "email_status": "'.$cust_info[0]['User']['verify_email_status'].'",
	            "customer_id": "'.$cust_info[0]['User']['id'].'",
	            "name": "'.$cust_info[0]['User']['name'].'",
	            "phone": "'.$cust_info[0]['User']['phone'].'",
	            "email": "'.$cust_info[0]['User']['email'].'",
	            "usergroup": "'.$cust_info[0]['User']['usergroup_id'].'",
	            "api_key": "'.$cust_info[0]['User']['api_key'].'"
	        }
	    }';
		return $json;
	}


	public function successResponseDistance($distance,$duration,$unit_amount,$amount){
		$json = '{
	        "Transaction": {
	            "status_id": "1",
	            "status": "Success",
	            "distance": "'.$distance.'",
	            "duration": "'.$duration.'",
	            "unit_amount": "'.$unit_amount.'",
	            "amount": "'.$amount.'"
	        }
	    }';
		return $json;
	}


	public function sendEmailRequest($to,$subject,$body){
		$json = '{
					"Message": {
						"from": "bikedeliver@victoraggor.com",
						"alias": "BikeDelivery",
						"to": "'.$to.'",
						"subject": "'.$subject.'",
						"body": "'.$body.'"
					}
				}';
		return $json;
	}


	public function generateCode($len){
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
	        $uuid = substr($uuid, 8,$len);
	    }
	    return $uuid;
  	}


  	public function regenerateCode($field){
	    $uuid = $this->getUniqueGeneratedCode($field);
	    return $uuid;
  	}


  	public function getUniqueGeneratedCode($field){
  		$code = $this->generateCode(6);
  		$count = $this->find('count',array('conditions'=>array($field=>$code)));
  		if($count != 0){
  			$this->regenerateCode($field);
  		}
  		else{
  			$uuid = $code;
  		}
  		return $uuid;
  	}


  	public function getToCurl($url){
		$CURL = curl_init();
	    curl_setopt($CURL, CURLOPT_URL, $url); 
	    //curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	    //curl_setopt($CURL, CURLOPT_POST, 1); 
	    //curl_setopt($CURL, CURLOPT_POSTFIELDS, $data); 
	    curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-type: application/json; charset=utf-8'));
	    curl_setopt($CURL, CURLOPT_HEADER, false); 
	    curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($CURL, CURLOPT_CUSTOMREQUEST, "GET"); 
	    curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
	    $resp = curl_exec($CURL); 
	    //$status_code = curl_getinfo($CURL, CURLINFO_HTTP_CODE);  
	    //print_r($resp);exit;
	    return $resp;
	}

	public function postToCurl($url,$data){
		$CURL = curl_init();
	    curl_setopt($CURL, CURLOPT_URL, $url); 
	    //curl_setopt($CURL, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
	    curl_setopt($CURL, CURLOPT_POST, 1); 
	    curl_setopt($CURL, CURLOPT_POSTFIELDS, $data); 
	    curl_setopt($CURL, CURLOPT_HTTPHEADER, array('Content-type: application/json;','Auth-Code: 233AB80548A324135EC8'));
	    curl_setopt($CURL, CURLOPT_HEADER, false); 
	    curl_setopt($CURL, CURLOPT_SSL_VERIFYPEER, false);
	    curl_setopt($CURL, CURLOPT_CUSTOMREQUEST, "POST"); 
	    curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true);
	    $resp = curl_exec($CURL); 
	    //$status_code = curl_getinfo($CURL, CURLINFO_HTTP_CODE);  
	    //print_r(curl_getinfo($CURL));exit;
	    return $resp;
	}


	public function sendEmail($to,$subject,$body){
		$message = '
		<html>
			<head>
				<title>GrabNEarn</title>
			</head>
			<body>
				<p>'.$body.'</p>
			</body>
		</html>
		';

		// To send HTML mail, the Content-type header must be set
		$headers[] = 'MIME-Version: 1.0';
		$headers[] = 'Content-type: text/html; charset=iso-8859-1';

		// Additional headers
		//$headers[] = 'To: Victor <'.$to.'>';
		$headers[] = 'From: GrabNEarn <notifications@grabnearn.com>';
				
		//$this->log($to, 'debug');
		// Mail it
		$resp = mail($to, $subject, $message, implode("\r\n", $headers));
		//print_r($resp);exit;
		return $resp;
	}

	public function sendEmailCurl($to,$subject,$body){
		$email_json = $this->sendEmailRequest($to,$subject,$body);
		$url = 'http://ialert.clickmegh.com/ialert/ialert/api_v1_0/send_message';
		//print_r($email_json);exit;
		$this->postToCurl($url,$email_json);
		return;
	}


	public function validatePhoneNumber($phone){
		$phone_ln = strlen($phone);
		$first_3_digits = substr($phone, 0,3);
		$first_4_digits = substr($phone, 0,4);
		$first_1_digits = substr($phone, 0,1);
		//print_r($first_3_digits);exit;
		if($phone_ln == 10 and $first_1_digits == '0'){
			$phone = '+233'.substr($phone, 1,9);
		}
		elseif($phone_ln == 12 and $first_3_digits == '233'){
			$phone = '+'.$phone;
		}
		elseif($phone_ln == 13 and $first_4_digits == '+233'){
			$phone = $phone;
		}
		else{
			$phone = 0;
		}
		return $phone;
	}


	


	public function uploadDocument($data,$serial){
		//print_r($data);exit;
		//--------------------------------------- Start Processing Doc uploded ------------------------------------------------
		
			$file = new File($data['tmp_name']);
			$ext = $data['name'];
			$point = strrpos($ext,".");
				
			$ext = substr($ext,$point+1,(strlen($ext)-$point));
			$ext=strtolower($ext);
			$types = array('jpg','jpeg','png');
			if (!in_array($ext,$types)) {
				$path ='';
			} 
			else {
				ini_set('date.timezone', 'Europe/London');   
				//$now = $doc_type[$data['Document']['doc_typeid']].'_'.date('Y-m-d_H-i-s');
				$now = str_replace(' ','_',$serial).'_'.date('H-i-s');
				$name= $now;
				$filename = $name.'.'.$ext;
				$data1 = $file->read();
				$file->close();
				
				$path=WWW_ROOT.'img/images/'.$filename;
				$file = new File(WWW_ROOT.'img/images/'.$filename,true);
				$file->write($data1);
				//echo "whoop";
				$path = $filename;
			}
			//--------------------------------------- End Processing Excel uploded -------------------------------------------------
			
			return $path;
	}

}
