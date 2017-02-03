<?php
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * Scoreboard page
 */
      <?php
        $query = "SELECT username, status FROM users WHERE username!='admin'";
        $result = mysqli_query($link,$query);
       	while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
       		// displays the user, problems solved and attempted
       		$sql = "SELECT * FROM solve WHERE (status='2' AND username='".$row['username']."') ORDER BY points DESC";
       		$res = mysqli_query($link,$sql);
       		echo("<tr><td>".$row['username']." ");

			if($row['status'] > 0){
					       		echo("<tr><td>".$row['username']." ");

						// SOLVED BADGE
						echo("</td><td><span class=\"badge badge-success\">".mysqli_num_rows($res));
						// ATTEMPTED BADGE
						$sql = "SELECT * FROM solve WHERE (status='1' AND username!='admin')";
						$res2 = mysqli_query($link,$sql);
						echo("</span></td><td><span class=\"badge badge-warning\">".mysqli_num_rows($res2)."</span></td>");
						// POINT BADGE
						$total=0;
						$sql = "SELECT points FROM solve WHERE (status='2')";
						$res = mysqli_query($link,$sql);
						if(mysqli_num_rows($res)>0){
							while( $row_arr = mysqli_fetch_array($res,MYSQLI_BOTH) )
								$total=$total+(int)$row_arr['points'];
						}
				$class="<span class= 'badge badge-success' >";
				echo "<td>.$class $total </span></td></tr>";
      	}
		}
      ?>
		