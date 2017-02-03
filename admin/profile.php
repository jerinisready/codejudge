<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Profileof the users
 */
	require_once('../functions.php');
	if(!loggedin())
		header("Location: login.php");
	else if($_SESSION['username'] !== 'admin')
		header("Location: login.php");
	else
		include('header.php');
		$link = connectdb();
?>
              <li><a href="index.php">Admin Panel</a></li>
              <li><a href="users.php">Users</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-coll	apse -->
        </div>
      </div>
    </div>

    <div class="container">
    mode: 	<select name="mode">
								<options value="production">Production</options>
								<options value="development">Development</options>
								<options value="testing">Testing</options>
						</select>
	<br/>
	
	<?php
	if ( isset( $_GET['uname'] ) ){

	// get the name, email and status
      $query = "SELECT email, status FROM users WHERE username='".$_GET['uname']."'";
      $result = mysqli_query($link,$query);
      $row = mysqli_fetch_array($result,MYSQLI_BOTH);


  ?>
	<h1><small>Profile details for <?php echo($_GET['uname']); if($row['status'] == 0) echo(" <span class=\"label label-important\">Banned</span>");?></small></h1>
    <br />
	<h5> USERNAME :  <?php echo $_GET['uname'];?><br /><br />
    Email: <?php echo($row['email']);?>
    <br/>
	<br/>POINTS ACHIEVED  :  <?php   // POINT BADGE5
				$sql = "SELECT * FROM solve WHERE (status='2' AND username='".$_GET['uname']."')";
				$res = mysqli_query($link,$sql);
				$total=0;
				while($each = mysqli_fetch_array($res,MYSQLI_NUM))
						$total=$each['points'];
				echo "<span class= 'badge badge-success' > $total </span>";
				?>
	</h5>
	<br/>
	Details of problems attempted:
    <hr />
    <table class="table table-striped">
      <thead><tr>
        <th>Problem</th>
        <th>Attempts</th>
        <th>Status</th>
      </tr></thead>
      <tbody>
      <?php
        // list all the problems attempted or solved
        $query = "SELECT problem_id, status, attempts FROM solve WHERE username='".$_GET['uname']."'";
        $result = mysqli_query($link,$query);
       	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)){
       		$sql = "SELECT name FROM problems WHERE sl='".$row['problem_id']."'";
       		$res = mysqli_query($link,$sql);
       		if(mysqli_num_rows($res) != 0) {
       			$field = mysqli_fetch_array($res,MYSQLI_BOTH);
	       		echo("<tr><td><a href=\"#\" onclick=\"$('#area').load('preview.php', {action: 'code', uname: '".$_GET['uname']."', id: '".$row['problem_id']."', name: '".$field['name']."'});\">".$field['name']."</a></td><td><span class=\"badge badge-info\">".$row['attempts']);
       			if($row['status'] == 1)
       				echo("</span></td><td><span class=\"label label-warning\">Attempted</span></td></tr>\n");
       			else if($row['status'] == 2)
       				echo("</span></td><td><span class=\"label label-success\">Solved</span></td></tr>\n");
       		}
       	}
      ?>
      </tbody>
      </table>
      <div id="area"></div>
    </div> <!-- /container -->

	<?php
	}
	else echo "Undefined User<br />";
	include('footer.php');
?>
		