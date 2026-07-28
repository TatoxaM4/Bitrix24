<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Примеры отладки");

// Здесь будет ваш код для отладки
// print_r (value:'<pre>');
// print_r (value:'$_SERVER: ');
// print_r ($_SERVER);
// print_r (value:'</pre>');

// print_r ('<pre>');
// print_r ('var_dump($_SERVER): ');
// print_r (var_dump($_SERVER));
// print_r ('</pre>');
// dump($_SERVER);
// sage ($_SERVER);

// \Bitrix\Main\Diag\Debug::dumpToFile ($_SERVER, "varName", "");


// Запускаем таймер
// \Bitrix\Main\Diag\Debug::startTimeLabel('$_SERVER1');

// sleep(1);

// // Останавливаем таймер
// \Bitrix\Main\Diag\Debug::endTimeLabel('$_SERVER1');
// // Получаем ВСЕ метки (метод во множественном числе!)
// $TimeLabels = \Bitrix\Main\Diag\Debug::getTimeLabels();

// echo "<pre>";
// print_r('$TimeLabels: ');
// print_r($TimeLabels);
// echo "</pre>";
$gbt = \Bitrix\Main\Diag\Helper::getBacktrace();
echo "<pre>";
print_r('$gbt: ');
print_r($gbt);
echo "</pre>";




require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>