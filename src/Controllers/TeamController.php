<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\TeamsModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class TeamController
{
    private TeamsModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(TeamsModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = intval($args['id']);
        $team = $this->model->getTeamById($id);
        $responseBody = [
            'message' => 'Team successfully retrieved from db.',
            'status' => 200,
            'data' => $team
        ];
        return $response->withJson($responseBody);
    }
}