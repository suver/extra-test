<?php

namespace App\Commands;

use App\Extra;

class Init {

    private $sessionId = NULL;

    public function init()
    {
        session_id(md5(time()));
        $this->sessionId = session_id();
        session_start();
    }

    public function run($params)
    {
        include_once CORE_DIR . "/app/Extra.php";

        $extra = new Extra();
        $extra->setCards([
            "00", "11", "22", "33", "44",
            "55", "66", "77", "88", "99",
        ]);
        $extra->setPsychics([
            "Psychic 0" => ['reliability' => 10, 'history' => []],
            "Psychic 1" => ['reliability' => 10, 'history' => []],
            "Psychic 2" => ['reliability' => 10, 'history' => []],
            "Psychic 3" => ['reliability' => 10, 'history' => []],
            "Psychic 4" => ['reliability' => 10, 'history' => []],
            "Psychic 5" => ['reliability' => 10, 'history' => []],
            "Psychic 6" => ['reliability' => 10, 'history' => []],
            "Psychic 7" => ['reliability' => 10, 'history' => []],
            "Psychic 8" => ['reliability' => 10, 'history' => []],
            "Psychic 9" => ['reliability' => 10, 'history' => []],
        ]);

        return [
            "sessionId" => $this->sessionId,
            "cards" => $extra->getCards(),
            "extra" => $extra->getPsychics(),
        ];
    }

}