<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Commands;

use Illuminate\Console\Command;
use Ofernandoavila\WpAngularPlugin\Console\Controller\ModelController;
use Ofernandoavila\WpAngularPlugin\Enum\StubEnum;
use Ofernandoavila\WpAngularPlugin\Util\File;

class ModelCommand extends Command
{
    protected $signature = 'model:new {name}';

    protected $description = 'Cria um novo modelo';

    public function handle()
    {
        ModelController::new($this->argument('name'));

        $this->info("Modelo criado em: {$this->argument('name')}");
    }
}
