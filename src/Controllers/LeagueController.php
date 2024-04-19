<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\LeaguesModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class LeagueController
{
    private LeaguesModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(LeaguesModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = intval($args['id']);
        $league = $this->model->getLeagueById($id);
        $responseBody = [
            'message' => 'League successfully retrieved from db.',
            'status' => 200,
            'data' => $league
        ];
        return $response->withJson($responseBody);
    }
}