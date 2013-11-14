<?php

class StaticCachingBuilderTest extends SapphireTest {

	function testInstance() {
		$this->assertTrue(new StaticCachingBuilder() instanceof Object);
	}
	
	function testNotify() {
		$cb = StaticCachingBuilder::create();
		$cb->notify(StaticCachingQueue::create());
		$this->assertTrue($cb->queueHasChanged());
	}
	
}