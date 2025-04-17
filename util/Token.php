<?php
function CheckValidQuery($conn,$sql,$type)
{
	try
	{	
		$c=1;
		if($type=="SELECT")
		{
			$xx=preg_split("@[;]@",$sql);
			if(sizeof($xx)==1)
			{
				if(trim($xx[0])!="")
				{
					for($i=0;$i<sizeof($xx);$i++)
					{
						$yy=preg_split("@[ ]@",$xx[$i]);
						if(strtoupper(trim($yy[0]))!="SELECT")
						{
							$c=0;
							break;	
						}
					}	
				}
			}
			else
			{
				$c=0;
			}
		}
		else if($type=="MULTISELECT")
		{
			$xx=preg_split("@[;]@",$sql);
			
			if(trim($xx[0])!="")
			{
				for($i=0;$i<sizeof($xx);$i++)
				{
					if($xx[$i]!="")
					{
						$yy=preg_split("@[ ]@",$xx[$i]);
						if(strtoupper(trim($yy[0]))!="SELECT")
						{
							$c=0;
							break;	
						}
					}
				}	
			}
			else
			{
				$c=0;
			}
		}
		else if($type=="UPDATE")
		{
			$xx=preg_split("@[;]@",$sql);
			for($i=0;$i<sizeof($xx);$i++)
			{
				if(trim($xx[$i])!="")
				{
					$yy=preg_split("@[ ]@",$xx[$i]);
					if(strtoupper(trim($yy[0]))!="UPDATE")
					{
						$c=0;
						break;	
					}
				}
			}	
		}
		else if($type=="DELETE")
		{
			$xx=preg_split("@[;]@",$sql);
			for($i=0;$i<sizeof($xx);$i++)
			{
				if(trim($xx[$i])!="")
				{
					$yy=preg_split("@[ ]@",$xx[$i]);
					if(strtoupper(trim($yy[0]))!="DELETE")
					{
						$c=0;
						break;	
					}
				}
			}	
		}
		else if($type=="INSERT")
		{
			$c=1;
			$xx=preg_split("@[;]@",$sql);
			for($i=0;$i<sizeof($xx);$i++)
			{
				if(trim($xx[$i])!="")
				{
					$yy=preg_split("@[ ]@",$xx[$i]);
					
					if(strtoupper(trim($yy[0]))!="UPDATE" && strtoupper(trim($yy[0]))!="INSERT" && strtoupper(trim($yy[0]))!="DELETE")
					{
						$c=0;
						break;
					}
				}
			}	
		}
		/////////////////
		if($c==1)
		{
			return true;
		}
		else
		{
			return false;	
		}
	}
	catch(Error $e)
	{
		//print $e;
		return false;
	}
}

function FetchRows($result)
{
	$output = array();
	while ($row = $result->fetch_assoc()) 
	{
		$output[] = specialCharacterDecode($row);
	}
	return $output;
}

function TokenGenerator($conn)
{
	$token="";
	for ($i = 1; $i <= 7; $i++) 
	{
		$bytes = openssl_random_pseudo_bytes($i, $cstrong);
		$hex   = bin2hex($bytes);
	
	   
		$token=$token.$hex;
	}
	return($token);
}
function isValidToken($conn,$token)
{
	$statement2= $conn->prepare("select Id from user where AuthToken='$token'");
	$statement2->execute();
	$result = $statement2->get_result();
	if($result->num_rows>0)
	{
		$row = $result->fetch_assoc();
		return($row["Id"]);
	}
	else
	{
		return(0);
	}
}
function getAuthorizationHeader()
{
	$headers = null;
	if (isset($_SERVER['Authorization'])) {
		$headers = trim($_SERVER["Authorization"]);
	}
	else if (isset($_SERVER['HTTP_AUTHORIZATION'])) { //Nginx or fast CGI
		$headers = trim($_SERVER["HTTP_AUTHORIZATION"]);
	} elseif (function_exists('apache_request_headers')) {
		$requestHeaders = apache_request_headers();
		// Server-side fix for bug in old Android versions (a nice side-effect of this fix means we don't care about capitalization for Authorization)
		$requestHeaders = array_combine(array_map('ucwords', array_keys($requestHeaders)), array_values($requestHeaders));
		//print_r($requestHeaders);
		if (isset($requestHeaders['Authorization'])) {
			$headers = trim($requestHeaders['Authorization']);
		}
	}
	return $headers;
}
/**
 * get access token from header
 * */
function getBearerToken() {
    $headers = getallheaders();
    error_log("All Headers: " . print_r($headers, true)); // Log all headers
    if (isset($headers['Authorization'])) {
        $matches = array();
        if (preg_match('/Bearer\s(\S+)/', $headers['Authorization'], $matches)) {
            return $matches[1];
        }
    }
    return null;
}

function sendHttpResponceCode($code = NULL)
{
	if ($code !== NULL) 
	{
		switch ($code) 
		{
			case 100: $text = 'Continue'; break;
			case 101: $text = 'Switching Protocols'; break;
			case 200: $text = 'OK'; break;
			case 201: $text = 'Created'; break;
			case 202: $text = 'Accepted'; break;
			case 203: $text = 'Non-Authoritative Information'; break;
			case 204: $text = 'No Content'; break;
			case 205: $text = 'Reset Content'; break;
			case 206: $text = 'Partial Content'; break;
			case 300: $text = 'Multiple Choices'; break;
			case 301: $text = 'Moved Permanently'; break;
			case 302: $text = 'Moved Temporarily'; break;
			case 303: $text = 'See Other'; break;
			case 304: $text = 'Not Modified'; break;
			case 305: $text = 'Use Proxy'; break;
			case 400: $text = 'Bad Request'; break;
			case 401: $text = 'Unauthorized'; break;
			case 402: $text = 'Payment Required'; break;
			case 403: $text = 'Forbidden'; break;
			case 404: $text = 'Not Found'; break;
			case 405: $text = 'Method Not Allowed'; break;
			case 406: $text = 'Not Acceptable'; break;
			case 407: $text = 'Proxy Authentication Required'; break;
			case 408: $text = 'Request Time-out'; break;
			case 409: $text = 'Conflict'; break;
			case 410: $text = 'Gone'; break;
			case 411: $text = 'Length Required'; break;
			case 412: $text = 'Precondition Failed'; break;
			case 413: $text = 'Request Entity Too Large'; break;
			case 414: $text = 'Request-URI Too Large'; break;
			case 415: $text = 'Unsupported Media Type'; break;
			case 500: $text = 'Internal Server Error'; break;
			case 501: $text = 'Not Implemented'; break;
			case 502: $text = 'Bad Gateway'; break;
			case 503: $text = 'Service Unavailable'; break;
			case 504: $text = 'Gateway Time-out'; break;
			case 505: $text = 'HTTP Version not supported'; break;
			case 506: $text = 'Not Supported JSON Format'; break;
			case 1062: $text = 'Duplicate Primary Entry'; break;
			case 1063: $text = 'Data Not Updated'; break;
			default:
				exit('Unknown http status code "' . htmlentities($code) . '"');
			break;
		}
	
		$protocol = (isset($_SERVER['SERVER_PROTOCOL']) ? $_SERVER['SERVER_PROTOCOL'] : 'HTTP/1.0');

		header($protocol . ' ' . $code . ' ' . $text);
		return($protocol . ' ' . $code . ' ' . $text);
	}
}
?>