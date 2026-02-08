<?php

namespace Ofernandoavila\WpAngularPlugin\Core;

use Symfony\Component\Yaml\Yaml;

class Application {
    private static $appName = "WP Angular Plugin";

    public static function GetApplicationName() {
        return self::$appName;
    }
    
    public static function GetCLITitle() {
        return self::$appName . " CLI - " . self::GetVersion();
    }

    public static function GetVersion() {
        return Yaml::parseFile(__DIR__ . '/../../gitversion.yml')['next-version'];
    }
}