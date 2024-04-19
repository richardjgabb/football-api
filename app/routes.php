<?php
declare(strict_types=1);

use App\Controllers\LeagueController;
use App\Controllers\LeaguesController;
use App\Controllers\PlayerController;
use App\Controllers\PlayersController;
use App\Controllers\TeamController;
use App\Controllers\TeamsController;
use Slim\App;
use Slim\Views\PhpRenderer;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $container = $app->getContainer();

    //demo code - two ways of linking urls to functionality, either via anon function or linking to a controller

    $app->get('/', function ($request, $response, $args) use ($container) {
        $renderer = $container->get(PhpRenderer::class);
        return $renderer->render($response, "index.php", $args);
    });

    $app->get('/leagues', LeaguesController::class);
    $app->get('/teams', TeamsController::class);
    $app->get('/players', PlayersController::class);
    $app->get('/leagues/{id}', LeagueController::class);
    $app->get('/teams/{id}', TeamController::class);
    $app->get('/players/{id}', PlayerController::class);
    $app->get('/leagues/{leagueId}/teams', TeamsController::class);
    $app->get('/teams/{teamId}/players', PlayersController::class);
    $app->get('/leagues/{leagueId}/players', PlayersController::class);
    $app->get('/leagues/{leagueId}/teams/{teamId}/players', PlayersController::class);
};
