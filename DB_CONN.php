<?php 
// Database configuration 

$dbHost     = "localhost"; 
$dbUsername = "u663775317_yhyj"; 
$dbPassword = "egeNuVuZev"; 
$dbName     = "u663775317_yhyj"; 
/*

$dbHost     = "localhost"; 
$dbUsername = "root"; 
$dbPassword = ""; 
$dbName     = "harman3"; 
  */

error_reporting (E_ALL ^ E_NOTICE);

// Create database connection 
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName); 
 
// Check connection 

if ($db->connect_error) { 
    die("Connection failed: " . $db->connect_error); 
}

date_default_timezone_set('America/Chihuahua');
$date = date('Y-m-d H:i:s');