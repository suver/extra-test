<?php
namespace App;

class Extra {

    private $cards;
    private $psychics;
    private $predictions;
    private $checks;

    public function init()
    {
        if (!empty($_SESSION['cards'])) $this->setCards($_SESSION['cards']);
        if (!empty($_SESSION['psychics'])) $this->setPsychics($_SESSION['psychics']);
        if (!empty($_SESSION['predictions'])) $this->predictions = $_SESSION['predictions'];
        if (!empty($_SESSION['checks'])) $this->checks = $_SESSION['checks'];
    }

    public function setCards($array)
    {
        $_SESSION['cards'] = $array;
        $this->cards = $array;
    }

    public function getCards()
    {
        return $this->cards;
    }

    public function setPsychics($array)
    {
        $_SESSION['psychics'] = $array;
        $this->psychics = $array;
    }

    public function getPsychics()
    {
        return $this->psychics;
    }

    public function prediction()
    {
        $cards = $this->cards;
        foreach ($this->psychics as $k => $psychic) {
            if (empty($cards)) $cards = $this->cards;
            shuffle($cards);
            $item = array_pop($cards);
            $this->psychics[$k]['history'][] = $item;
        }

        $this->setPsychics($this->psychics);
        return $this->getPsychics();
    }

    public function checkPrediction($params)
    {
        $win = null;
        $card = $params['number'];

        $this->checks[] =$card;
        $_SESSION['checks'] = $this->checks;
        foreach ($this->psychics as $k => $psychic) {
            if ($card == end($this->psychics[$k]['history'])) {
                $this->psychics[$k]['reliability']++;
                $win = $k;
            }
            else {
                $this->psychics[$k]['reliability']--;
            }
        }
        $this->setPsychics($this->psychics);
        return isset($this->psychics[$win]) ? $win : null;
    }

    public function checksHistory()
    {
        return $this->checks;
    }

}