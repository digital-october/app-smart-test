<?php


namespace App\Source;


use Illuminate\Cache\RedisStore;
use Illuminate\Support\Facades\Redis;
use Psr\SimpleCache\CacheInterface;

class RedisAdapter implements CacheInterface
{
    protected RedisStore $redis;

    public function __construct()
    {
        $this->redis = new RedisStore(Redis::getFacadeRoot(), 'food_facts_');;
    }

    public function get($key, $default = null)
    {
        return $this->redis->get($key);
    }

    public function set($key, $value, $ttl = null)
    {
        return $this->redis->put($key, $value, $ttl);
    }

    public function clear()
    {
        // TODO: Implement clear() method.
    }

    public function delete($key)
    {
        // TODO: Implement delete() method.
    }

    public function deleteMultiple($keys)
    {
        // TODO: Implement deleteMultiple() method.
    }

    public function getMultiple($keys, $default = null)
    {
        // TODO: Implement getMultiple() method.
    }

    public function setMultiple($values, $ttl = null)
    {
        // TODO: Implement setMultiple() method.
    }

    public function has($key)
    {
        // TODO: Implement has() method.
    }
}
