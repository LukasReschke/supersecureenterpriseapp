<?php

\OCP\App::addNavigationEntry(array(
	'id' => 'supersecureenterpriseapp',
	'order' => 10,
	'href' => \OCP\Util::linkToRoute('supersecureenterpriseapp_index'),
	'name' => 'SSEA',
));