<?php

class CacheStorageTest extends SapphireTest
{
    
    public function testInstance()
    {
        $this->assertTrue(new CacheStorage instanceof CacheStorage);
    }
}
