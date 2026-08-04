<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест логирования: Читаем");

// Просто вызываем метод статического класса напрямую:
\App\Debug\Log::write("", ""); 

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
