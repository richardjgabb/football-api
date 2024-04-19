<?php

declare(strict_types=1);


namespace App\Models;


use PDO;

class PlayersModel
{
    protected PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function getPlayers(): array
    {
        $query = $this->db->prepare('SELECT * FROM `players`');
        $query->execute();
        return $query->fetchAll();
    }

    public function getPlayerById(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM `players` WHERE `id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch();
    }

    public function getPlayersByTeamId(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT * FROM `players` WHERE `team` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPlayersByLeagueId(int $id): array
    {
        $query = $this->db->prepare(
            'SELECT `players`.`id`, `players`.`name`, `age`, `position`, `team`, `teams`.`league`  FROM `players` 
         INNER JOIN `teams` ON `teams`.`id` = `players`.`team`
         INNER JOIN `leagues` ON `leagues`.`id` = `teams`.`league`
         WHERE `leagues`.`id` = :id');
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPlayersByTeamAndLeagueId(int $teamId, int $leagueId): array
    {
        $query = $this->db->prepare(
            'SELECT `players`.`id`, `players`.`name`, `age`, `position`, `team`, `teams`.`league`  FROM `players` 
         INNER JOIN `teams` ON `teams`.`id` = `players`.`team`
         INNER JOIN `leagues` ON `leagues`.`id` = `teams`.`league`
         WHERE `leagues`.`id` = :leagueId AND `teams`.`id` = :teamId');
        $query->bindParam(':leagueId', $leagueId);
        $query->bindParam(':teamId', $teamId);
        $query->execute();
        return $query->fetchAll();
    }

    public function getPlayerByName(string $name): array
    {
        $query = $this->db->prepare(
            "SELECT * FROM `players` WHERE `name` LIKE :name");
        $query->bindValue(':name', '%'.$name.'%');
        $query->execute();
        return $query->fetchAll();
    }
}