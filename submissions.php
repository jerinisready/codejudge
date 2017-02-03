<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Submissions List page
 */
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		$link=connectdb();
?>
              <li><a href="index.php">Problems</a></li>
              <li class="active"><a href="#">Submissions</a></li>
              <li><a href="scoreboard.php">Scoreboard</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    Below is a list of submissions you have made. Click on any to edit it.
    <table class="table table-striped">
      <thead><tr>
        <th>Problem</th>
        <th>Attempts</th>
        <th>Status</th>
		<th>Points</th>
		<th>Language</th>
      </tr></thead>
      <tbody>
      <?php
        // list all the submissions made by the user
        $query = "SELECT problem_id, status, attempts, points, lang FROM solve WHERE username='".$_SESSION['username']."'";
        $result = mysqli_query($link,$query);
       	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
       		$sql = "SELECT name FROM problems WHERE sl=".$row['problem_id'];
       		$res = mysqli_query($link,$sql);
       		if(mysqli_num_rows($res) != 0) {
       			$field = mysqli_fetch_array($res,MYSQLI_BOTH);
	       		echo("<tr><td><a href=\"solve.php?id=".$row['problem_id']."\">".$field['name']."</a></td><td><span class=\"badge badge-info\">".$row['attempts']);
       			if($row['status'] == 1)
       				echo("</span></td><td><span class=\"label label-warning\">Attempted</span></td>\n");
       			else if($row['status'] == 2)
       				echo("</span></td><td><span class=\"label label-success\">Solved</span></td>\n");
				$class="<span class=\"badge badge-success\" >";
				echo "<td>".$class.$row['points']."</span></td>";
				echo "<td>"."<span class=\"badge badge-danger\"  >".$row['lang']."</td></tr>";
			}
       	}
      ?>
	  
      </tbody>
	  
      </table>
	  <div style="float:right">
		<h4> Currently Earned  : <span class= 'badge badge-success' style='font-size:16px'> <?php echo  points();?> POINTS </span></h4>
			    </div></div> <!-- /container -->

<?php
	include('footer.php');
?>
