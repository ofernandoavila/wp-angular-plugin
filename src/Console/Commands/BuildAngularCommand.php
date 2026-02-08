<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Commands;

use Ofernandoavila\WpAngularPlugin\Console\Controller\AngularController;
use Symfony\Component\Console\Command\Command;

class BuildAngularCommand extends Command
{
    protected $signature = 'build:angular';

    protected $description = 'Realiza um build da aplicação angular';

    public function handle()
    {
        foreach (['webcomponents'] as $app) {
            $builder = new AngularController($app);
            $builder->build();
        }
    }
}
