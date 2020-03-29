<?php

include('connection.php');
$ts = Connection::connect();
$afk = array();
$excludeChannels = explode(',', getenv('EXCLUDE_CHANNELS'));
$afkChannel = getenv('AFK_CHANNEL');
$idleTime = 1000*60*getenv('IDLE_MINUTES');

while(1){
	if ($ts->clientList("-times -away")["success"] == false) {
		error_log('trying to reconnect after 5 seconds ...');
		sleep(5);
		$ts = Connection::connect();
		continue;
	}
	foreach($ts->clientList("-times -away")["data"] as $c){
		if (!in_array($c["cid"], $excludeChannels) && ($c["client_away"] == 1 || ($c["client_idle_time"] > $idleTime))) {
			$afk[$c["clid"]] = $c["cid"];
			$ts->clientMove($c["clid"], $afkChannel);
		}
		if ($c["cid"] == $afkChannel && $c["client_idle_time"] < $idleTime && $c["client_away"] == 0) {
			$ts->clientMove($c["clid"], isset($afk[$c["clid"]]) ? $afk[$c["clid"]] : 1);
		}
	}
	sleep(1);
}

?>
