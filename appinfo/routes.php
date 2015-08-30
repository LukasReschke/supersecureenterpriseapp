<?php

// Initialize legacy routing
$this->create('supersecureenterpriseapp_index', '/')
	->actionInclude('supersecureenterpriseapp/index.php');

// After years of refactoring we also finally got to use the AppFramework
$app = new \OCA\SuperSecureEnterpriseApp\AppInfo\Application('supersecureenterpriseapp');
$app->registerRoutes($this,
	[
		'routes' => [
			['name' => 'order#addOrder', 'url' => '/add', 'verb' => 'GET'],
			['name' => 'order#showProducts', 'url' => '/show', 'verb' => 'GET'],
			['name' => 'order#getProductDescription', 'url' => '/description', 'verb' => 'GET'],
			['name' => 'order#setFavourite', 'url' => '/favourite', 'verb' => 'GET']
		],
	]
);