<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Commands;

use Ofernandoavila\WpAngularPlugin\Console\Controller\InitController;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class InitCommand extends Command {
    private InitController $controller;

    public function __construct()
    {
        $parent = parent::__construct('init');
        $this->controller = new InitController($this);

        return $parent;
    }

    protected function configure() : void
    {
        $this->setDescription('Cria a estrutura base do plugin WordPress + Angular');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->controller
             ->configure($input, $output)
             ->new_application('Teste 123', 'wp_teste_123');

        return Command::SUCCESS;
    }
}