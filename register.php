<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Codejudge Login page
 */
	if(!file_exists("dbinfo.php")){header("Location: install.php");}
	require_once('functions.php');
	if(loggedin())
		header("Location: index.php");
	else if(isset($_POST['action'])) {
		$link=connectdb();
		$username = array_key_exists('username', $_POST) ? mysqli_real_escape_string($link,trim($_POST['username'])) : "";
		if($_POST['action']=='login') {
			if(trim($username) == "" or trim($_POST['password']) == "") {
				header("Location: register.php?derror=1"); // empty entry
			} else {
				// code to login the user and start a session
				$query = "SELECT salt,hash FROM users WHERE username='".$username."'";
				$result = mysqli_query($link,$query);
				$fields = mysqli_fetch_array($result,MYSQLI_BOTH);
				$currhash = crypt($_POST['password'], $fields['salt']);
				if($currhash == $fields['hash']) {
					$_SESSION['username'] = $username;
					header("Location: index.php");
				} else
					header("Location: login.php?error=1");
			}
		} else if($_POST['action']=='register') {
			// register the user
        $email = array_key_exists('email', $_POST) ? mysqli_real_escape_string($link,trim($_POST['email'])) : "";
		if(trim($username) == "" and trim($_POST['password']) == "" and trim($email) == "") {
				header("Location: register.php?derror=1"); // empty entry
			} else {
				// create the entry in the users table
				$link=connectdb();
				$query = "SELECT salt,hash FROM users WHERE username='".$username."'";
				$result = mysqli_query($link,$query);
				if(mysqli_num_rows($result)!=0) {
					header("Location: register.php?exists=1");
				} else {
					$salt = randomAlphaNum(5);
					$hash = crypt($_POST['password'], $salt);
					$sql="INSERT INTO `users` ( `username` , `salt` , `hash` , `email`, `status` ) VALUES ('".$username."', '$salt', '$hash', '".$email."', '1')";
					$result=mysqli_query($link,$sql);
					header("Location: register.php?registered=1&result=".$result);
				}
			}
		}
	}
?>
<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title><?php echo(getName()); ?> Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
      }
    </style>
	<style>
	ul{cursor:pointer;}
	ul.pagination {
		display: inline-block;
		padding: 0;
		margin: 0;
	}

	ul.pagination li {display: inline;}

	ul.pagination li a {
		color: black;
		float: left;
		padding: 8px 16px;
		text-decoration: none;
		transition: background-color .3s;
		border: 1px solid #ddd;
		font-size: 18px;
	}

	ul.pagination li a.active {
		background-color: eee;
		color: black;
		border: 1px solid #ddd;
	}

	ul.pagination li a:hover:not(.active) {background-color: #ccc;}
	</style>

    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="http://twitter.github.com/bootstrap/assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="http://twitter.github.com/bootstrap/assets/ico/apple-touch-icon-57-precomposed.png">
	</head>

  <body>


    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#"><?php echo(getName()); ?></a>
        </div>
      </div>
    </div>

    <div class="container">

      <?php
        if(isset($_GET['logout']))
          echo("<div class=\"alert alert-info\">\nYou have logged out successfully!\n</div>");
        else if(isset($_GET['error']))
          echo("<div class=\"alert alert-error\">\nIncorrect username or password!\n</div>");
        else if(isset($_GET['registered']))
          echo("<div class=\"alert alert-success\">\nYou have been registered successfully! Login to continue.\n</div>");
        else if(isset($_GET['exists']))
          echo("<div class=\"alert alert-error\">\nUser already exists! Please select a different username.\n</div>");
        else if(isset($_GET['derror']))
          echo("<div class=\"alert alert-error\">\nPlease enter all the details asked before you can continue!\n</div>");
      ?>

	  
	  <div id="switched_body">
		<form method="post" action="login.php">
			<input type="hidden" name="action" value="register"/>
			<h1><small>New User? Register now</small></h1>
			<p>Login to continue.</p><br/>
			Username: <input type="text" name="username" placeholder=username /><br/>
			Password: <input type="password" name="password" placeholder=password /><br/>
			Email: <input type="email" name="email" placeholder=email />
			<br/><br/>
			<input class="btn btn-primary" type="submit" name="submit" value="Register"/>
		</form>
	  </div>
      <hr/>
	  <ul class="pagination" style="">
			<li > <a href="login.php">LOGIN </a>	</li>
			<li > <a>REGISTER </a></li>
	  </ul>


	  <!-- /container -->
		
      
<?php
	include('footer.php');
?>
