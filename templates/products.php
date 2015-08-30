<br/>

<?php

/** @var array $_*/
foreach($_['products'] as $product) {
	echo "<a href=\"".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp.order.addOrder')."?command=".urlencode(serialize($product))."\" class=\"button\">Buy ".$product->name."</a> (<a href=\"".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp.order.getProductDescription')."?productId=".$product->id."\">Get more info</a> / <a href=\"".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp.order.setFavourite')."?name=".urlencode($product->name)."\">Make favourite</a>)";
}

$query = \OC::$server->getDatabaseConnection()->prepare('SELECT * FROM *PREFIX*favourite_product where `userid` = "'.\OC_User::getUser().'"');
$result = $query->execute();
echo "<br>";
echo "<br>";
echo "Your favourite product: ".$query->fetch()['productname'];
?>