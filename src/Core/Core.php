<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

use Dotenv\Dotenv;

class Core
{
    public Container $container;
    private Factory $factory;

    public function __construct(
        private readonly string $rootPath
    ) {
        $dotenv = Dotenv::createImmutable($this->rootPath);
        $dotenv->load();

        $this->container = new Container();
        $this->factory = new Factory($this->container);
    }

    public function Init()
    {
        return $this->factory->Init();
    }

    public static function Install(string $rootPath)
    {
        return (new Core($rootPath))->container->Resolve(Factory::class)->Install();
    }

    public static function Uninstall(string $rootPath)
    {
        return (new Core($rootPath))->container->Resolve(Factory::class)->Uninstall();
    }
}
