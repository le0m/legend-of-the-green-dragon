<?php

function strangeoldman_getmoduleinfo(){
	$info = array(
		"name"=>"Alter Mann im Wald",
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
					output("`^Ein alter Mann schl�gt dich mit einem h�sslichen Stock, kichert und rennt davon!`n`nDu `%verlierst einen`^ Charmepunkt!`0");
					$session['user']['charm']--;
				}else{
				  output("`^Ein alter Mann trifft dich mit einem h�sslichen Stock und schnappt nach Luft, als der Stock `%einen Charmepunkt verliert`^.  Du bist noch h�sslicher als dieser h�ssliche Stock!`0");
				}
				break;
			case 2:
				output("`^Ein alter Mann schl�gt dich mit einem sch�nen Stock, kichert und rennt davon!`n`nDu `%bekommst einen`^ Charmepunkt!`0");
				$session['user']['charm']++;
				break;
			case 3:
				if ($op == "") {
				  output("`@Du begegnest einem merkw�rdigen alten Mann!`n`n\"`#Ich hab mich verlaufen.`@\", sagt er, \"`#Kannst du mich ins Dorf zur�ckbringen?`@\"`n`n");
					output("Du wei�t, da� du einen Waldkampf f�r heute verlieren wirst, wenn du diesen alten Mann ins Dorf bringst. Wirst du ihm helfen?");
					addnav("F�hre ihn ins Dorf","forest.php?op=walk");
					addnav("Lass ihn stehen","forest.php?op=return");
					$session['user']['specialinc'] = "module:strangeoldman";
				}
				break;
		}
	} else if ($op == "walk") {
		$session['user']['turns']--;
		if (e_rand(0,1) == 0) {
			output("`@Du nimmst dir die Zeit, ihn zur�ck ins Dorf zu geleiten.`n`nAls Gegenleistung schl�gt er dich mit seinem h�bschen Stock und du erh�ltst `%einen Charmepunkt`@!");
			$session['user']['charm']++;
		} else {
			output("`@Du nimmst dir die Zeit, ihn zur�ck ins Dorf zu geleiten.`n`nAls Dankesch�n gibt er dir `%einen Edelstein`@!");
			$session['user']['gems']++;
			debuglog("got 1 gem for walking old man to village");
		}
		$session['user']['specialinc']="";
	} else if ($op == "return") {
		output("`@Du erkl�rst dem Opa, da� du viel zu besch�ftigt bist, um ihm zu helfen.`n`nKeine gro�e Sache, er sollte in der Lage sein, den Weg zur�ck ");
		output("ins Dorf selbst zu finden. Immerhin hat er es ja auch vom Dorf hierher geschafft, oder? Ein Wolf heult links von dir in der Ferne und wenige Sekunden sp�ter ");
		output("antwortet ein anderer Wolf viel n�her von rechts. Jup, der Mann sollte in Sicherheit sein.");
		$session['user']['specialinc']="";
	}
}
?>