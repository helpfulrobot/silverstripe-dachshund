<?php

class StaticCachingQueue extends ArrayList {

	/**
	 *
	 * @var array
	 */
	protected $observers = array();

	/**
	 * 
	 * @param Object $object
	 * @return type
	 */
	public function registerObserver(Object $object) {
		foreach($this->observers as $key => $observer) {
			if($object == $observer) {
				return;
			}
		}
		$this->observers[] = $object;
	}
	
	/**
	 * 
	 * @param Object $object
	 */
	public function unregisterObserver(Object $object) {
		foreach($this->observers as $key => $observer) {
			if($object == $observer) {
				unset($this->observers[$key]);
			}
		}
	}
	
	/**
	 * 
	 */
	public function notifyObservers() {
		foreach($this->observers as $observer) {
			$observer->notify($this);
		}
	}
	
	public function push($item) {
		parent::push($item);
		$this->notifyObservers();
	}
}
