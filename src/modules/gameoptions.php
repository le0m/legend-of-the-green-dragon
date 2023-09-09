<?php
function gameoptions_getmoduleinfo(){
	$info = array(
		"name" => "Helping Options for Core Edits",
		"version" => "1.0",
		"author"=>"`2R`@o`ghe`2n `Qvon `2Fa`@lk`genbr`@uch`&",
		"category" => "General",
		"prefs"=>array(
			"Colors and chat options,title",
			"user_layout"=>"Layout,enum,0,By Sender,1, By date of receipt,2,By time",
            "user_showcolors"=>"User sees color selection,enum,0,As a drop-down menu,1,As a color list,2,Not at all",
			"RPG,title",
			"lastwritingchar"=>"Last used account,int",
			"autorepair_ctitle"=>"Automatic title repair,string",
			"autorepair_name"=>"Automatic name repair,string",
			"Chat storage,title",
			"lastpostvalues"=>"Most recently cached values"
		),

	);
	return $info;
}

function gameoptions_install(){
	module_addhook("modifypreviewfield");
	return true;
}

function gameoptions_uninstall(){
	return true;
}

function gameoptions_dohook($hookname, $args){
	global $session;
	switch ($hookname){
	 case 'modifypreviewfield':
		$values=unserialize(get_module_pref("lastpostvalues"));
		if (is_array($values)) {
			if (isset($values[$args['fieldname']])) {
				$args['defaultvalue']=$values[$args['fieldname']];
				set_module_pref("lastpostvalues","");
			}
		}

	// 	set_module_pref("lastwritingchar",$session['user']['acctid']);
	// 	$ctitle = get_module_pref("autorepair_ctitle");
	// 	$name   = get_module_pref("autorepair_name");

		break;
	}
	return $args;
}

function gameoptions_run() {
}
