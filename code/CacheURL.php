<?php

class CacheURL extends Object {
	
	/**
	 *
	 * @var string
	 */
	public $url = null;

	/**
	 *
	 * @var string
	 */
	public $type = null;
	
	/**
	 * 
	 * @param string $url
	 * @param string $type
	 */
	public function __construct($url=null, $type=null) {
		$this->url = $url;
		$this->type = $type;
	}

}