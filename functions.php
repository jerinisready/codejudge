<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Remodified By JERIN KACHIRACKAL (jerinisready@gmail.com)
 * Licensed under MIT License.
 *
 * Common functions used throughout Codejudge
 */
session_start();
//$conn;

// checks if any user is logged in
function loggedin() {
  return isset($_SESSION['username']);
}

// connects to the database
function connectdb() {
  include('dbinfo.php');
  $conn=mysqli_connect($host,$user,$password,$database);
  mysqli_select_db($conn,$database) or die('Error connecting to database.');
  return $conn;
}

function status() {
	
	
}



function points() {
	$link=connectdb();
	$total=0;
$sql = "SELECT * FROM solve WHERE (status='2' AND username='".$_SESSION['username']."')";
       		$res = mysqli_query($link,$sql);
				if(mysqli_num_rows($res)>0){
					while( $row_arr = mysqli_fetch_array($res,MYSQLI_BOTH) )
						$total=$total+(int)$row_arr['points'];
				}
			return $total;
}


// generates a random alpha numeric sequence. Used to generate salt
function randomAlphaNum($length){
  $rangeMin = pow(36, $length-1);
  $rangeMax = pow(36, $length)-1;
  $base10Rand = mt_rand($rangeMin, $rangeMax);
  $newRand = base_convert($base10Rand, 10, 36);
  return $newRand;
}

// gets the name of the event
function getName(){
  $link=connectdb();
  $query="SELECT name FROM prefs";
  $result = mysqli_query($link,$query);
  $row = mysqli_fetch_array($result,MYSQLI_BOTH);
  return $row['name'];
}
// remove all the Deligates
function sanitize_site(){
   mysqli_query($link,"DELETE FROM `users` WHERE `username` != 'admin';");
   mysqli_query($link,"DELETE FROM `solve` WHERE 1;");
   mysqli_query($link,"DELETE FROM `problems` WHERE 1;");
}


// converts text to an uniform only '\n' newline break
function treat($text) {
	$s1 = str_replace("\n\r", "\n", $text);
	return str_replace("\r", "", $s1);
}
