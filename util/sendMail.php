<?php
	function sendMail($toName, $to, $subject, $sender, $senderName, $replyTo, $replyToName, $messageHeader, $bodyMessage)
	{
		$Url = "https://mailserver.ssinformatics.org.in";
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $Url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => '',
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => 'POST',
		  CURLOPT_POSTFIELDS =>'{
			"toName": "'.$toName.'",
			"to": "'.$to.'",
			"subject": "'.$subject.'",
			"sender": "'.$sender.'",
			"senderName": "'.$senderName.'",
			"replyTo": "'.$replyTo.'",
			"replyToName": "'.$replyToName.'",
			"messageHeader": "'.$messageHeader.'",
			"bodyMessage": "'.$bodyMessage.'"
		  }',
		  CURLOPT_HTTPHEADER => array(
			'Content-Type: text/plain'
		  ),
		));
		$response = curl_exec($curl);
		curl_close($curl);
		return $response;
	}
?>