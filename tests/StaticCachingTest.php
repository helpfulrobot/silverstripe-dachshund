<?php

class StaticCachingTest extends SapphireTest {
	
	public function testStaticCacheExtendsObject() {
		$this->assertTrue(new StaticCaching() instanceof Object);
	}
	
	public function testDefaultGatherer() {
		$sc = Injector::inst()->get('StaticCaching');
		$this->assertEquals('StaticCacheURLGatherer', get_class($sc->getGatherer()));
	}
	
}