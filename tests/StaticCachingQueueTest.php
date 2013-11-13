<?php

class StaticCachingQueueTest extends SapphireTest {
	
	function testInstance() {
		$this->assertTrue(new StaticCachingQueue() instanceof Object);
	}
}

