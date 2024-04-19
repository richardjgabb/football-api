<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\TeamsModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class TeamsController
{
    private TeamsModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(TeamsModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $params = $request->getQueryParams();
        if ($params['name']) {
            $name = $params['name'];
            $teams = $this->model->getTeamByName($name);
        } elseif (isset($args['leagueId'])) {
            $id = intval($args['leagueId']);
            $teams = $this->model->getTeamsByLeagueId($id);
        } else {
            $teams = $this->model->getTeams();
            }
        $responseBody = [
            'message' => 'Teams successfully retrieved from db.',
            'status' => 200,
            'data' => $teams
        ];
        return $response->withJson($responseBody);
    }
}