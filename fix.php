<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$settingsFile = $_SERVER["DOCUMENT_ROOT"]."/bitrix/.settings.php";
$settings = require($settingsFile);
$dbConfig = $settings['connections']['value']['default'];

$conn = new mysqli($dbConfig['host'], $dbConfig['login'], $dbConfig['password'], $dbConfig['database']);

if ($conn->connect_error) {
    die("Ошибка БД: " . $conn->connect_error);
}

// Отключаем "Сайт остановлен"
$conn->query("UPDATE b_option SET VALUE='N' WHERE MODULE_ID='main' AND NAME='site_stopped'");

// На всякий случай отключаем и "Сайт закрыт"
$conn->query("UPDATE b_option SET VALUE='N' WHERE MODULE_ID='main' AND NAME='site_closed'");

echo "✅ Готово! Параметры 'site_stopped' и 'site_closed' установлены в 'N'.<br>";
echo "Теперь откройте сайт: <a href='/'>Перейти на главную</a>";

$conn->close();
?>
