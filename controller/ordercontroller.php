<?php

namespace OCA\SuperSecureEnterpriseApp\Controller;

use OCA\supersecureenterpriseapp\Product;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\DataResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IDBConnection;
use OCP\IRequest;

/**
 * Class OrderController
 *
 * @package OCA\SuperSecureEnterpriseApp\Controller
 */
class OrderController extends Controller {
	private $db;
	private $userId;

	/**
	 * @param string $appName
	 * @param string $UserId
	 * @param IRequest $request
	 * @param IDBConnection $dbConnection
	 */
	public function __construct($appName,
								$UserId,
								IRequest $request,
								IDBConnection $dbConnection) {
		parent::__construct($appName, $request);
		$this->db = $dbConnection;
		$this->userId = $UserId;
	}

	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 */
	public function showProducts() {
		if($_COOKIE['authenticated'] !== 'yes') {
			header("Location: ".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp_index'));
			exit();
		}

		$products = [
			'200 gramm sand' => new Product(1, 'sand', 50),
			'200 gram white coke' => new Product(2, 'coke', 50),
			'200 gram icewind1991©' => new Product(3, 'icewind', 50),
		];

		return new TemplateResponse($this->appName, 'products', ['products' => $products]);
	}


	/**
	 * @NoCSRFRequired
	 * @NoAdminRequired
	 *
	 * @param string $command
	 */
	public function addOrder($command) {
		if($_COOKIE['authenticated'] !== 'yes') {
			header("Location: ".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp_index'));
			exit();
		}

		$order = unserialize($command);
		echo (sprintf('Thanks you ordered %s for %d.', $order->name, $order->price));
		exit();
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @param string $productId
	 * @return DataResponse
	 */
	public function getProductDescription($productId) {
		if($_COOKIE['authenticated'] !== 'yes') {
			header("Location: ".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp_index'));
			exit();
		}
		$description = include(__DIR__ .'/../products/'.$productId.'.php');

		return new DataResponse($description);
	}

	/**
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 * @PublicPage
	 *
	 * @param string $name
	 */
	public function setFavourite($name) {
		if($_COOKIE['authenticated'] !== 'yes') {
			header("Location: ".\OC::$server->getURLGenerator()->linkToRoute('supersecureenterpriseapp_index'));
			exit();
		}
		$this->db->executeQuery('DELETE FROM *PREFIX*favourite_product where `userid` = "'.\OC_User::getUser().'"');
		$this->db->executeQuery('INSERT INTO *PREFIX*favourite_product(`productname`, `userid`) VALUES("'.$name.'", "'.$this->userId.'");');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		exit();
	}

}
