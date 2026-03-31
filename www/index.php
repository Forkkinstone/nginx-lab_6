<?php
require 'vendor/autoload.php';

use App\RedisExample;
use App\ElasticExample;
use App\ClickhouseExample;

echo "<h1>Лабораторная работа №6 — Forkkinston</h1>";

// Тест Redis (Вариант 14 - Корзина)
$redis = new RedisExample();
$redis->addToCart(1, "Клавиатура");
$redis->addToCart(1, "Монитор");
echo "<h3>Redis (Корзина пользователя 1):</h3>";
var_dump($redis->getCart(1));

// Тест Clickhouse
try {
    $click = new ClickhouseExample();
    echo "<h3>ClickHouse (Системные таблицы):</h3>";
    echo $click->query("SELECT name FROM system.tables LIMIT 2");
} catch (\Exception $e) { echo "Clickhouse еще запускается..."; }

// Тест Elastic
try {
    $elastic = new ElasticExample();
    echo "<h3>Elasticsearch (Добавление):</h3>";
    echo $elastic->indexDocument('test', 1, ['msg' => 'Hello Elastic']);
} catch (\Exception $e) { echo "Elastic еще запускается..."; }
