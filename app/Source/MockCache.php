<?php


namespace App\Source;


use Psr\SimpleCache\CacheInterface;

class MockCache implements CacheInterface
{
    public function get($key, $default = null): array
    {
        return [];
    }

    public function set($key, $value, $ttl = null): bool
    {
        return false;
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
