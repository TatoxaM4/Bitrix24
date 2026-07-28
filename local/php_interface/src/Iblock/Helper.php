<?php
declare(strict_types=1);

namespace Local\Iblock;

use Bitrix\Main\Loader;
use Bitrix\Iblock\IblockTable;

class Helper
{
    /**
     * Получает ID инфоблока по его символьному коду.
     *
     * @param string $code Символьный код инфоблока
     * @return int|null ID инфоблока или null, если не найден
     */
    public static function getIdByCode(string $code): ?int
    {
        if (!Loader::includeModule('iblock')) {
            return null;
        }

        $result = IblockTable::getList([
            'select' => ['ID'],
            'filter' => [
                '=CODE' => $code,
            ],
        ])->fetch();

        // Безопасно возвращаем ID или null, если массив пуст
        return $result ? (int)$result['ID'] : null;
    }
}