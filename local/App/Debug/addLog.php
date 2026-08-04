<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест логирования: Создать");

use App\Debug\Log;

echo "<h2>1. СОЗДАЕМ запись в логе </h2>";

$hh = 1/0;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>