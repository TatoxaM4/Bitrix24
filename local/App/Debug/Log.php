<?php

namespace App\Debug;

use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Bitrix\Main\Diag\FileExceptionHandlerLog;

/**
 * Класс для кастомного логирования исключений
 * 
 * @example
 * \App\Debug\Log::addLog('onBeforeHLAdd');
 */
class Log extends FileExceptionHandlerLog
{
    /**
     * Добавляет запись в лог
     *
     * @param mixed $message Сообщение для записи
     * @param bool $clear Очищать ли файл перед записью
     * @param string $fileName Имя файла лога (без расширения)
     * @param bool $timeVersion Добавлять ли временную метку к имени файла
     * @return void
     */
    public static function addLog($message, bool $clear = false, string $fileName = 'custom', bool $timeVersion = true): void
    {
        $logDir = $_SERVER["DOCUMENT_ROOT"] . '/local/logs/';
        
        // 1. Создаем директорию, если она не существует (ВАЖНО!)
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }

        $logFile = $logDir . $fileName;

        if ($timeVersion) {
            $logFile .= '_' . date("d.m.Y");
        }

        $logFile .= '.log';

        $_message = date("d.m.Y H:i:s") . "\n";
        $_message .= print_r($message, true) . "\n";
        $_message .= "---\n";

        if ($clear) {
            file_put_contents($logFile, $_message);
        } else {
            file_put_contents($logFile, $_message, FILE_APPEND);
        }
    }

    /**
     * Очищает лог
     *
     * @param string $fileName Имя файла лога (без расширения)
     * @param bool $timeVersion Учитывать ли дату в имени файла при очистке
     * @return void
     */
    public static function cleanLog(string $fileName = 'custom', bool $timeVersion = true): void
    {
        $logDir = $_SERVER['DOCUMENT_ROOT'] . '/local/logs/';
        $logFile = $logDir . $fileName;
        
        if ($timeVersion) {
            $logFile .= '_' . date("d.m.Y");
        }
        $logFile .= '.log';

        if (file_exists($logFile)) {
            // ИСПРАВЛЕНО: убран именованный аргумент 'data:'
            file_put_contents($logFile, '');
        }
    }

    /**
     * Записывает исключение в лог (переопределение метода родителя)
     *
     * @param \Throwable $exception Исключение для записи
     * @param string $logType Тип лога
     * @return void
     */
    public function write($exception, $logType): void
    {
        // Форматируем исключение штатным средством Битрикс
        $message = ExceptionHandlerFormatter::format($exception);
        
        // Добавляем дополнительную информацию
        $logMessage = sprintf(
            "[%s] [%s]\n%s\n\n",
            date('Y-m-d H:i:s'),
            $logType,
            $message
        );

        // Получаем путь к файлу из настроек
        $filePath = $this->getFile();
        
        // Проверяем размер файла для ротации
        if (file_exists($filePath)) {
            $fileSize = filesize($filePath);
            $maxSize = $this->getMaxFileSize();
            
            // Если файл слишком большой, создаем резервную копию
            if ($fileSize > $maxSize) {
                $backupFile = $filePath . '.' . date('Y-m-d_H-i-s');
                rename($filePath, $backupFile);
            }
        }

        // Записываем в файл
        file_put_contents($filePath, $logMessage, FILE_APPEND);
    }

    /**
     * Получаем путь к файлу лога
     *
     * @return string
     */
    protected function getFile(): string
    {
        if (isset($this->settings['file'])) {
            // ltrim убирает возможный слеш в начале, чтобы путь склеился корректно
            return $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($this->settings['file'], '/');
        }
        
        return $_SERVER['DOCUMENT_ROOT'] . '/local/logs/exceptions.log';
    }

    /**
     * Получаем максимальный размер файла
     *
     * @return int
     */
    protected function getMaxFileSize(): int
    {
        return (int)($this->settings['log_size'] ?? 1000000);
    }
}