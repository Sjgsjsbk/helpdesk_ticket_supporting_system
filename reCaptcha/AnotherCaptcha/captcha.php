<?php
	session_start();
	include("phpcaptchaClass.php");	
	
	/*create class object*/
	$phptextObj = new phpcaptchaClass();	
	/*phptext function to genrate image with text*/
	$phptextObj->phpcaptcha('#000','#fff',120,40,10,25);	
 ?>