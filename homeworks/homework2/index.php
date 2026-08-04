<?

use Bitrix\Main\Page\Asset;

require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

$APPLICATION->SetTitle("ДЗ #2: Отладка и логирование");

Asset::getInstance()->addCss('//cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

?>
    <h1 class="mb-3"><? $APPLICATION->ShowTitle() ?></h1>

    <h4 class="mb-3">Пояснительная записка</h4>
    <div style="color: red;font-style: italic;">
        1. Выполняем команду создания файла лога из файла addLog.php создаеться запись в файле local/logs/exceptions.log <br>
        2. Читаем файл exceptions.log <br>
        3. Очищаем файл  clearlog.php <br>
        <br>
        p.s.<br>
        Не совсем понял разницу зачем нужено делать log и exception<br>


    </div>
    <br>
    <br>
    <hr>
    <div style="color: red;font-style: italic;">
        &darr;&darr;&darr; ссылки ниже заменить на свои &darr;&darr;&darr;
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта: Часть 1 - Logger
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/local/logs/exceptions.log"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /Просмотр файла
                </span>
                    <span class="badge bg-success">
                    Файл лога из п1 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/local/App/Debug/addLog.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /Добавляем запись
                </span>
                    <span class="badge bg-secondary">
                    Добавление в лог из п1 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework2/clearlog.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    /Очищаем запись
                </span>
                    <span class="badge bg-warning">
                    Очистить лог из п1 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/App/Debug/Log.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Файл с классом кастомного логгера
                </span>
                    <span class="badge bg-primary">
                    класс логгера в админке
                </span>
                </a>
            </li>

        </ul>
    </div>

    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">
            Файлы проекта: Часть 2 - Exception
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item list-group-item-action">
                <a href="/local/logs/exceptions.log"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    local/logs/exceptions.log
                </span>
                    <span class="badge bg-primary">
                    Файл лога из п2 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework2/writeexception.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    writeexception.php
                </span>
                    <span class="badge bg-success">
                    Добавление в лог из п2 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/homeworks/homework2/clearlog.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    clearexception.php
                </span>
                    <span class="badge bg-secondary">
                    Очистить лог из п2 ДЗ
                </span>
                </a>
            </li>
            <li class="list-group-item list-group-item-action">
                <a href="/bitrix/admin/fileman_file_view.php?path=/local/App/Debug/Log.php"
                   class="d-flex justify-content-between align-items-center">
                <span>
                    Файл с классом системного исключений
                </span>
                    <span class="badge bg-warning">
                    класс логгера в админке
                </span>
                </a>
            </li>
        </ul>
    </div>


<? require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php"); ?>