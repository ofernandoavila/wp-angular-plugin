<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

class Container
{
    private $bindings = [];

    public function Register(string $class, mixed $resolver)
    {
        $this->bindings[$class] = call_user_func($resolver);
    }

    public function Resolve(string $class)
    {
        if (!isset($this->bindings[$class]))
            throw new \Exception("Classe não encontrada: " . $class);

        return $this->bindings[$class];
    }
}
