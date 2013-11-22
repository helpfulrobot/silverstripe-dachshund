<?php

class StaticCachingBuilder extends Object {
	
	/**
	 *
	 * @var bool
	 */
	protected $queueChanged = false;
	
	/**
	 *
	 * @var CacheStorage 
	 */
	protected $storage = null;
	
	public function __construct(CacheStorage $storage = null) {
		$this->storage = $storage;
		parent::__construct();
	}
	/**
	 * 
	 * @param StaticCachingQueue $queue
	 */
	public function notify(StaticCachingQueue $queue) {
		$this->queueChanged = true;
	}
	
	/**
	 * 
	 * @return bool
	 */
	public function queueHasChanged() {
		return $this->queueChanged;
	}
	
	/**
	 * 
	 * @param string $url
	 */
	public function build($url) {
		if(!$this->storage instanceof CacheStorage) {
			throw new LogicException('Can\'t build url because of missing CacheStorage');
		}
	}
	
	/**
	 * 
	 * @param CacheStorage $storage
	 * @return \StaticCachingBuilder
	 */
	public function setCacheStorage(CacheStorage $storage) {
		$this->storage = $storage;
		return $this;
	}
	
	/**
	 * 
	 * @return CacheStorage
	 */
	public function getCacheStorage() {
		return $this->storage;
	}
}
