<?php
use par0noid\ts3admin;

class Connection {
	public static function connect() {
		$ts = new ts3admin(getenv('SERVER_ADDRESS'), getenv('QUERY_PORT'));
		$ts->connect();
		$ts->login(getenv('QUERY_USERNAME'), getenv('QUERY_PASSWORD'));
		$ts->selectServer(getenv('SERVER_PORT'));
		$ts->setName(getenv('BOT_NAME'));
		return $ts;
	}
}

?>
