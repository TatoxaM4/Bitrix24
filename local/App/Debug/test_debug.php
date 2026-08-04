
<?php
// 1. Обязательно подключаем ядро Битрикс в самом начале
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
$APPLICATION->SetTitle("Отладка SQL запросов");

$hh = 1/0; 

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");
?>
// //region Отладка SQL
// use Bitrix\Main\Loader;
// use Bitrix\Main\Application;

// if (!Loader::includeModule('iblock'))
// {
//     return false;
// }

// $IBLOCK_ID = 7; // Фотогалерея пользователей
// // bitrix/admin/iblock_list_admin.php?IBLOCK_ID=7&type=photos&lang=ru&find_section_section=-1

// // Параметры выборки
// $arEntityDataParams = [
//     'select' => ['ID', 'NAME'],
//     'filter' => ['IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'],
//     'limit' => 5
// ];

// // Включаем трекинг SQL
// $connection = Application::getConnection();
// $connection->startTracker();

// // Выполняем запрос
// $query = \Bitrix\Iblock\ElementTable::getList($arEntityDataParams);
// $result = $query->fetchAll(); // Можно или fetch() в цикле

// // Отключаем трекер
// $connection->stopTracker();

// // Получаем SQL-запрос
// $sql = $query->getTrackerQuery()->getSql();

// // Вывод
// echo "<pre>";
// print_r($result);
// echo "SQL запрос:\n" . $sql;
// echo "</pre>";
// //endregion


// // Здесь будет ваш код для отладки
// // print_r (value:'<pre>');
// // print_r (value:'$_SERVER: ');
// // print_r ($_SERVER);
// // print_r (value:'</pre>');

// // print_r ('<pre>');
// // print_r ('var_dump($_SERVER): ');
// // print_r (var_dump($_SERVER));
// // print_r ('</pre>');
// // dump($_SERVER);
// // sage ($_SERVER);

// // \Bitrix\Main\Diag\Debug::dumpToFile ($_SERVER, "varName", "");


// // Запускаем таймер
// // \Bitrix\Main\Diag\Debug::startTimeLabel('$_SERVER1');

// // sleep(1);

// // // Останавливаем таймер
// // \Bitrix\Main\Diag\Debug::endTimeLabel('$_SERVER1');
// // // Получаем ВСЕ метки (метод во множественном числе!)
// // $TimeLabels = \Bitrix\Main\Diag\Debug::getTimeLabels();

// // echo "<pre>";
// // print_r('$TimeLabels: ');
// // print_r($TimeLabels);
// // // echo "</pre>";
// // $gbt = \Bitrix\Main\Diag\Helper::getBacktrace();
// // echo "<pre>";
// // print_r('$gbt: ');
// // print_r($gbt);
// // echo "</pre>";
// // выводим номер строки ошибки
// 