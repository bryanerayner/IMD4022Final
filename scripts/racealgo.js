
//character names
//You can change the names here but you have to change them in other places too.
//Don't mess around with the species, as the code requires that to match up in other places
var chars = new Object();
chars["chicken"] = "Amelia";
chars["crab"] = "Hans";
chars["goat"] = "Philbert";
chars["beachball"] = "Lawrence";

//character modifiers
//this array grabs the numbers from the hidden spans inside of 'betting box', and uses them to apply as modifiers to each racer's speed check.
var mods = new Array();

//race toggle
//the race toggle can be "" (nothing, before the race has started), "running" (if the race is currently in progress), or "over" (after someone wins)
var race = "";


$(document).ready(function(){
	//reset race at the start of the page
	resetRace()
	
	//the place bet and start race button
	//this button only works if the race variable is set to "" (before the race starts)
	$("#btnBet").click(function(event){
		//prevent the button from submitting the form
		event.preventDefault();
		
		//make sure the race hasn't started
		if(race == ""){
			//set to race to running
			race="running";
			
			/***********************************************************************************************
				Step 1: add jquery here to hide the betting form after the race has started (but keep showing the total amount of money)
			***********************************************************************************************/
			
			
			
			//get each of the characters divs by class and use their ID to send to the movement function
			//this loop calls the characterMove function four times, one for each character
			var c = 0;
			$('.racer').each(function(){
				characterMove($(this).attr('id'), c);
				c++
			});
		}
	});
	
	//the new race button - if the race is currently happening, this button does nothing!
	$("#btnNewRace").click(function(event){
		/*******************************************************************************************
			Step 3: add an ajax call here!
			Make sure to stop the form from submitting, and don't allow the ajax call to run if the race variable is not set to 'running'
			
			You will also need to add jquery that shows the betting form again (if it is currently hidden)
			
			Your ajax call should call the status PHP.  This page will return either XML or JSON (your choice through your ajax call).
			
			The data will contain a status for each character (which you should display to the user),
			and a modifier for each character (which you should place in a span next to the displayed status).
			
			See status.inc.php for more instructions on how to deal with this.
		********************************************************************************************/
		if(race == "running"){
			event.preventDefault();	
		}
	});
	

});

//this function makes sure all characters are in the right place and all modifiers are loaded
function resetRace(){
	//this gets the mods from the hidden spans and puts them into the array, in order of racer
	$("#statusbox span").each(function(){
		mods.push(Number($(this).text()));
	});
	
	//this resets each image to have a position left of 0px
	$("#racetrack img").each(function(){
		$(this).css('left', 0);
	});
}


//this function randomizes each of the movements for each of the characters
function characterMove(char, c){
	//alert(parseInt(modifier));
	var pos = parseInt($('#' + char + ' img').css('left'))
	//only if the character is not over the finish line
	if(pos < 870){
		//decide which speed algorithm the animal will use (number between 6 and 12, +/- up to 1.2) - with speed, lower is faster!
		var speedCheck = (Math.floor(Math.random()*4)+3-mods[c]) + (Math.floor(Math.random()*4)+3-mods[c])
		//alert(char + " " + speedCheck);
		
		//call to do a speed check, send it the current position
		var ranInfo = getDis(speedCheck, pos);
		
		//move the object according to those numbers
		//animate the object according to random information
		//recalls this function on completion
		$('#' + char + ' img').animate(
			{ left: '+=' + ranInfo[1] },
			{
				duration: ranInfo[0],
				easing: 'linear',
				complete: function(){characterMove(char,c);}
			}
		);
	}else{
		if(race != "over"){
			//alert the winner
			alert(chars[char] + ", the " + char + " wins!");
			//get the amount bet
			var amount = $("#bet").val();
			//make it 0 if nothing was bet
			if(amount == ""){
				amount = 0;	
			}
			
			/**************************************************************************************************
				Step 2: When the race finishes, make an ajax call that updates the money the user currently has.
				
				Right now, this sets a hidden field on the 'new race' form.  You'll have to change it to make an ajax call to
				the betting PHP file, which takes one value (winnings, either a positive or negative number), and returns the new total as text,
				which you can then display in the paragraph with the id "total".
				
				In your ajax call, make sure the datatype property is set to text.
			**************************************************************************************************/
			
			//check if the character selected won or lost, and make either a positive or negative number the value of the hidden field
			if($("#racersel option:selected").val()==char){
				$("#winnings").val(amount);
			}else{
				$("#winnings").val("-" + amount);	
			}
			
			/**************************************************************************************************/
			//leave this alone! All your ajax stuff for step 2 should go above here.
			//set the race to over!
			race = "over";	
		}
	}
}



//decides how fast the character is going based on the speed check and the current location
function getDis(speedCheck, pos){
	//get a random duration and distance
	var randomDis=Math.floor(Math.random()*101) + 100 //100-200px
	
	//check to see how far we have to go (and make sure we only go to the end)
	if((pos + randomDis) > 870){
		randomDis = 870 - pos;
	}
	
	//get a random duration based on speedCheck: distance x speedcheck (200-2400 milliseconds) +/- 20 speedcheck (40 to 240 milliseconds)
	var randomDur=randomDis * (speedCheck) + (Math.floor(Math.random()*(speedCheck*40)) - (speedCheck*20)); //distance x3  +/- ~100
	
	//return time and distance
	return [randomDur,randomDis];
}