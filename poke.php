<?php

include('connection.php');

$ts = Connection::connect();

if(!isset($argv[1]))
	exit("ERROR: msg unset\n");
foreach($ts->clientList()['data'] as $c){
	$ts->clientPoke($c['clid'], $argv[1]);
}

?>
