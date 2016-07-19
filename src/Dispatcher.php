<?php

namespace App;
use Symfony\Component\Yaml\Yaml as Yaml;
use Silex\Application as Application;

class Dispatcher
{
    protected $resources;

    public function getResources()
    {
        if (! $this->resources) {
            $this->resources = Yaml::parse(file_get_contents(__DIR__.'/../etc/resources.yml'));
        }
        return $this->resources;
    }

    public function getMethods()
    {
        return [
            'post' => 'create',
            'get' => ['index', 'read'],
            'put' => 'update',
            'delete' => 'delete',
        ];
    }

    public function configure(Application $app)
    {
        $resources = $this->getResources();
        $methods = $this->getMethods();

        foreach ($resources['resources'] as $resource => $class) {
            foreach ($methods as $method => $action) {
                if (is_array($action)) {
                    if (strpos($resource, '{id}')) {
                        $app->$method($resource, "App\\Controller\\{$class}::{$action[1]}Action");
                    } else {
                        $app->$method($resource, "App\\Controller\\{$class}::{$action[0]}Action");
                    }
                } else {
                    $app->$method($resource, "App\\Controller\\{$class}::{$action}Action");
                }
            }
        }
    }
}