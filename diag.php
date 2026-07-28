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

echo "<h2>🔍 Диагностика блокировки сайта</h2>";

// 1. Проверяем site_closed
$result = $conn->query("SELECT NAME, VALUE FROM b_option WHERE MODULE_ID='main' AND NAME='site_closed'");
if ($row = $result->fetch_assoc()) {
    echo "<p><b>site_closed</b> = <font color='red'>{$row['VALUE']}</font></p>";
    if ($row['VALUE'] !== 'N') {
        echo "<p>❌ Сайт закрыт! Исправляю...</p>";
        $conn->query("UPDATE b_option SET VALUE='N' WHERE MODULE_ID='main' AND NAME='site_closed'");
        echo "<p>✅ Исправлено!</p>";
    } else {
        echo "<p>✅ site_closed = N (сайт открыт)</p>";
    }
} else {
    echo "<p>⚠️ Параметр site_closed не найден</p>";
}

// 2. Проверяем все настройки main, которые могут блокировать
echo "<h3>Все настройки модуля 'main':</h3>";
$result = $conn->query("SELECT NAME, VALUE FROM b_option WHERE MODULE_ID='main' ORDER BY NAME");
echo "<table border='1'><tr><th>NAME</th><th>VALUE</th></tr>";
while ($row = $result->fetch_assoc()) {
    $color = (strpos($row['NAME'], 'closed') !== false || strpos($row['NAME'], 'stop') !== false) ? 'red' : 'black';
    echo "<tr><td>{$row['NAME']}</td><td style='color:{$color}'>{$row['VALUE']}</td></tr>";
}
echo "</table>";

// 3. Проверяем настройки для конкретного сайта (SITE_ID)
echo "<h3>Настройки для всех сайтов:</h3>";
$result = $conn->query("SELECT SITE_ID, NAME, VALUE FROM b_option WHERE NAME='site_closed'");
if ($result->num_rows > 0) {
    echo "<table border='1'><tr><th>SITE_ID</th><th>NAME</th><th>VALUE</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>{$row['SITE_ID']}</td><td>{$row['NAME']}</td><td>{$row['VALUE']}</td></tr>";
    }
    echo "</table>";
} else {
    echo "<p>Нет настроек site_closed для конкретных сайтов</p>";
}

// 4. Проверяем таблицу b_site
echo "<h3>Список сайтов:</h3>";
$result = $conn->query("SELECT LID, NAME, ACTIVE FROM b_lang");
echo "<table border='1'><tr><th>LID</th><th>NAME</th><th>ACTIVE</th></tr>";
while ($row = $result->fetch_assoc()) {
    echo "<tr><td>{$row['LID']}</td><td>{$row['NAME']}</td><td>{$row['ACTIVE']}</td></tr>";
}
echo "</table>";

$conn->close();
?>
