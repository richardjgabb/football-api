<?php

declare(strict_types=1);


namespace App\Models;


use PDO;

class LeaguesModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getLeagues(): array
    {
        $query = $this->db->prepare('SELECT * FROM `leagues`');
        $query->execute();
        return $query->fetchAll();
    }

    public function getLeagueById(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM `leagues` WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function getLeagueByName(string $name): array
    {
        $query = $this->db->prepare(
            "SELECT * FROM `leagues` WHERE `name` LIKE :name");
        $query->bindValue(':name', '%'.$name.'%');
        $query->execute();
        return $query->fetchAll();
    }


}