<?php
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");

\App\Debug\Log::cleanLog('homework2');

LocalRedirect('/otus/students_dz/homework2/');
