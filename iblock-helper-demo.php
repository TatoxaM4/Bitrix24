<?php
declare(strict_types=1);

error_reporting(E_ALL);
ini_set('display_errors', '1');

// 1. Подключаем автозагрузчик Composer относительно текущей папки
if (file_exists(__DIR__ . '/bitrix/vendor/autoload.php')) {
    require_once __DIR__ . '/bitrix/vendor/autoload.php';
}

// 2. ПОДКЛЮЧАЕМ ВАШ КЛАСС ОТНОСИТЕЛЬНО ТЕКУЩЕЙ ПАПКИ (ЧЕРЕЗ __DIR__)
if (file_exists(__DIR__ . '/local/php_interface/src/Iblock/Helper.php')) {
    require_once __DIR__ . '/local/php_interface/src/Iblock/Helper.php';
} else {
    echo "<p style='color:red;'>Ошибка: файл Helper.php не найден на сервере рядом с этим скриптом!</p>";
}

// 3. Подключаем ядро Битрикса
require_once __DIR__ . '/bitrix/header.php';

use Local\Iblock\Helper;

$APPLICATION->SetTitle("Демо Helper в корне");

$id = Helper::getIdByCode('clients_s1');
echo "<h1>ID инфоблока: " . ($id ?? 'не найден') . "</h1>";

require_once __DIR__ . '/bitrix/footer.php';
