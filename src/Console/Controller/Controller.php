<?php

namespace Ofernandoavila\WpAngularPlugin\Console\Controller;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Controller {
    protected InputInterface $input;
    protected OutputInterface $output;

    public function __construct(
        protected Command $command 
    ) {}

    public function configure(InputInterface $input, OutputInterface $output) {
        $this->input = $input;
        $this->output = $output;
    
        return $this;
    }
}