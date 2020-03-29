<?php
require __DIR__ . '/vendor/autoload.php';

class Connection {
	public static function connect() {
		$connection = @fsockopen('udp://' . getenv('SERVER_ADDRESS'), getenv('QUERY_PORT'));
    if (! is_resource($connection)) {
        error_log('Server is not responding\n');
				exit(1);
    }
		fclose($connection);
		$ts = new ts3admin(getenv('SERVER_ADDRESS'), getenv('QUERY_PORT'));
		$ts->connect();
		$ts->login(getenv('QUERY_USERNAME'), getenv('QUERY_PASSWORD'));
		$ts->selectServer(getenv('SERVER_PORT'));
		$ts->setName(getenv('BOT_NAME'));
		return $ts;
	}
}

?>
