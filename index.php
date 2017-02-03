<?php
require('env.php');
/*
 * Codejudge
 * Copyright 2012, Sankha Narayan Guria (sankha93@gmail.com)
 * Licensed under MIT License.
 *
 * The main page that lists all the problem
 */
  if(!file_exists("dbinfo.php")){ header("Location: install.php");}
	require_once('functions.php');
	if(!loggedin())
		header("Location: login.php");
	else
		include('header.php');
		$link=connectdb();
?>
              <li class="active"><a href="#">Problems</a></li>
              <li><a href="submissions.php">Submissions</a></li>
              <li><a href="scoreboard.php">Scoreboard</a></li>
              <li><a href="account.php">Account</a></li>
              <li><a href="logout.php">Logout</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    <?php
        if(isset($_GET['success']))
          echo("<div class=\"alert alert-success\">\nCongratulations! You have solved the problem successfully.\n</div>");
    ?>
	
<h2>Hello <?php echo $_SESSION['username'];?></h2>
<br />
<br />
		<h4> Currently Earned  : <span class= 'badge badge-success' style='font-size:16px'> <?php echo  points();?>POINTS </span></h4>";
		<br />
		<br />
					
    Below is a list of available problems for you to solve.<br/><br/>
      <ul class="nav nav-list">
        <li class="nav-header">AVAILABLE PROBLEMS</li>
        <?php
        	// list all the problems from the database
			// append status and points along with it.
			// print it as row of table
			
		//------------------------------------------------------------------------------
        $query = "SELECT * FROM problems";
        $result = mysqli_query($link,$query);
        if(mysqli_num_rows($result)==0) 	echo("<li>Dhanus! Comming Soon</li>\n"); // no problems are there
		else {
			echo "<table style='padding-left:5em'>";
			//---------------------------------------------------------------------------
			while($row = mysqli_fetch_array($result,MYSQLI_BOTH)) {
				$sql = "SELECT status FROM solve WHERE (username='".$_SESSION['username']."' AND problem_id='".$row['sl']."')";
				$res = mysqli_query($link,$sql);
				$tag = "";
				// prepare the attempted or solved tags and badge-------------------------
				if(mysqli_num_rows($res) !== 0) {
					$r = mysqli_fetch_array($res,MYSQLI_BOTH);
					if($r['status'] == 1)
						$tag = " <span class=\"label label-warning\">Attempted</span>";
					else if($r['status'] == 2)
						$tag = " <span class=\"label label-success\">Solved</span>";
				}
				$pts = "<span class=\"badge badge-info\">[ $row[points] POINTS ]</span>";
				//-------------------------------------------------------------------------
				
				if(isset($_GET['id']) and $_GET['id']==$row['sl']) {
					$selected = $row;
					?> 
					<tr>
						<li class="active">
							<td style='right:10px'>
								<?php echo $tag;?>
							</td>
							<td style='right:10px'>
								<a href="#">
									<?php echo $row['name'];?>
								</a>
							</td>
							<td style='right:10px'>
								<span style='right:5px'>
									<?php echo $pts;?>
								</span> 
							</td>
						</li>
					</tr>
				<?php
				}
				else  {?>
					<tr >
						<li>
							<td style='right:10px'>
								<?php echo $tag;?>
							</td>
							<td style='right:10px'>
								<a href="index.php?id=<?php echo $row['sl'];?>">
									<?php echo $row['name'];?>
								</a>
							</td>
							<td style='right:10px'>
								<span style='right:5px'>
									<?php echo $pts;?>
								</span> 
							</td>
						</li>
					</tr>
				<?php }
			}
			//-----------------------------------------------------------------------------
			echo "</table>";
		}
		//---------------------------------------------------------------------------------
	?>
      </ul>
      <?php
        // if any problem is selected then list its details parsed by Markdown
      	if(isset($_GET['id'])) {
      		include('markdown.php');
		$out = Markdown($selected['text']);
		echo("<hr/>\n<h1>".$selected['name']."</h1>\n");
		echo($out);
      ?>
      <br/>
      <form action="solve.php" method="get">
      <input type="hidden" name="id" value="<?php echo($selected['sl']);?>"/>
      <?php
        // number of people who have solved the problem
        $query = "SELECT * FROM solve WHERE(status=2 AND problem_id='".$selected['sl']."')";
        $result = mysqli_query($link,$query);
        $num = mysqli_num_rows($result);
      ?>
      <input class="btn btn-primary btn-large" type="submit" value="Solve"/> <span class="badge badge-info"><?php echo($num);?></span> have solved the problem.
      </form>
      <?php
	}
      ?>
    </div> <!-- /container -->

<?php
	include('footer.php');
?>
