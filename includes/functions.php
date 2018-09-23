<?php

// Get server status
function getServerStatus() {
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

// Get if user is logged in
function isUserLoggedIn() {
    if ($_SESSION['user_logged_n'] == 'true') {
        return true;
    } else {
        return false;
    }
}

// Get logged in users username
function getLoggedInUsername() {
    if ($_SESSION['username']) {
        return ucfirst($_SESSION['username']);
    }
}

// Is Admin logged in?
function isAdminLoggedIn() {
    if ($_SESSION['admin_logged_n'] == true) {
        return true;
    } else {
        return false;
    }
}

?>