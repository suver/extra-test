<?php

namespace App\Commands;

use App\Extra;

class History {

    public function init()
    {
        session_id($_GET['s']);
        session_start();
    }

    public function run($params)
    {
        include_once CORE_DIR . "/app/Extra.php";

        $extra = new Extra();
        $extra->init();

        return [
            "sessionId" => $_GET['s'],
            "cards" => $extra->getCards(),
            "psychics" => $extra->getPsychics(),
            "checks" => $extra->checksHistory(),
        ];
    }

}