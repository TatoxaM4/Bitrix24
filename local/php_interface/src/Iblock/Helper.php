<?php
namespace Local\Iblock;

// Подключаем правильные пространства имен Битрикса
use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;

class Helper
{
    public static function getIdByCode($code) // добавил имя функции для примера
    {
        // Теперь Loader определен правильно
        if (!Loader::includeModule('iblock')) {
            return null;
        }

        // Теперь IblockTable тоже определен правильно
        return IblockTable::getList([
            'filter' => [
                '=CODE' => $code,
            ],
        ])->fetch()['ID'];
    }
}
