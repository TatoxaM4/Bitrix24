<?php
declare(strict_types=1);

// Включаем отображение ошибок для отладки
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 1. Подключаем автозагрузчик Composer
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
} else {
    die("❌ Ошибка: vendor/autoload.php не найден");
}

// 2. Подключаем ваш класс Helper
$helperPath = __DIR__ . '/local/php_interface/src/Iblock/Helper.php';
if (file_exists($helperPath)) {
    require_once $helperPath;
} else {
    die("❌ Ошибка: Helper.php не найден по пути: $helperPath");
}

// 3. Подключаем ядро Битрикса
require_once __DIR__ . '/bitrix/header.php';

// 4. Используем класс
$APPLICATION->SetTitle("Демо Helper в корне");

try {
    // Вызываем метод класса
    $id = \Local\Iblock\Helper::getIdByCode('clients_s1');
    
    if ($id !== null) {
        echo "<h1 style='color: green;'>✅ Успех! ID инфоблока 'clients_s1': " . $id . "</h1>";
    } else {
        echo "<h1 style='color: orange;'>⚠️ Инфоблок с кодом 'clients_s1' не найден.</h1>";
    }
} catch (\Exception $e) {
    echo "<h1 style='color: red;'>❌ Ошибка выполнения: " . $e->getMessage() . "</h1>";
}

require_once __DIR__ . '/bitrix/footer.php';
