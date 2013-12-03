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

	$output = array("states"=>$states,
					"mods"=>$mods);

	header('Content-Type: application/json');
	echo json_encode($output);




	mysqli_close($oConn);
?>