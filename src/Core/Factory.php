<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

use Ofernandoavila\WpAngularPlugin\Util\File;

class Factory
{
    private array $variaveisJs = [];

    public function __construct(
        private Container $container
    ) {
        $this->container->Register(Factory::class, fn() => $this);
        $this->container->Register(Router::class, fn() => new Router());
        $this->container->Register(Database::class, fn() => new Database());
        $this->container->Register(AWSS3Bucket::class, fn() => new AWSS3Bucket());
    }

    public function Install()
    {
        foreach (File::get_dir('migrations_folder') as $migration) {
            $migration = require_once __DIR__ . '/../../app/database/migrations/' . $migration;
            $migration->Up();
        }

        foreach (File::get_dir('seeds_folder') as $seed) {
            $seed = require_once __DIR__ . '/../../app/database/seeds/' . $seed;
            $seed->seed();
        }
    }

    public function Uninstall()
    {
        foreach (array_reverse(File::get_dir('migrations_folder')) as $migration) {
            $path = __DIR__ . '/../../app/database/migrations/' . $migration;

            $migration = require_once $path;
            $migration->Down();
        }
    }

    public function Init()
    {
        foreach (File::get_config_file('controllers_config') as $controller)
            $this->container->Register($controller, fn() => new $controller($this->container));

        foreach (File::get_config_file('shortcodes_config') as $shortcode)
            $this->container->Register($shortcode, fn() => new $shortcode($this->container));

        $this->container->Resolve(Router::class)->Publish();

        $config = File::get_config_file('admin_menu_configs');

        $slug = sanitize_title($config['nome']) . '-admin-menu';

        add_action('admin_menu', function () use ($config, $slug) {
            add_menu_page(
                $config['nome'],
                $config['nome'],
                'manage_options',
                $slug,
                $config['callback'],
                $config['icon'],
                56
            );
        });

        add_action('admin_enqueue_scripts', function () {
            wp_register_style('trabalhe-conosco-admin-css', false);
            wp_enqueue_style('trabalhe-conosco-admin-css');

            wp_add_inline_style('trabalhe-conosco-admin-css', '
                #wpbody,
                #wpbody-content {
                    height: 100% !important;
                    padding-bottom: 0px !important;
                }
                #wpfooter {
                    display: none !important;
                }

                dd,li {
                    margin-bottom: 0px;
                }
            ');
        });

        add_action('admin_enqueue_scripts', function () {
            wp_localize_script('jquery', 'CcaaTrabalheConosco', $this->variaveisJs);
        }, 1);

        add_action('wp_enqueue_scripts', function () {
            wp_localize_script('jquery', 'CcaaTrabalheConosco', $this->variaveisJs);
        }, 1);

        return $this;
    }

    public function AdicionarVariavelJs(string $chave, mixed $valor)
    {
        $this->variaveisJs[$chave] = $valor;
    }
}
