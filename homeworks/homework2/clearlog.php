<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Тест логирования: Очистка exception");

\App\Debug\Log::cleanLog('exceptions', false);



require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>