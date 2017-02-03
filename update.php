<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * script that performs some database operations
 */

	include('functions.php');
	$link = connectdb();


	if($_POST['action']=='email') {
		// change the email id of the user
		if(trim($_POST['email']) == "")
			header("Location: account.php?derror=1");
		else {
			mysqli_query($link,"UPDATE users SET email='".mysqli_real_escape_string($link,$_POST['email'])."' WHERE username='".$_SESSION['username']."'");
			header("Location: account.php?changed=1");
		}
	}



	else if($_POST['action']=='password') {
		// change the password of the user
		if(trim($_POST['oldpass']) == "" or trim($_POST['newpass']) == "")
			header("Location: account.php?derror=1");
		else {
			$query = "SELECT salt,hash FROM users WHERE username='".$_SESSION['username']."'";
			$result = mysqli_query($link,$query);
			$fields = mysqli_fetch_array($result,MYSQLI_BOTH);
			$currhash = crypt($_POST['oldpass'], $fields['salt']);
			if($currhash == $fields['hash']) {
				$salt = randomAlphaNum(5);
				$newhash = crypt($_POST['newpass'], $salt);
				mysqli_query($link,"UPDATE users SET hash='$newhash', salt='$salt' WHERE username='".$_SESSION['username']."'");
				header("Location: account.php?changed=1");
			} else
				header("Location: account.php?passerror=1");
		}
	}
?>
