<?php

namespace App;

class Core {

    public function run()
    {
        $command = $this->getCommand();
        $params = $this->getParams();

        $result = $this->runCommand($command, $params);
        print $result;
    }

    private function getCommand()
    {
        $command = $_GET['c'];
        return $command;
    }

    private function getParams()
    {
        return $_POST;
    }

    private function runCommand($command, $params)
    {
        if (!file_exists(CORE_DIR . "/app/commands/" . ucfirst($command) . ".php")) {
            throw new \Exception("File ./app/commands/" . ucfirst($command) . ".php Not Found");
        }

        include_once CORE_DIR . "/app/commands/" . ucfirst($command) . ".php";

        $class = "\\App\\Commands\\" . ucfirst($command);
        if (!class_exists($class)) {
            throw new \Exception("Command Not Found");
        }

        $com = new $class;
        $com->init();
        header('Content-Type: application/json');
        return json_encode($com->run($params));
    }
}