<?php

declare(strict_types=1);


namespace App\Models;


use PDO;

class TeamsModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getTeams(): array
    {
        $query = $this->db->prepare('SELECT * FROM `teams`');
        $query->execute();
        return $query->fetchAll();
    }

    public function getTeamById(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM `teams` WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function getTeamsByLeagueId(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM `teams` WHERE `league` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll();
    }

    public function getTeamByName(string $name): array
    {
        $query = $this->db->prepare(
            "SELECT * FROM `teams` WHERE `name` LIKE :name");
        $query->bindValue(':name', '%'.$name.'%');
        $query->execute();
        return $query->fetchAll();
    }


}