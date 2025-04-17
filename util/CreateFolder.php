<?php
	function createFolder($FileLevel,$upload_dir)
	{
		$subfolders = ["CustomerDocs", "ProductDocs", "GuarantorDocs", "FinanceDocs"];
		if(!file_exists($FileLevel.$upload_dir))
		{
			mkdir($FileLevel.$upload_dir);
		}
		for($i=0; $i<sizeof($subfolders); $i++)
		{
			if(!file_exists($FileLevel.$upload_dir.$subfolders[$i]))
			{
				mkdir($FileLevel.$upload_dir.$subfolders[$i]);
			}
		}
	}
?>