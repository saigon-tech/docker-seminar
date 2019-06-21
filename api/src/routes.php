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

            // Response json data
            return $response->withJson([
                'status_code' => 200,
                'postal_code' => rand(7000000, 900000),
            ], 200);
        });


        $app->get('/yuubin/get/{postalCode}', function (Request $request, Response $response, array $args) use ($container) {
            // Log message
            $container->get('logger')->info("Route '/yuubin/get' start");

            // Response json data
            return $response->withJson([
                'status_code' => 200,
                'postal_code' => $args['postalCode'],
            ], 200);
        });
    });
};
