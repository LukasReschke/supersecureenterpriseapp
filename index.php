<?php

header('X-XSS-Protection: 0');
header('Content-Security-Policy: *');

$tmpl = new OCP\Template('supersecureenterpriseapp', 'show_login', 'user');

if($_COOKIE['authenticated'] === 'yes') {
	header("Location: ".\OC::$server->getURLGenerator()->linkToRouteAbsolute('supersecureenterpriseapp.order.showProducts'));
	exit();
}

$password = isset($_POST['password']) ? $_POST['password'] : '';

$tmpl->assign('authenticated', false);

if($password) {
	$tmpl->assign('password', $password);

	// Long random password that no attacker can guess, must be secure
	$roles = [
		'user' => 'bb88552b9b952b7c35e5de64f4842fb360f47afd',
		'admin' => '5996c24a35d88feb7512fc555ab0f26c238e1407',
	];

	foreach($roles as $userName => $userPassword) {
		if (strcmp($password, $userPassword) == 0) {
			setcookie('authenticated', 'yes', 0, \OC::$WEBROOT);
			header("Location: ".\OC::$server->getURLGenerator()->linkToRouteAbsolute('supersecureenterpriseapp.order.showProducts'));
			exit();
		}
	}

	// DEBUG: Clean up
	echo($roles['user']);
}

$tmpl->printPage();
