<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Commands;

use Illuminate\Console\Command;
use Ofernandoavila\WpAngularPlugin\Util\File;
use Ofernandoavila\WpAngularPlugin\Enum\StubEnum;

class SeedCommand extends Command
{
    protected $signature = 'seed:new {modelo}';

    protected $description = 'Cria uma nova seed';

    public function handle()
    {
        $modelo = $this->argument('modelo');

        $fileName = date('Y_m_d_His') . '_' . $modelo . 'Seeder';

        $replaces = ['model' => $modelo];

        File::generate_file($fileName, StubEnum::SEED, $replaces);

        $this->info("Seed criada em: {$fileName}");
    }
}

// ##{{CLASSNAME}}##