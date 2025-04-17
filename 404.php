<?php
include_once("util/Token.php");
$data = array();
$data["status"] = 500;
$data["success"] = false;
$data["message"] = sendHttpResponceCode(500);
$data["error"] = "Something Went Wrong";

echo json_encode($data);
