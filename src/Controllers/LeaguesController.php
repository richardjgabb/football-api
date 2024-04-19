<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\LeaguesModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class LeaguesController
{
    private LeaguesModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(LeaguesModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response): ResponseInterface
    {
        $params = $request->getQueryParams();
        if ($params['name']){
            $name = $params['name'];
            $leagues = $this->model->getLeagueByName($name);
        } else {
            $leagues = $this->model->getLeagues();
        }
        $responseBody = [
            'message' => 'Leagues successfully retrieved from db.',
            'status' => 200,
            'data' => $leagues
        ];
        return $response->withJson($responseBody);
    }
}