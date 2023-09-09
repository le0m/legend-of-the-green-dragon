<?php

function strangeoldman_getmoduleinfo(){
	$info = array(
		"name"=>"Vecchio nella foresta",
		"version"=>"1.0",
		"author"=>"Christian Rutsch, Christoph Meyer, Thomas Kramer",
		"category"=>"Forest Specials",
		"download"=>"core_module",
	);
	return $info;
}

function strangeoldman_install(){
	module_addeventhook("forest", "return 100;");
	return true;
}

function strangeoldman_uninstall(){
	return true;
}

function strangeoldman_dohook($hookname,$args){
	return $args;
}

function strangeoldman_runevent($type) {
	global $session;
	$op = httpget('op');

	if ($op == "") {
		switch(e_rand(1,3)){
			case 1:
				if ($session['user']['charm']>0){
					output("`^An old man hits you with an ugly stick, giggles and runs away!`n`nYou `%lose a`^ charm point!`0");
					$session['user']['charm']--;
				}else{
				  output("`^An old man hits you with an ugly stick and gasps as the stick `%loses a charm point`^.  You're even uglier than this ugly stick!`0");
				}
				break;
			case 2:
				output("`^An old man hits you with a nice stick, giggles and runs away!`n`nYou `%gain a`^ charm point!`0");
				$session['user']['charm']++;
				break;
			case 3:
				if ($op == "") {
				  output("`@You meet a strange old man!`n`n\"`#I'm lost.`@\", he says, \"`#Can you take me back to the village?`@\"`n`n");
					output("You know that if you bring this old man into the village you will lose a forest battle for today. Will you help him?");
					addnav("Take him to the village","forest.php?op=walk");
					addnav("Leave him alone","forest.php?op=return");
					$session['user']['specialinc'] = "module:strangeoldman";
				}
				break;
		}
	} else if ($op == "walk") {
		$session['user']['turns']--;
		if (e_rand(0,1) == 0) {
			output("`@You take the time to escort him back to the village.`n`nIn return, he hits you with his pretty stick and you get `%a charm point`@!");
			$session['user']['charm']++;
		} else {
			output("`@You take the time to escort him back to the village.`n`nAs a thank you, he gives you `%a gemstone`@!");
			$session['user']['gems']++;
			debuglog("got 1 gem for walking old man to village");
		}
		$session['user']['specialinc']="";
	} else if ($op == "return") {
		output("`@You explain to grandpa that you are too busy to help him.`n`nNo big deal, he should be able to find his way back to the ");
		output("village himself. After all, he made it here from the village, right? A wolf howls in the distance to your left and a few seconds ");
		output("later another wolf answers from much closer to your right. Yup, the man should be safe..");
		$session['user']['specialinc']="";
	}
}
?>
