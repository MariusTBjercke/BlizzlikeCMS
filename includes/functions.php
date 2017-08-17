<?php

// Get server status
function getServerStatus()
{
	global $server;
	global $port;
	global $serveronline;

	$host = $server;
	$connection = @fsockopen($host, $port);

	if (is_resource($connection)) {
		echo '<span class="server-online">Online</span>';
		$serveronline = true;
	} else {
		echo '<span class="server-offline">Offline</span>';
        $serveronline = false;
	}
}

?>