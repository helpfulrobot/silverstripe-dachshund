<?php

class StaticCacheURLGathererTest extends FunctionalTest {

	/**
	 *
	 * @var StaticCacheURLGatherer 
	 */
	protected $obj;
	
	public static $fixture_file = 'sitetree.yml';
	
	protected static $use_draft_site = true;
	
	function setUp() {
		parent::setUp();
		$this->obj = Injector::inst()->get('StaticCacheURLGatherer');
		Config::inst()->update('Director', 'alternate_base_url', '/');
	}
	
	function testInstance() {
		$this->assertTrue($this->obj instanceof Object);
	}
	
	function testGetURLFromSimplePage() {
		$page = $this->objFromFixture('SiteTree', 'newsroom');
		$this->assertEquals('/news/', $this->obj->getURL($page));
	}
	
	function testGetURLFromNestedPage() {
		$page = $this->objFromFixture('SiteTree', 'news1');
		$this->assertEquals('/news/first-news/', $this->obj->getURL($page));
	}
	
	function testDontGetURLFromUnpublished() {
		$this->useDraftSite(false);
		$page = $this->objFromFixture('SiteTree', 'newsroom');
		$this->assertEquals(false, $this->obj->getURL($page));
	}
	
	function testGetURLs() {
		$page = $this->objFromFixture('SiteTree', 'news1');
		$expected = array(
			'/news/first-news/',
			'/news/'
		);
		$this->assertEquals($expected, $this->obj->getURLs($page));
	}
	
	function testGetURLsUnpublished() {
		$this->useDraftSite(false);
		$page = $this->objFromFixture('SiteTree', 'news1');
		$this->assertEquals(array(), $this->obj->getURLs($page));
	}
}
