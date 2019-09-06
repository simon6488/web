<?php
/**
 * Created by PhpStorm.
 * @copyright:  杭州云呼网络科技有限公司
 * @author  Shunfei.Xia<shunfei.xia@yunhuyj.com>
 * Date: 2019/9/6
 * Time: 11:29
 */

namespace App\Service;


class CacheService
{

    private static function getClient()
    {
        return make(\Redis::class);
    }

    private static function getKey(string $key): string
    {
        return 'qiqi_' . $key;
    }

    public static function setex($key, $value, $seconds)
    {
        $value = json_encode([$value]);
        return static::getClient()->setex(static::getKey($key), $seconds, $value);
    }

    public static function get($key)
    {
        $value = static::getClient()->get(static::getKey($key));
        if ($value === null) {
            return null;
        }
        return json_decode($value, true)[0];
    }

    /**
     * @param $key
     * @return int
     */
    public static function del($key)
    {
        return static::getClient()->del(static::getKey($key));
    }

    /**
     * @param $key
     * @param $field
     * @param $value
     * @return int
     */
    public static function hset($key, $field, $value)
    {
        return static::getClient()->hset(static::getKey($key), $field, json_encode([$value]));
    }

    /**
     * @param $key
     * @param array $dictionary
     * @param bool $encode
     * @return bool
     */
    public static function hmset($key, array $dictionary, $encode = true)
    {
        if (empty($dictionary)) {
            return true;
        }
        if ($encode) {
            $dictionary = array_map(function ($value) {
                return json_encode([$value]);
            }, $dictionary);
        }
        return static::getClient()->hmset(static::getKey($key), $dictionary) == 'OK';
    }

    /**
     * @param $key
     * @param bool $encode
     * @return array|null
     */
    public static function hgetall($key, $encode = true)
    {
        $data = static::getClient()->hgetall(static::getKey($key));
        if (empty($data)) {
            return null;
        }
        if ($encode) {
            return array_map(function ($v) {
                return json_decode($v, true)[0];
            }, $data);
        }
        return $data;
    }

    /**
     * @param $key
     * @param $field
     * @return string
     */
    public static function hget($key, $field)
    {
        $re = static::getClient()->hget(static::getKey($key), $field);
        if ($re !== null) {
            return json_decode($re, true)[0];
        }
        return $re;
    }

    public static function hmget($key, array $fields)
    {
        $data = static::getClient()->hmget(static::getKey($key), $fields);
        $data = array_filter($data, function ($value) {
            return $value !== null;
        });
        return array_map(function ($value) {
            return json_decode($value, true)[0];
        }, $data);
    }

    /**
     * @param $key
     * @param array $fields
     * @return int
     */
    public static function hdel($key, array $fields)
    {
        return static::getClient()->hdel(static::getKey($key), $fields);
    }

    public static function exists($key)
    {
        return static::getClient()->exists(static::getKey($key));
    }
}