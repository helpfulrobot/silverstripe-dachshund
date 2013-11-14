<?php

class StaticCachingTest extends SapphireTest {
	
	public function testStaticCacheExtendsObject() {
		$this->assertTrue(StaticCaching::create() instanceof Object);
	}
	
	public function testDefaultGatherer() {
		$this->assertEquals('StaticCacheURLGatherer', get_class(StaticCaching::create()->getGatherer()));
	}
	
	public function testQueueGetURLsOnPublish() {
		$page = SiteTree::create(array('URLSegment' => 'test'));
		$page->write();
		$page->publish('Stage', 'Live');
		$sc = StaticCaching::create()->publish($page);
		$this->assertTrue($sc instanceof StaticCaching, 'StaticCaching::publish() should return an instance of it self');
		$this->assertEquals(array(CacheURL::create('/test/')), $sc->getQueue()->toArray());
	}
	
	public function testAddingToQueueShouldNotifyDefaultBuilder() {
		$page = SiteTree::create(array('URLSegment' => 'test'));
		$page->write();
		$page->publish('Stage', 'Live');
		$sc = StaticCaching::create()->publish($page);
		$this->assertTrue($sc->getBuilder()->queueHasChanged());
	}
}
