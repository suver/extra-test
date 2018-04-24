<?php

namespace App\Commands;

use App\Extra;

class Test {

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
        $extra->prediction();

        return [
            "sessionId" => $_GET['s'],
            "cards" => $extra->getCards(),
            "psychics" => $extra->getPsychics(),
        ];
    }

}