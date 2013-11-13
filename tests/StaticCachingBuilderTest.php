<?php

class StaticCachingBuilderTest extends SapphireTest {

	function testInstance() {
		$this->assertTrue(new StaticCachingBuilder() instanceof Object);
	}
	
}