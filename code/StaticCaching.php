<?php

class StaticCaching extends Object
{
    
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
    
    /**
     *
     * @var array
     */
    private static $dependencies = array(
        'urlGatherer' => '%$StaticCacheURLGatherer',
        'queue' => '%$StaticCachingQueue',
        'builder'=> '%$StaticCachingBuilder',
    );
    
    /**
     * 
     * @return StaticCacheURLGatherer
     */
    public function getGatherer()
    {
        return $this->urlGatherer;
    }
    
    /**
     * 
     * @return StaticCachingQueue
     */
    public function getQueue()
    {
        return $this->queue;
    }
    
    /**
     * 
     * @return StaticCachingBuilder
     */
    public function getBuilder()
    {
        return $this->builder;
    }
    
    /**
     * 
     * @param SiteTree $page
     * @return StaticCaching
     */
    public function publish(SiteTree $page)
    {
        $urls = $this->urlGatherer->getPublishURLs($page);
        $this->getQueue()->merge($urls);
        return $this;
    }
    
    /**
     * called from Injector after it has created this object
     */
    public function injected()
    {
        $this->getQueue()->registerObserver($this->getBuilder());
    }
}
