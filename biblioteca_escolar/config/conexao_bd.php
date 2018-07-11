<?php
	
ini_set("display_errors", 1);
error_reporting(E_ALL);

function Conecta_bd($host = "localhost",$user = "root", $pass = "cocytusbreath1+", $db = "bibliotecatcc"){
	$con = new mysqli($host, $user, $pass, $db);
	if ($con->connect_error) {
    	die("Connection failed: " . $con->connect_error);
	} 
	$con->set_charset("utf8");
	return $con;
}
function executar_sql($con, $sql){
	$result_query = $con->query($sql);
	return $result_query;
}
?>