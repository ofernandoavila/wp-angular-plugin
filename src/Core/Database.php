<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

use Illuminate\Container\Container;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;

class Database
{
    private $capsule;

    public function __construct()
    {
        $this->capsule = new Capsule();
        $this->ConfigureDatabase();
    }

    private function ConfigureDatabase()
    {
        $prefix = 'wp_';

        if (isset($_ENV['TRABALHE_CONOSCO_DB_PREFIX']))
            $prefix = $prefix . $_ENV['TRABALHE_CONOSCO_DB_PREFIX'];

        $this->capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => DB_HOST,
            'database'  => DB_NAME,
            'username'  => DB_USER,
            'password'  => DB_PASSWORD,
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => $prefix
        ]);

        $this->capsule->setEventDispatcher(
            new Dispatcher(new Container)
        );

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();
    }
}
