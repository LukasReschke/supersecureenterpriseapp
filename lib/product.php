<?php

namespace OCA\supersecureenterpriseapp;

class Product {
	public $id;
	public $name;
	public $price;

	/**
	 * @param string $id
	 * @param string $name
	 * @param string $price
	 */
	public function __construct($id,
								$name,
								$price) {
		$this->id = $id;
		$this->name = $name;
		$this->price = $price;
	}
}
