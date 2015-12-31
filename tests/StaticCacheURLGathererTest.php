<?php

class StaticCacheURLGathererTest extends FunctionalTest
{

    /**
     *
     * @var StaticCacheURLGatherer 
     */
    protected $obj;
    
    public static $fixture_file = 'sitetree.yml';
    
    protected static $use_draft_site = true;
    
    public function setUp()
    {
        parent::setUp();
        $this->obj = Injector::inst()->get('StaticCacheURLGatherer');
        Config::inst()->update('Director', 'alternate_base_url', '/');
    }
    
    public function testInstance()
    {
        $this->assertTrue($this->obj instanceof Object);
    }
    
    public function testGetURLFromSimplePage()
    {
        $page = $this->objFromFixture('SiteTree', 'newsroom');
        $this->assertEquals(CacheURL::create('/news/'), $this->obj->getURL($page));
    }
    
    public function testGetURLFromNestedPage()
    {
        $page = $this->objFromFixture('SiteTree', 'news1');
        $this->assertEquals(CacheURL::create('/news/first-news/'), $this->obj->getURL($page));
    }
    
    public function testDontGetURLFromUnpublished()
    {
        $this->useDraftSite(false);
        $page = $this->objFromFixture('SiteTree', 'newsroom');
        $this->assertEquals(false, $this->obj->getURL($page));
    }
    
    public function testGetURLs()
    {
        $page = $this->objFromFixture('SiteTree', 'news1');
        $first = new CacheURL('/news/first-news/');
        $sd = CacheURL::create('/news/');
        
        $expected = new ArrayList(array($first, $sd));
        $actual = $this->obj->getURLs($page);
        $this->assertTrue($actual instanceof ArrayList);
        $this->assertEquals(2, $actual->count());
        $this->assertEquals($expected, $actual);
    }
    
    public function testGetURLsUnpublished()
    {
        $this->useDraftSite(false);
        $page = $this->objFromFixture('SiteTree', 'news1');
        $this->assertEquals(new ArrayList(), $this->obj->getURLs($page));
    }
}
