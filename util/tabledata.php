<?php
///////Call For Root Dir Path
function TableData($sql)
{
	$rootPath = getParentDirPath(__DIR__);
	try
	{
		try
		{
			include_once($rootPath . "common/DConn.php");
			$conn=openConnection();
			$data=array();
			$result = $conn->query($sql);  
			$tbldata = array();  
			// fetch data in array format  
			while ($row=$result->fetch_assoc()) 
			{ 
				// Fetch data of Fname Column and store in array of row_array  
				//print($row["MaxSno"]);
				$tbldata[] = specialCharacterDecode($row);
				//push the values in the array  
				//array_push($json_response,$row_array);  
			}  
			//$data["tbldata"]=$tbldata;
			//$data["tblerror"]="";			
		}
		catch(Exceptioon $e)
		{
			//$data["tblerror"]="Failed due :".$e;
			//$data["tbldata"]="";
		}
	}
	catch(Exception $e1)
	{
		//$data["tblerror"]="Data Connection Failed due :".$e1;
		//$data["tbldata"]="";
	}
	//$myJSON = json_encode($data);
	return $tbldata;		
}
//TableData("SELECT IFNULL(MAX(sno)+1,1) AS MaxSno From partner_servey_allocation_details");
//echo TableData("SELECT branchsno, bid, branchname, branchaddress, branchstate, branchcity, branchcontact, branchemail FROM branch_master Order By branchname");
?>