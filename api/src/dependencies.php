<?php

use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // view renderer
    $container['renderer'] = function ($c) {
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // monolog
    $container['logger'] = function ($c) {
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };

    // DB connection
    $container['db'] = function ($c) {
        $capsule = new \Illuminate\Database\Capsule\Manager;
        $capsule->addConnection($c->get('settings')['db']);

        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        return $capsule;
    };

    // Response not found
    $container['notFoundHandler'] = function ($c) {
        return function ($request, $response) use ($c) {
            return $response->withJson([
                'status_code' => 400,
                'error' => 'not_found',
            ], 404);
        };
    };
};
