<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Scoreboard page
 */
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		$link=connectdb();
?>
              <li><a href="index.php">Problems</a></li>
              <li><a href="submissions.php">Submissions</a></li>
              <li class="active"><a href="#">Scoreboard</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    The current standings of all the participants, the number of problems they have attempted and solved.
    <table class="table table-striped">
      <thead><tr>
        <th>Name</th>
        <th>Points</th>
		<th>Solved</th>
        <th>Attempted</th>
		
      </tr></thead>
      <tbody><div id="live">
	        <?php
			
			$_q = "SELECT 	users.sl, 
							users.username,  
							(SELECT COUNT(solve.status) 
									FROM solve 
									WHERE solve.username = users.username 
                             				AND solve.status=2 ) AS solved, 
							(SELECT COUNT(solve.status) 
									FROM solve 
									WHERE solve.username = users.username ) AS attempts, 
									(SELECT SUM(points) 
											FROM solve 
											WHERE status=2 AND username=users.username) AS points 
						FROM users 
						WHERE users.status=1 and users.username!='admin'
						ORDER BY points DESC, attempts ASC 
						LIMIT 0, 35 ";
			
			$_result = mysqli_query($link,$_q);
			while($row = mysqli_fetch_array($_result,MYSQLI_BOTH)){
					echo("<tr><td>".$row['username']."</td>");
					
					// POINT BADGE
					echo "<td><span class=\"badge badge-info\">[ $row[points] POINTS ]</span></td>";
					
					// SOLVED BADGE
					echo "<td><span class=\"badge badge-success\">".$row['solved']."</span></td>";
		
					// ATTEMPTED BADGE
					echo("<td><span class=\"badge badge-warning\">".$row['attempts']."</span></td>");
						
						
				$class="<span class= 'badge badge-success' >";
				echo "<td>.$class $total </span></td></tr>";
       	}
	
      ?>
	  
	  </div>
      </tbody>
      </table>
    </div> <!-- /container -->
<script>
window.setTimeout(function(){
function loadDoc() {
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     document.getElementById("live").innerHTML = this.responseText;
    }
  };
  xhttp.open("GET", "live.php", true);
  xhttp.send();
}
loadDoc
}, 8000);
</script>
<?php
	include('footer.php');
?>

		