<?php
namespace App;

use Predis\Client;

class RedisExample {
    private $client;

    public function __construct() {
        $this->client = new Client([
            'scheme' => 'tcp',
            'host'   => 'redis', // имя сервиса в docker-compose
            'port'   => 6379,
        ]);
    }

    public function addToCart($userId, $item) {
        $this->client->rpush("cart:$userId", $item);
    }

    public function getCart($userId) {
        return $this->client->lrange("cart:$userId", 0, -1);
    }
}
