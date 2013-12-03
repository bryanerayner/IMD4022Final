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
	}
?>

<!-- this form shouldn't actually ever go anywhere, as jquery is currently stopping it (and you should keep it that way).
Move this form back to the main page and use jquery to update the total. -->
<form name="betting" id="betting" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
    <input type="submit" name="btnBet" id="btnBet" value="Bet and Start Race!" /><br />
    <h2>Bet on this race!</h2>
    <p id="total">Your current total: $<?php echo $total; ?></p>
    <p><label for="bet">Bet: $</label>
    <input type="text" name="bet" id="bet" maxlength="3" value="10" /></p>
    <p><label for="racername">Racer:</label>
    <select name="racersel" id="racersel">
        <option value="chicken">Amelia, the Chicken</option>
        <option value="crab">Hans, the Crab</option>
        <option value="goat">Philbert, the Goat</option>
        <option value="beachball">Lawrence, the Beachball</option>
    </select></p>
</form>


<?php
	mysqli_close($oConn);
?>