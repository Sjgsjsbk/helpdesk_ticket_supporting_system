<?php
	function getDocbaseURL()
	{
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			 $url = "https://";   
		else  
			 $url = "http://";   
		// Append the host(domain name, ip) to the URL.   
		$url.= $_SERVER['HTTP_HOST'];   
		
		// Append the requested resource location to the URL   
		$url.= $_SERVER['REQUEST_URI'];    
		$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		$url=str_replace($curPageName,"",$url);
		return($url);  
	}
	function getBasePath()
	{
		if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
			 $url = "https://";   
		else  
			 $url = "http://";   
		// Append the host(domain name, ip) to the URL.   
		$url.= $_SERVER['HTTP_HOST'];   
		
		if(strpos($_SERVER['HTTP_HOST'],"localhost") !== false)
		{
			$url .= "/Modi_Finance_CRM/images/logo.png";
		}
		return $url;
	}
	function getFileURL($curPath, $baseDir, $redirectDir = '')
	{
		if(strpos($_SERVER['HTTP_HOST'],"localhost") !== false)
		{		
			$dirs=explode('/',$curPath);
		}
		else
		{
			$dirs=explode('/',$curPath);
		}
		$newPath="";
		for($i=0;$i<=sizeof($dirs)-1;$i++)
		{
			if($dirs[$i]!="API")
			{
				$newPath = $newPath.$dirs[$i]."/";
			}
			else
			{
				if($redirectDir != "")
				{
					$newPath = $newPath.$dirs[$i]."/uploads/".$redirectDir."/".$baseDir."/";
				}
				else
				{
					$newPath = $newPath.$dirs[$i]."/uploads/".$baseDir."/";
				}
				break;
			}
		}
		return $newPath;
	}
	function getKeyString()
	{
		//SHA2('YorBux',512)
		return ("4e67ab3f73be39ee3e1b7240476538dc3cea26798dd63c441ba70e328abb8c6414d6fb451c5f2bec066d8ef21f4e1dc9168013ceda197ade94f0d588ae11ca13");
	}
	function getClientIp() 
	{
		$ipaddress = '';
		if (isset($_SERVER['HTTP_CLIENT_IP']))
			$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
		else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_X_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
		else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
			$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
		else if(isset($_SERVER['HTTP_FORWARDED']))
			$ipaddress = $_SERVER['HTTP_FORWARDED'];
		else if(isset($_SERVER['REMOTE_ADDR']))
			$ipaddress = $_SERVER['REMOTE_ADDR'];
		else
			$ipaddress = 'UNKNOWN';
		return $ipaddress;
	}
	function getLocation($ip)
	{
		//$ip = "110.224.170.83";
		$output = "";
		try
		{
			// create & initialize a curl session
			$curl = curl_init();
			// set our url with curl_setopt()
			curl_setopt($curl, CURLOPT_URL, "https://ipapi.co/$ip/jsonp/");
			
			// return the transfer as a string, also with setopt()
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			// curl_exec() executes the started curl session
			// $output contains the output string
			$output = curl_exec($curl);
			$output=substr($output,9,strlen($output));
			$output = json_decode(str_replace(");","",$output), true);
			// close curl resource to free up system resources
			// (deletes the variable made by curl_init)
			curl_close($curl);
		}
		catch(Exception $e)
		{
		}
		catch(Error $e)
		{
		}
		return $output;
	}
	function detectDevice()
	{
		$userAgent = $_SERVER["HTTP_USER_AGENT"];
		$deviceName="NONE";
		$devicesTypes = array(
			"computer" => array("msie 10", "msie 9", "msie 8", "windows.*firefox", "windows.*chrome", "x11.*chrome", "x11.*firefox", "macintosh.*chrome", "macintosh.*firefox", "opera"),
			"tablet"   => array("tablet", "android", "ipad", "tablet.*firefox"),
			"mobile"   => array("mobile ", "android.*mobile", "iphone", "ipod", "opera mobi", "opera mini"),
			"bot"      => array("googlebot", "mediapartners-google", "adsbot-google", "duckduckbot", "msnbot", "bingbot", "ask", "facebook", "yahoo", "addthis")
		);
		foreach($devicesTypes as $deviceType => $devices) {           
			foreach($devices as $device) {
				if(preg_match("/" . $device . "/i", $userAgent)) {
					$deviceName = $deviceType;
				}
			}
		}
		return ucfirst($deviceName);
	}
	function getOS() 
	{ 
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		$os_platform  = "Unknown OS Platform";
		$os_array = array(
			  '/windows nt 10/i'      =>  'Windows 10',
			  '/windows nt 6.3/i'     =>  'Windows 8.1',
			  '/windows nt 6.2/i'     =>  'Windows 8',
			  '/windows nt 6.1/i'     =>  'Windows 7',
			  '/windows nt 6.0/i'     =>  'Windows Vista',
			  '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
			  '/windows nt 5.1/i'     =>  'Windows XP',
			  '/windows xp/i'         =>  'Windows XP',
			  '/windows nt 5.0/i'     =>  'Windows 2000',
			  '/windows me/i'         =>  'Windows ME',
			  '/win98/i'              =>  'Windows 98',
			  '/win95/i'              =>  'Windows 95',
			  '/win16/i'              =>  'Windows 3.11',
			  '/macintosh|mac os x/i' =>  'Mac OS X',
			  '/mac_powerpc/i'        =>  'Mac OS 9',
			  '/linux/i'              =>  'Linux',
			  '/ubuntu/i'             =>  'Ubuntu',
			  '/iphone/i'             =>  'iPhone',
			  '/ipod/i'               =>  'iPod',
			  '/ipad/i'               =>  'iPad',
			  '/android/i'            =>  'Android',
			  '/blackberry/i'         =>  'BlackBerry',
			  '/webos/i'              =>  'Mobile'
		);
		foreach ($os_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$os_platform = $value;
		if(!$os_platform)
		{
		   $os_platform='Not Defined';
		}
		return $os_platform;
	}	
	function getBrowser() 
	{
		$user_agent=$_SERVER['HTTP_USER_AGENT'];
		$browser = "Unknown Browser";
		$browser_array = array(
				'/Trident/i'   => 'Internet Explorer',
				'/msie/i'      => 'Internet Explorer',
				'/firefox/i'   => 'Firefox',
				'/safari/i'    => 'Safari',
				'/chrome/i'    => 'Chrome',
				'/edge/i'      => 'Edge',
				'/opera/i'     => 'Opera',
				'/netscape/i'  => 'Netscape',
				'/maxthon/i'   => 'Maxthon',
				'/konqueror/i' => 'Konqueror',
				'/mobile/i'    => 'Handheld Browser'
		);
	
		foreach ($browser_array as $regex => $value)
			if (preg_match($regex, $user_agent))
				$browser = $value;
		if(!$browser)
		{
		   $browser='Not Defined';
		}  
		return $browser;
	}
	function exchangeRate( $amount, $from, $to)
	{
		$conv_id = "{$from}_{$to}";
		$string = file_get_contents("http://free.currencyconverterapi.com/api/v3/convert?q=$conv_id&compact=ultra");
  		$json_a = json_decode($string, true);

  		return $amount * round($json_a[$conv_id], 2);
	}	
	function getIndianCurrency(float $number)
	{
		$no = round($number);
		$decimal = round($number - ($no = floor($number)), 2) * 100;    
		$digits_length = strlen($no);    
		$i = 0;
		$str = array();
		$words = array(
			0 => '',
			1 => 'One',
			2 => 'Two',
			3 => 'Three',
			4 => 'Four',
			5 => 'Five',
			6 => 'Six',
			7 => 'Seven',
			8 => 'Eight',
			9 => 'Nine',
			10 => 'Ten',
			11 => 'Eleven',
			12 => 'Twelve',
			13 => 'Thirteen',
			14 => 'Fourteen',
			15 => 'Fifteen',
			16 => 'Sixteen',
			17 => 'Seventeen',
			18 => 'Eighteen',
			19 => 'Nineteen',
			20 => 'Twenty',
			30 => 'Thirty',
			40 => 'Forty',
			50 => 'Fifty',
			60 => 'Sixty',
			70 => 'Seventy',
			80 => 'Eighty',
			90 => 'Ninety');
		$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
		while ($i < $digits_length) {
			$divider = ($i == 2) ? 10 : 100;
			$number = floor($no % $divider);
			$no = floor($no / $divider);
			$i += $divider == 10 ? 1 : 2;
			if ($number) {
				$plural = (($counter = count($str)) && $number > 9) ? 's' : null;            
				$str [] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural;
			} else {
				$str [] = null;
			}  
		}
		
		$Rupees = implode(' ', array_reverse($str));
		$paise = ($decimal) ? "And " . ($words[$decimal - $decimal%10]) ." " .($words[$decimal%10])  : '';
		if($paise!='')
		{
			$data=($Rupees ? $Rupees : '') . $paise . " Paise.";
		}
		else
		{
			$data=($Rupees ? $Rupees : '');
		}
		return $data;
	}		
	function decrypt($string, $action) 
	{
		// you may change these values to your own
		$secret_key = 'my_simple_secret_key';
		$secret_iv = 'my_simple_secret_iv';
	 
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$key = hash( 'sha256', $secret_key );
		$iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );
	 
		if( $action == 'e' ) {
			$output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
		}
		else if( $action == 'd' ){
			$output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
		}
	 
		return $output;
	}
	function randomString($length = 6) 
	{
		$str = "";
		$characters = array_merge(range('A','Z'), range('a','z'), range('0','9'));
		$max = count($characters) - 1;
		for ($i = 0; $i < $length; $i++) 
		{
			$rand = mt_rand(0, $max);
			$str.= $characters[$rand];
		}
		return $str;
	}
	function specialCharacterEncode($data) 
	{
		$data=str_ireplace("'","[{SQ}]",$data);
		$data=str_ireplace("&","[{ND}]",$data);
		$data=str_ireplace("\"","[{DQ}]",$data);
		$data=str_ireplace("<","[{LT}]",$data);
		$data=str_ireplace(">","[{GT}]",$data);
		$data=str_ireplace("#","[{HS}]",$data);
		$data=str_ireplace("%","[{PER}]",$data);
		$data=str_ireplace(";","[{SC}]",$data);
		$data=str_ireplace("+","[{PLS}]",$data);
		
		return($data);
	}	
	function specialCharacterDecode($data) 
	{
		$data=str_ireplace("[{SQ}]","'",$data);
		$data=str_ireplace("[{ND}]","&",$data);
		$data=str_ireplace("[{DQ}]","\"",$data);
		$data=str_ireplace("[{LT}]","<",$data);
		$data=str_ireplace("[{GT}]",">",$data);
		$data=str_ireplace("[{HS}]","#",$data);
		$data=str_ireplace("[{PER}]","%",$data);
		$data=str_ireplace("[{SC}]",";",$data);
		$data=str_ireplace("[{PLS}]","+",$data);
		
		return($data);
	}	
	
	function compressImage($source, $destination, $quality) 
	{
		try
		{
			$res = move_uploaded_file($source, $destination);
			$info = @getimagesize($destination);
			//var_dump($res);
			
			if ($info['mime'] == 'image/jpeg') 
				$image = imagecreatefromjpeg($destination);
			elseif ($info['mime'] == 'image/png') 
				$image = imagecreatefrompng($destination);
			if($info['mime'] == 'image/jpeg' || $info['mime'] == 'image/png')
			{
				$res = imagejpeg($image, $destination, $quality);
			}
			/*else
			{
				$res = move_uploaded_file($destination, $destination);
				var_dump($res);
			}*/
		}
		catch(Exception $er)
		{
			print $res;
		}
	  	return $res;
	}
	
	function SqlDateConverter($ddmmyyyyDate)
	{
		$DateArray = preg_split("@[/]@", $ddmmyyyyDate);
		if(sizeof($DateArray) == 3)
		{
			return $DateArray[2]."-".$DateArray[1]."-".$DateArray[0];
		}
		else
		{
			return "";
		}
	}
?>