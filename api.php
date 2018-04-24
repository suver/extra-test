<?php

define("CORE_DIR", dirname(__FILE__));

include_once CORE_DIR . "/app/Core.php";

$app = new \App\Core();
$app->run();