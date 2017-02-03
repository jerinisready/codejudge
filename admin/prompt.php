<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Shows the list of users
 */
	require_once('../functions.php');
	if(!loggedin() or $_SESSION['username']!='admin')
		echo "<script>window.close();</script>";
	else
		include('header.php');
		$conn=connectdb();
?>
              <li class="active"><a href="#about">You are About to reset Our Site!</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
Hello, Admin,<br>
You are about to reset all the Data.<br>
Make Sure that No Competations are taking place and you are at safe zone.<br>
<br>
<br>
Proceeding further will result in:<br>
&nbsp.&nbsp.&nbsp.*&nbspRemovel of all Currently Registered participants and their access(Except 'admin').<br>
&nbsp &nbsp &nbsp &nbsp &nbsp (They can again Register next time!)<br>
&nbsp.&nbsp.&nbsp.*&nbsp.Removel of copy of all results and reports of previous events.<br>
&nbsp.&nbsp.&nbsp.*&nbsp.Removel of all Questions.<br>
<br>
All your Conigurations will be kept Unchanged!<br>
<br>
<br>
<br>
Enter administrator password to proceed further!"<br><br>
<?php
$conn=connectdb();
	if(isset($_POST['password'])) {
		if(trim($_POST['password']) != "")
		
			$query = "SELECT salt,hash FROM users WHERE username='admin'";
			$result = mysqli_query($conn,$query);
			$fields = mysqli_fetch_array($result,MYSQLI_BOTH);
			$currhash = crypt($_POST['password'], $fields['salt']);
			if($currhash == $fields['hash']) {
				sanitize_site();
			} 
			echo "<script>window.close();</script>";
		}
	
?>

<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>Codejudge Admin Panel Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      .footer {
        text-align: center;
        font-size: 11px;
      }
    </style>
    <link href="../css/bootstrap-responsive.css" rel="stylesheet">

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
          <a class="brand" href="#"><?php echo getName();?> </a>
        </div>
      </div>
    </div>

    <div class="container">
      <h1><small>Enter Password To Confirm Sanitizing!</small></h1>
      <p>Please login to use the admin panel.</p><br/>
      <form method="post" action="prompt.php">
        Password: <input type="password" name="password"/><br/><br/>
        <input class="btn" type="submit" name="submit" value="Login"/>
      </form>
    </div> <!-- /container -->	
<?php
	include('footer.php');
?>
