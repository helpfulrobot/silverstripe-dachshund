<?php

class StaticCaching extends Object {
	
	/**
	 *
	 * @var StaticCacheURLGatherer 
	 */
	public $urlGatherer;
	
	/**
	 *
	 * @var StaticCachingQueue 
	 */
	public $queue;
	
	/**
	 *
	 * @var StaticCachingBuilder 
	 */
	public $builder;
	
	public static $dependencies = array(
        'urlGatherer' => '%$StaticCacheURLGatherer',
        'queue' => '%$StaticCachingQueue',
        'builder'=> '%$StaticCachingBuilder',
    );
	
	/**
	 * 
	 * @return StaticCacheURLGatherer
	 */
	public function getGatherer() {
		return $this->urlGatherer;
	}
}
