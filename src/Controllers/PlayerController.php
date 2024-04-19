<?php

declare(strict_types=1);


namespace App\Controllers;


use App\Models\PlayersModel;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

class PlayerController
{
    private PlayersModel $model;

    // Here, the parameter is automatically supplied by the Dependency Injection Container based on the type hint
    public function __construct(PlayersModel $model)
    {
        $this->model = $model;
    }

    public function __invoke(RequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
    {
        $id = intval($args['id']);
        $player = $this->model->getPlayerById($id);
        $responseBody = [
            'message' => 'Player successfully retrieved from db.',
            'status' => 200,
            'data' => $player
        ];
        return $response->withJson($responseBody);
    }
}