<?php
	function uploadFile($upload_dir,$upload_server_url,$FileLevel,$FieldIndex,$FileName,$InternalFolder)
	{
		if($_FILES[$FieldIndex])
		{
			//print $FileLevel.$upload_dir.$InternalFolder;
			if(!file_exists($FileLevel.$upload_dir.$InternalFolder))
			{
				mkdir($FileLevel.$upload_dir.$InternalFolder);
			}
				
			$avatar_name = $_FILES[$FieldIndex]["name"];
			$avatar_tmp_name = $_FILES[$FieldIndex]["tmp_name"];
			$error = $_FILES[$FieldIndex]["error"];
			
			if($error > 0)
			{
				return(false);
			}
			else 
			{
				$ss=explode(".",$avatar_name);
				$fext = $ss[1];
				$random_name = $FileName.".".$fext;
				if($InternalFolder != "")
				{
					$upload_name = $FileLevel.$upload_dir.$InternalFolder."/".$random_name;
				}
				else
				{
					$upload_name = $FileLevel.$upload_dir.$random_name;
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
			
				if(compressImage($avatar_tmp_name, $upload_name, 60))
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