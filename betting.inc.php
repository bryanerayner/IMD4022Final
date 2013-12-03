<?php
	/***************************************************************************
		Step 2:
		Modify this PHP page to return the value currently in the wallet as text.
		You will need to take the form out of this page and put it back on the main page.
		Use jquery to display the final total, rather than php, which is currently doing the job.
		In this way, the user doesn't have to refresh the page to display their total money, it just updates at the end of every race.
	***************************************************************************/
	include("db.inc.php");
	
	$query="SELECT money
			FROM wsfinal_wallet";
	
	$rs = mysqli_query($oConn, $query);
	
	if($rs){
		$row = mysqli_fetch_assoc($rs);
		$total = $row['money'];	
	}
	
	//check to see if we should make an update to the amount (based on when they hit 'new race')
	if(isset($_GET['winnings'])){
		$winnings = intval($_GET['winnings']);
		$total = $total + $winnings;
		
		//update the database
		$query="UPDATE wsfinal_wallet
				SET money=$total
				WHERE id=1";
		//run update query
		$rs = mysqli_query($oConn, $query);

		echo $total;
	}
?>


<?php
	mysqli_close($oConn);
?>