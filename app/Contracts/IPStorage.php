<?php


namespace App\Contracts;


interface IPStorage
{
    /**
     * @param string $ip
     * @return bool
     * Проверяет,есть ли такой адрес в хранилище
     */
    public function isset(string $ip) : bool;

    public function set(string $ip) : void;

    /**
     * @param string $ip
     * @return int
     * Получает количество запросов с данного адреса
     */
    public function getCount(string $ip) : int;

    /**
     * @param string $ip
     * @return bool
     * Проверяет,превышен ли лимит запросов в минуту
     */
    public function isLimitRequests(string $ip) : bool;

    public function incrementRequestsCount(string $ip) : void;

    public function decrementRequestsCount(string $ip) : void;
}
