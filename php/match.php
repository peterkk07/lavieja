<?php

require_once 'dbConn.php';

class match
{
    private $conn;

    public function __construct()
    {
        $this->conn = new dbConn();
    }

    /**
     * @param $result
     * @return stdClass
     */
    public function mapMatch($result) {
        $match = new stdClass();
        $match->id = $result['id'];
        $match->match_round = $result['match_round'];
        $match->match_status = $result['match_status'];
        $match->match_winner = $result['match_winner'];
        $match->current_player = $result['current_player'];
        $match->a1 = $result['a1'];
        $match->a2 = $result['a2'];
        $match->a3 = $result['a3'];
        $match->b1 = $result['b1'];
        $match->b2 = $result['b2'];
        $match->b3 = $result['b3'];
        $match->c1 = $result['c1'];
        $match->c2 = $result['c2'];
        $match->c3 = $result['c3'];

        return $match;
    }

    /**
     * @param $result
     * @return stdClass
     */
    public function mapConfig($result) {
        $config = new stdClass();
        $config->id = $result['id'];
        $config->colour = $result['colour'];

        return $config;
    }

    /**
     * @return stdClass|null
     */
    public function getLatestMatch()
    {
        try {
            $query = 'SELECT * FROM `match` ORDER BY `id` DESC LIMIT 1';
            $result = $this->conn->read($query);
            if($result !== false){
                return $this->mapMatch($result);
            }
            return null;
        }catch (Exception $e){
            return null;
        }
    }

    /**
     * @return array|null
     */
    public function getScore() {
        try {

            $query = 'SELECT * FROM `match` WHERE match_status = "FINISH" AND `match_winner` <> "N" ORDER BY `id` DESC LIMIT 5';
            $result = $this->conn->multipleRead($query);

            if($result !== false){
                return $result;
            }
            return null;
        }catch (Exception $e){
            return null;
        }
    }

    /**
     * @return mixed|null
     */
    public function getConfig() {
        try {

            $query = 'SELECT * FROM `config` ORDER BY `id` DESC LIMIT 1';
            $result = $this->conn->read($query);

            if($result !== false){
                return $result;
            }
            return null;
        }catch (Exception $e){
            return null;
        }
    }

    /**
     * @param $id
     * @return stdClass|null
     */
    public function getMatchById($id) {
        try {
            $query = 'SELECT * FROM `match` WHERE `id`=' .$id. ';';
            $result = $this->conn->read($query);
            if($result !== false){
                return $this->mapMatch($result);
            }
            return null;

        }catch (Exception $e){
            return null;
        }
    }

    /**
     * @param $id
     * @return stdClass|null
     */
    public function getConfigById($id) {
        try {
            $query = 'SELECT * FROM `config` WHERE `id`=' .$id. ';';
            $result = $this->conn->read($query);
            if($result !== false){
                return $this->mapConfig($result);
            }
            return null;

        }catch (Exception $e){
            return null;
        }
    }

    /**
     * @param $matchId
     * @param $data
     * @return stdClass|null
     */
    public function updateMatch($matchId, $data) {
        $query = $this->conn->buildUpdateQueryById("match", $matchId, $data);
        $result = $this->conn->execute($query);
        if($result !== false){
            return $this->getMatchById($matchId);
        }
        return null;
    }

    /**
     * @param $data
     * @return stdClass|string|null
     */
    public function saveMatch($data) {
        $query = $this->conn->buildInsertQuery("match", $data);
        $result = $this->conn->insert($query);
        if($result !== null){
            return $this->getMatchById($result);
        }
        return $result;
    }

    /**
     * @param $data
     * @return stdClass|string|null
     */
    public function saveConfig($data) {
        $query = $this->conn->buildInsertQuery("config", $data);
        $result = $this->conn->insert($query);
        if($result !== null){
            return $this->getConfigById($result);
        }
        return $result;
    }
}