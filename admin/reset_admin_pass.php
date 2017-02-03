<?php
//	admin/reset_admin_pass.php

require_once('../functions.php');
$conn=connectdb();

$salt=randomAlphaNum(5);
$pass="qwerty";
$hash= crypt($pass,$salt);

$sql="UPDATE `users` SET `salt`='".$salt."', `hash`='".$hash."' WHERE `username` = 'admin'";

// $sql="UPDATE INTO `users` ( `username` , `salt` , `hash` , `email` ) VALUES ('$pass', '$salt', '$hash', '".$_POST['email']."')";

mysqli_query($conn,$sql);
echo "salt: ".$salt."\nhash: ".$hash."\nNew Password : ".$pass;
echo "\n *** Change the password quickly *** ";

//header("Location: /admin/");
?>
