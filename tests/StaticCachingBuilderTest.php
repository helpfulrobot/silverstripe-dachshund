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

    function testSetGetCacheStorage() {
        $cb = StaticCachingBuilder::create();
        $storage = new TestStorage();
        $cb->setCacheStorage($storage);
        $this->assertEquals($storage, $cb->getCacheStorage());
    }

    function testStorageViaConstructor() {
        $storage = new TestStorage();
        $cb = StaticCachingBuilder::create($storage);
        $this->assertEquals($storage, $cb->getCacheStorage());
    }

    /**
     */
    function testBuildWithoutStorageThrowsException() {
        $this->setExpectedException('LogicException');
        $cb = StaticCachingBuilder::create();
        $cb->build('url');
    }

    function testBuild() {
        $this->markTestIncomplete();
        $storage = new TestStorage;
        $cb = StaticCachingBuilder::create($storage);
        $cb->build('url');
        $this->assertEquals('<htrml><body></body></html>', $storage->get('url'));
    }
}

class TestStorage extends CacheStorage implements TestOnly {

    public function get($url) {
        
    }

}
