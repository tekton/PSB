<?php
date_default_timezone_set("America/Los_Angeles");
require_once("gdef.php");

function ConnectDB($db="", $host="", $user="", $password="") {
	
	if($db == "") 		{$db = DB;}
	if($host == "") 	{$host = HOST;}
	if($user == "") 	{$user = USER;}
	if($password == "") {$password = PASSWORD;}
	
	$g_link = mysql_connect($host, $user, $password) or die('Storms2DB: Could not connect to server.'.mysql_error());
	mysql_select_db($db, $g_link) or die('Storms2DB: Could not select database :: '.mysql_error());
	return $g_link;
}

function CleanUpDB($db) {
	if( $db != false ) { mysql_close($db); }
	$db = false;
	return $db;
}

function debug_object($obj, $level=0) {
    if(DBUG > $level) {
        echo "<pre>";
            print_r($obj);
        echo "</pre>";
    }
}

?>
