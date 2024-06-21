<?php

namespace Alice\Animeland\Model;

use Alice\Animeland\Database\Database;
use PDO;
use PDOException;

class EpisodeModel {
    private PDO $conn;
    private $table = 'episode';

    private const COL_EPISODE_NUMBER = 'episode_number';
    private const COL_DURATION = 'duration';
    private const COL_TITLE = 'title';
    private const COL_SYNOPSIS = 'synopsis';
    private const COL_AIRED = 'aired';
    private const COL_ANIME_ID = 'anime_id';

    public function __construct() {
        $this->conn = Database::getConn();
    }

    public function createEpisode(
        $episodeNumber = 0,
        $duration = '00:00',
        $title = '',
        $synopsis = '',
        $aired = '1970-01-01',
        $animeId = null
    ): bool {
        try {
            $query = 'INSERT INTO ' . $this->table . ' (' . self::COL_EPISODE_NUMBER . ', ' . self::COL_DURATION . ', ' . self::COL_TITLE . ', ' . self::COL_SYNOPSIS . ', ' . self::COL_AIRED . ', ' . self::COL_ANIME_ID . ') ' .
                'VALUES(:episode_number, :duration, :title, :synopsis, :aired, :anime_id)';
    
            $stmt = $this->conn->prepare($query);
    
           // Bind Parameters
            $stmt->bindParam(':episode_number', $episodeNumber, PDO::PARAM_INT);
            $stmt->bindParam(':duration', $duration, PDO::PARAM_STR);
            $stmt->bindParam(':title', $title, PDO::PARAM_STR);
            $stmt->bindParam(':synopsis', $synopsis, PDO::PARAM_STR);
            $stmt->bindParam(':aired', $aired, PDO::PARAM_STR);
            $stmt->bindParam(':anime_id', $animeId, PDO::PARAM_INT);
    
            // Execute the query
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
    
    public function getAllByAnimeId(int $animeId): array {
        try {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . self::COL_ANIME_ID . ' = :anime_id';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':anime_id', $animeId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return [];
        }
    }
    
    public function getAnimeEpisodeById(int $animeId, int $episode): ?array {
        try {
            $query = 'SELECT * FROM ' . $this->table . ' WHERE ' . self::COL_ANIME_ID . ' = :anime_id AND ' . self::COL_EPISODE_NUMBER . ' = :episode_number';
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':anime_id', $animeId, PDO::PARAM_INT);
            $stmt->bindParam(':episode_number', $episode, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
            return null;
        }
    }
}
