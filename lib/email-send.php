<?php

	function email_send($email, $category, $distance){

		$message = "A $category has been reported $distance away from you";

		$data = array("key"=>"1n_kxnhh9Pb71RF4DhsRww", "message"=>array("html"=>$message, "subject"=>"$category Reported Nearby", "from_email"=>"safetynotification@bathhackwinner.com", "from_name"=>"Panic Button!", "to"=>array(array("email"=>$email, "name"=>"Panic Button! Safety Report")), "headers"=>array("Reply-To"=>"safetynotification@bathhackwinner.com" ) );                                                                    
		$data_string = json_encode($data);                                                                                   
	 
		$ch = curl_init("https://mandrillapp.com/api/1.0/messages/send.json");                                                                      
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");                                                                     
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);                                                                  
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);                                                                      
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
			'Content-Type: application/json',                                                                                
			'Content-Length: ' . strlen($data_string))                                                                       
		);                                                                                                                   
	 
		$result = curl_exec($ch);
		$resdata = json_decode($result, true);

	}