<?php

namespace App\Debug;

use Bitrix\Main\Diag\ExceptionHandlerFormatter;
use Bitrix\Main\Diag\FileExceptionHandlerLog;

class Log extends FileExceptionHandlerLog
{
    public static function addLog($message, bool $clear = false, string $fileName = 'custom', bool $timeVersion = true): void
    {
        $logDir = $_SERVER["DOCUMENT_ROOT"] . '/local/logs/';
        if (!is_dir($logDir)) mkdir($logDir, 0755, true);

        $logFile = $logDir . $fileName . ($timeVersion ? '_' . date("d.m.Y") : '') . '.log';

        $_message = "OTUS " . date("d.m.Y H:i:s") . "\n" . print_r($message, true) . "\n---\n";

        file_put_contents($logFile, $_message, $clear ? 0 : FILE_APPEND);
    }

    public static function cleanLog(string $fileName = 'custom', bool $timeVersion = true): void
    {
        $logDir = $_SERVER['DOCUMENT_ROOT'] . '/local/logs/';
        $logFile = $logDir . $fileName . ($timeVersion ? '_' . date("d.m.Y") : '') . '.log';
        if (file_exists($logFile)) file_put_contents($logFile, '');
    }

    public function write($exception, $logType): void
    {
        $message = ExceptionHandlerFormatter::format($exception);
        $logMessage = sprintf("[OTUS] [%s] [%s]\n%s\n\n", date('Y-m-d H:i:s'), $logType, $message);
        $filePath = $this->getFile();
        
        if (file_exists($filePath) && filesize($filePath) > $this->getMaxFileSize()) {
            rename($filePath, $filePath . '.' . date('Y-m-d_H-i-s'));
        }
        file_put_contents($filePath, $logMessage, FILE_APPEND);
    }

    protected function getFile(): string
    {
        return $_SERVER['DOCUMENT_ROOT'] . '/' . ltrim($this->settings['file'] ?? 'local/logs/exceptions.log', '/');
    }

    protected function getMaxFileSize(): int
    {
        return (int)($this->settings['log_size'] ?? 1000000);
    }
}


