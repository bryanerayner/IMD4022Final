<?php
/*
	Your tasks:
	
	1. Using jQuery or CSS3, develop a fancy landing page for this site.  This landing page should hide the race itself, but show the 'status' of each character, and allow the player to bet.  When the player hits 'start race', the race should show, and then start (use a callback function on whatever jQuery function you use to show the race).
	
	2. When the race ends, make an ajax call that updates the money amount on the database, rather than transfering to the hidden field and waiting for the 'new race' button to be selected.  Make the ajax call in the racealgo.js file (I've marked the place).  This should call betting.update.php, which replaces the php in betting.inc.php.  See betting.inc.php for how to deal with that.
	
	3. Change the 'new race' button to make an ajax call that refreshes the race without refreshing the page (and make sure the form doesn't submit).  You'll have to show the betting options and make sure the characters go back to the start (call the prewritten reset function).  This ajax call should also be made when the page first loads (so the race is ready to go).
	
	4. Style the whole thing to look nice!
	
	5. Anything you feel like doing to make this cooler - just don't mess around with the HTML very much, or anything else I've specifically said shouldn't be messed with, because a lot of the javascript/JQuery depends on it.
	
	Use the GET method for your ajax calls.  When you have data returned from the server, you may format it as XML or JSON, or any other format you feel like working with (including plain text).  See the JQuery documentation on $.ajax for more information on the different data formats.
*/

    include("db.inc.php");


?>

<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>What's in My Egg?</title>
<script src="scripts/jquery-1.10.2.min.js"></script>
<script src="scripts/racealgo.js"></script>
<link href="styles/racing.css" rel="stylesheet" />
</head>

<body>
<div id="wrapper">
	<div id="header">
    	<h1>What's In My Egg? Racing</h1>
    </div>
    
    <div id="racetrack">

        <div class = "feelings">
            <h2>How Everyone Feels:</h2>
        </div>

    	<div class="racer" id="chicken">
            <div class = "feelings"><p>Amelia the chicken <span id="ch_state"></span></p><span id="ch_mod" class = "mod"></span>
            </div>
        	<img src="images/chicken.png" />
        </div>
        
        <div class="racer" id="crab">
            <div class = "feelings"><p>Hans the crab <span id="cr_state"></span></p><span id="cr_mod" class = "mod"></span></div>
        	<img src="images/crab.png" />
        </div>
        
        <div class="racer" id="goat">
            <div class = "feelings"><p>Philbert the goat <span id="go_state"></span></p><span id="go_mod" class = "mod"></span></div>
        	<img src="images/goat-icon.png" />
        </div>
        
        <div class="racer" id="beachball">
            <div class = "feelings"><p>Lawrence the beachball <span id="bb_state"></span></p><span id="bb_mod" class = "mod"></span></div>
        	<img src="images/beachball.png" />
        </div>
    </div>
    
    <div id="statusbox">
    	<form name="newrace" id="newrace" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="get">
        	<input type="submit" value="New Race!" id="btnNewRace" name="btnNewRace" />
            <input type="hidden" value="0" name="winnings" id="winnings" />
        </form>

        
        <!--PHP is currently inserting values into this HTML.  When you change things over to ajax, you need to take this and put it back on the main page.
        Then, use jquery to insert the values, instead of PHP-->
        
        
        
        
        

    </div>
    
    <div id="bettingbox">
    	
        <!-- rather than the include, move the HTML betting form back here, and use jquery to update the amount from the waller -->
    	
        <form name="betting" id="betting" action="betting.inc.php" method="get">
            <input type="submit" name="btnBet" id="btnBet" value="Bet and Start Race!" /><br />
            <h2>Bet on this race!</h2>

            <?php 
                $query="SELECT money
                        FROM wsfinal_wallet";
                
                $rs = mysqli_query($oConn, $query);
                
                if($rs){
                    $row = mysqli_fetch_assoc($rs);
                    $total = $row['money']; 
                }

            ?>

            <p id="total">Your current total: $<span id="totalMoney"><?php echo $total; ?></span></p>
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


    </div>
</div>
</body>
</html>
