<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\PlayersModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class PlayersController
{
    private PlayersModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(PlayersModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $params = $request->getQueryParams();
        if ($params['name']) {
            $name = $params['name'];
            $players = $this->model->getPlayerByName($name);
        }elseif ((isset($args['teamId'])) && (isset($args['leagueId']))) {
            $teamId = intval($args['teamId']);
            $leagueId = intval($args['leagueId']);
            $players = $this->model->getPlayersByTeamAndLeagueId($teamId, $leagueId);
        } elseif (isset($args['teamId'])){
            $id = intval($args['teamId']);
            $players = $this->model->getPlayersByTeamId($id);
        } elseif (isset($args['leagueId'])) {
            $id = intval($args['leagueId']);
            $players = $this->model->getPlayersByLeagueId($id);
        } else {
            $players = $this->model->getPlayers();
        }
        $responseBody = [
            'message' => 'Players successfully retrieved from db.',
            'status' => 200,
            'data' => $players
        ];
        return $response->withJson($responseBody);
    }
}