<?php
    function sendSMS($noHP, $nama, $produk){
		$fields_string  =   "";
		$fields     =   array(
							'api_key'       =>  '65d505a1',
							'api_secret'    =>  'fdda4cf940cda526',
							'to'            =>  $noHP,
							'from'          =>  'Tirta Anugrah',
							'text'          =>  'Yth. Sdr. ' . $nama . ' produk ' . $produk . ' harap segera diambil. Terimakasih. \ -Tirta Anugrah-'
		);
		$url        =   'https://rest.nexmo.com/sms/json';

		//url-ify the data for the POST
		foreach($fields as $key=>$value) {   
				$fields_string .= $key.'='.$value.'&';
				}
		rtrim($fields_string, '&');

			//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, count($fields));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

		//execute post
		$result = curl_exec($ch);
		//close connection
		curl_close($ch);
	}
?>
