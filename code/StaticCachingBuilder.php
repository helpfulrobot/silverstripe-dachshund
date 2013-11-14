<?php

class StaticCachingBuilder extends Object {
	
	/**
	 *
	 * @var bool
	 */
	protected $queueChanged = false;
	
	public function notify(StaticCachingQueue $queue) {
		$this->queueChanged = true;
	}
	
	public function queueHasChanged() {
		return $this->queueChanged;
	}
}
