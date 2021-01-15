<?php


namespace App\Services\IPStorages;


use App\Contracts\IPStorage;
use Illuminate\Support\Facades\Redis;

class RedisStorage implements IPStorage
{
    private const IP_PREFIX = 'ip:';

    private int $expire;
    private int $requestsLimit;

    public function __construct()
    {
        $this->requestsLimit = config('endpoint.ip_protection.requests_limit');
        $this->expire = config('endpoint.ip_protection.expire');
    }

    public function isset(string $ip): bool
    {
        return Redis::get(self::IP_PREFIX . $ip) !== null;
    }

    public function set(string $ip): void
    {
        Redis::set(self::IP_PREFIX . $ip, 1 ,'ex',$this->expire);
    }

    public function getCount(string $ip): int
    {
        return Redis::get(self::IP_PREFIX . $ip);
    }

    public function isLimitRequests(string $ip): bool
    {
        return Redis::get(self::IP_PREFIX . $ip) >= $this->requestsLimit;
    }

    public function incrementRequestsCount(string $ip): void
    {
        Redis::incr(self::IP_PREFIX . $ip);
    }

    public function decrementRequestsCount(string $ip): void
    {
        Redis::decr(self::IP_PREFIX . $ip);
    }
}
