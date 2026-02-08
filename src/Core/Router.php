<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

class Router
{
    public string $endpoint = '';
    public string $version = 'v1';
    public array $routes = [];

    public function Configure(string $base_endpoint, string $version = 'v1') {
        $this->endpoint = $base_endpoint;
        $this->version = $version;

        return $this;
    }

    public function RegisterRoute(string $route, string $method, $callback, bool $permision = false)
    {

        return $this->routes[] = ["route" => $route, "method" => $method, "callback" => $callback, 'permision' => $permision ];
    }

    public function Publish()
    {
        add_action('rest_api_init', function () {
            foreach ($this->routes as $rota) {
                register_rest_route("$this->endpoint/$this->version", $rota['route'], array(
                    'methods'  => $rota['method'],
                    'callback' => $rota['callback'],
                    'permission_callback' => function () use ($rota) {
                        if($rota['permision'])
                            return is_user_logged_in();   

                        return true;
                    }
                ));
            }
        });
    }
}
