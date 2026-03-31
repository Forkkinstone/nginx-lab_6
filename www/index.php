<?php
require 'vendor/autoload.php';

use App\RedisExample;
use App\ElasticExample;
use App\ClickhouseExample;

echo "<h1>Лабораторная работа №6 — Труфанов Даниил</h1>";

// --- Тест Redis ---
$redis = new RedisExample();

$cart = $redis->getCart(1);

// Если корзина пуста (например, после очистки или первого запуска), наполняем её
if (empty($cart)) {
    $redis->addToCart(1, "Клавиатура");
    $redis->addToCart(1, "Монитор");
    $cart = $redis->getCart(1);
}

echo "<h3>Redis (Корзина пользователя 1):</h3>";
echo "<pre>";
var_dump($cart);
echo "</pre>";

// --- Тест Clickhouse ---
try {
    $click = new ClickhouseExample();
    echo "<h3>ClickHouse (Системные таблицы):</h3>";
    echo $click->query("SELECT name FROM system.tables LIMIT 2");
} catch (\Exception $e) { 
    echo "Clickhouse еще запускается или ошибка: " . $e->getMessage(); 
}

// --- Тест Elastic ---
try {
    $elastic = new ElasticExample();
    echo "<h3>Elasticsearch (Добавление):</h3>";
    echo $elastic->indexDocument('test', 1, ['msg' => 'Hello Elastic']);
} catch (\Exception $e) { 
    echo "Elastic еще запускается или ошибка: " . $e->getMessage(); 
}
