<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Commands;

use Symfony\Component\Console\Command\Command;
use Ofernandoavila\WpAngularPlugin\Enum\StubEnum;
use Ofernandoavila\WpAngularPlugin\Util\File;

class MigrationNewCommand extends Command
{
    protected $signature = 'migration:new {name}';

    protected $description = 'Cria uma nova migration';

    public function handle()
    {
        $path = $this->get_template($this->argument('name'));

        $this->info("Migração criada em: {$path}");
    }

    private function get_template(string $name)
    {
        $fileName = date('Y_m_d_His') . '_' . $name;

        if (str_contains($name, 'criar_tabela_'))
            $name = str_replace('criar_tabela_', '', $name);

        $replaces = ['table_name' => $name];

        File::generate_file($fileName, StubEnum::MIGRATION, $replaces);

        return $fileName;
    }
}
