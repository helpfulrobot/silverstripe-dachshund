<?php

class StaticCachingQueueTest extends SapphireTest
{
    
    public function testInstance()
    {
        $this->assertTrue(new StaticCachingQueue() instanceof ArrayList);
    }
}
