<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Controller;

use Symfony\Component\Console\Command\Command;

class InitController extends Controller
{
    public function __construct(Command $command) { parent::__construct($command); }

    public function new_application(string $name, string $tableName)
    {
        $projectFolder = __DIR__ . '/' . $name;

        // Cria pasta do projeto
        mkdir($projectFolder);

        // Cria pasta da aplicação
        mkdir($projectFolder . '/app');
        mkdir($projectFolder . '/app/Http');
        mkdir($projectFolder . '/app/Http/Controller');
        mkdir($projectFolder . '/app/Model');
        mkdir($projectFolder . '/app/Shortcode');
        mkdir($projectFolder . '/app/Database');
        mkdir($projectFolder . '/app/Database/Migration');
        mkdir($projectFolder . '/app/Database/Seed');

        // Cria pasta de assets
        mkdir($projectFolder . '/assets');
        
        // Cria pasta de assets
        mkdir($projectFolder . '/frontend');
        mkdir($projectFolder . '/frontend/src');
        mkdir($projectFolder . '/frontend/src/config');
        mkdir($projectFolder . '/frontend/src/config/theme');
        mkdir($projectFolder . '/frontend/src/lib');
        mkdir($projectFolder . '/frontend/src/scss');

        $path = __DIR__ . '/../stubs/frontend';

        $files = [
            $path . '/tsconfig.spec.json' => $projectFolder . '/frontend/tsconfig.spec.json',
            $path . '/tsconfig.json' => $projectFolder . '/frontend/tsconfig.json',
            $path . '/tsconfig.app.json' => $projectFolder . '/frontend/tsconfig.app.json',
            $path . '/package.json' => $projectFolder . '/frontend/package.json',
            $path . '/angular.json' => $projectFolder . '/frontend/angular.json',
            $path . '/.gitignore' => $projectFolder . '/frontend/.gitignore',
            $path . '/.editorconfig' => $projectFolder . '/frontend/.editorconfig',
            $path . '/src/config/theme/floatlabel.preset.ts' => $projectFolder . '/frontend/src/config/theme/floatlabel.preset.ts',
            $path . '/src/config/theme/inputtext.preset.ts' => $projectFolder . '/frontend/src/config/theme/inputtext.preset.ts',
            $path . '/src/config/theme/select.preset.ts' => $projectFolder . '/frontend/src/config/theme/select.preset.ts',
            $path . '/src/config/theme/theme.preset.ts' => $projectFolder . '/frontend/src/config/theme/theme.preset.ts',
            $path . '/src/config/app.config.ts' => $projectFolder . '/frontend/src/config/app.config.ts',
            $path . '/src/config/app.routes.ts' => $projectFolder . '/frontend/src/config/app.routes.ts',
            $path . '/src/config/app.ts' => $projectFolder . '/frontend/src/config/app.ts',
            $path . '/src/config/web-components.ts' => $projectFolder . '/frontend/src/config/web-components.ts',
            $path . '/src/lib/index.html' => $projectFolder . '/frontend/src/lib/index.html',
            $path . '/src/lib/main.ts' => $projectFolder . '/frontend/src/lib/main.ts',
            $path . '/src/scss/_reset.scss' => $projectFolder . '/frontend/src/scss/_reset.scss',
            $path . '/src/scss/styles.scss' => $projectFolder . '/frontend/src/scss/styles.scss',
            $path . '/src/scss/styles.scss' => $projectFolder . '/frontend/src/scss/styles.scss',
            $path . '/src/index.html' => $projectFolder . '/frontend/src/index.html',
            $path . '/src/main.ts' => $projectFolder . '/frontend/src/main.ts',
        ];

        foreach($files as $from => $to) {
            copy($from, $to);
        }

        file_put_contents($projectFolder . '/.env', '');

        copy(__DIR__ . '/../stubs/plugin.php', $projectFolder . '/plugin.php');
        copy(__DIR__ . '/../stubs/gitversion.yml', $projectFolder . '/gitversion.yml');

        $this->output->writeln("Nome da aplicação: " . $name);
    }
}
