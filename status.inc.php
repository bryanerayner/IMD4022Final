<?php
	/***************************************************************************
		Step 3:
		Modify this PHP to send back either XML or json values for each status of each of the four characters.
		You will need to take the text out of this page and put it back on the main page.
		Use jquery to display the character status, rather than php, which is currently doing the job.
		Also remember that the modifiers need to be put into the spans.  See the layout below.
	***************************************************************************/
	
	include("db.inc.php");
	
	//loop to get four characteristics
	$states = array();
	$mods = array();
	
	for($i=0;$i<4;$i++){
		//random number for random status
		$random = mt_rand(1,7);
		
		//build statement
		$query="SELECT status_name, status_modifier
				FROM wsfinal_status
				WHERE status_id = $random";
				
		$rs = mysqli_query($oConn, $query);
		
		if($rs){
			$row = mysqli_fetch_assoc($rs);
			$states[$i] = $row["status_name"];
			$mods[$i] = $row["status_modifier"];
		}
	}
?>
<!--PHP is currently inserting values into this HTML.  When you change things over to ajax, you need to take this and put it back on the main page.
Then, use jquery to insert the values, instead of PHP-->
<h2>How Everyone Feels:</h2>
<p>Amelia the chicken <?php echo $states[0]; ?></p><span id="ch_mod"><?php echo $mods[0]; ?></span>
<p>Hans the crab <?php echo $states[1]; ?></p><span id="cr_mod"><?php echo $mods[1]; ?></span>
<p>Philbert the goat <?php echo $states[2]; ?></p><span id="go_mod"><?php echo $mods[2]; ?></span>
<p>Lawrence the beachball <?php echo $states[3]; ?></p><span id="bb_mod"><?php echo $mods[3]; ?></span>

<?php
	mysqli_close($oConn);
?>