<?php
	function getFiles(&$files)
	{
		$_files  = [ ];
		$_files_count = count( $files[ 'name' ] );
		$_files_keys  = array_keys( $files );
	
		for ( $i = 0; $i < $_files_count; $i++)
			foreach ( $_files_keys as $key )
				$_files[ $i ][ $key ] = $files[ $key ][ $i ];
	
		return $_files;
	}
	
	function uploadFilee($upload_dir,$upload_server_url,$FileLevel,$File,$FileName,$InternalFolder)
	{
		if($File)
		{	
			if(!file_exists($FileLevel.$upload_dir.$InternalFolder))
			{
				mkdir($FileLevel.$upload_dir.$InternalFolder);
			}
				
			$avatar_name = $File["name"];
			$avatar_tmp_name = $File["tmp_name"];
			$error = $File["error"];
			//print $avatar_name;
			if($error > 0)
			{
				return(false);
			}
			else 
			{
				$ss=explode(".",$avatar_name);
				$random_name = $FileName.".".$ss[1];
				if($InternalFolder != "")
				{
					$upload_name = $FileLevel.$upload_dir.$InternalFolder."/".$random_name;
				}
				else
				{
					$upload_name = $FileLevel.$upload_dir."/".$random_name;
				}
				$upload_name = preg_replace('/\s+/', '-', $upload_name);
				if($InternalFolder != "")
				{
					$return_upload_name = $InternalFolder."/".$random_name;
				}
				else
				{
					$return_upload_name = $random_name;
				}
				if(compressImage($avatar_tmp_name , $upload_name, 60))
				{
					return ($upload_server_url.$return_upload_name);
				}
				else
				{
					return(false);
				}
			}
		}
		else
		{
			return(false);
		}
	}
?>