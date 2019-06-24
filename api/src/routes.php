<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->group('/api/v1', function () use ($app, $container) {

        $app->get('/yuubin/random', function (Request $request, Response $response, array $args) use ($container) {
            // Log message
            $container->get('logger')->info("Route '/yuubin/random' start");

            // Random yuubin
            $postalCode = $container->get('db')->table('postal_codes');
            $limit = $postalCode->count();
            $yuubin = $postalCode->skip(rand(0, $limit - 1))->take(1)->first();
            if (!is_null($yuubin)) {
                unset($yuubin->id);
                $log = $container->get('db')->table('logs');
                $log->insert([
                    'time' => date("Y-m-d H:i:s"),
                    'postal_code' => $yuubin->postal_code,
                    'api' => '/yuubin/random',
                ]);
            }

            // Response json data
            return $response->withJson([
                'status_code' => 200,
                'postal_code' => $yuubin,
            ], 200);
        });


        $app->get('/yuubin/get/{postalCode}', function (Request $request, Response $response, array $args) use ($container) {
            // Log message
            $container->get('logger')->info("Route '/yuubin/get' start");

            // Query yuubin
            $postalCode = $container->get('db')->table('postal_codes');
            $yuubin = $postalCode->where('postal_code', $args['postalCode'])->first();
            if (!is_null($yuubin)) {
                unset($yuubin->id);
                $log = $container->get('db')->table('logs');
                $log->insert([
                    'time' => date("Y-m-d H:i:s"),
                    'postal_code' => $yuubin->postal_code,
                    'api' => '/yuubin/get',
                ]);
            }

            // Response json data
            return $response->withJson([
                'status_code' => 200,
                'yuubin' => $yuubin,
            ], 200);
        });
    });
};
