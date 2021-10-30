<?php

namespace App\Repositories;

use Illuminate\Support\Facades\Redis;

class CacheRepository
{
    public function put($key, $value, $min = 60 * 60)
    {
        return Redis::set($key, $value);
    }

    public function get($key)
    {
        try {
            return Redis::get($key);
        } catch (\Throwable $exception) {
            return null;
        }
    }

    public function hGetAll($key)
    {
        try {
            return Redis::HGETALL($key);
        } catch (\Throwable $exception) {
            return null;
        }
    }

    public function hGet($key, $field)
    {
        return  Redis::HGET($key, $field);
    }

    public function hExists($key, $field)
    {
        return Redis::hExists($key, $field);
    }

    public function forget($key)
    {
        try {
            return Redis::del($key);
        } catch (\Exception $exception) {
            return null;
        }
    }
}
