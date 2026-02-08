<?php

namespace Ofernandoavila\WpAngularPlugin\Console;

use Ofernandoavila\WpAngularPlugin\Console\Commands\InitCommand;
use Symfony\Component\Console\Application;

class Console extends Application
{
    public function __construct()
    {
        parent::__construct('WP Angular Plugin CLI', '1.0.0');

        $this->addCommand(new InitCommand());
    }
}
