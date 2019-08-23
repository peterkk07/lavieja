<?php

require_once 'dbConn.php';
require_once 'match.php';
require_once 'jsonUtils.php';
require_once 'laVieja.php';

class game
{
    private $game;
    private $match;

    public function __construct()
    {
        $this->match = new match();
    }

    /**
     * @return false|string
     */
    public function getLatestMatch() {

        $match = $this->match->getLatestMatch();

        //TODO: validate whether match is empty/null or not!
        if($match !== null){
            http_response_code(200);
            $data = (array)$match;
        }else{
            $data = ["message" => "NO_DATA"];
            http_response_code(404);
        }

        return json_encode($data);
    }

    /**
     * @return false|string
     */
    public function getScore() {

        $match = $this->match->getScore();

        //TODO: validate whether match is empty/null or not!
        if($match !== null){
            http_response_code(200);
            $data = (array)$match;
        }else{
            $data = ["message" => "NO_DATA"];
            http_response_code(404);
        }

        return json_encode($data);
    }

    /**
     * @return false|string
     */
    public function getConfig() {

        $match = $this->match->getConfig();

        //TODO: validate whether match is empty/null or not!
        if($match !== null){
            http_response_code(200);
            $data = (array)$match;
        }else{
            $data = ["message" => "NO_DATA"];
            http_response_code(404);
        }

        return json_encode($data);
    }

    /**
     * @return false|string|null
     */
    public function createMatch() {
        $method = $_SERVER['REQUEST_METHOD'];
        if($method === 'POST') {

            $data = [];
            $data['match_round'] = $_POST['match_round'];
            $data['match_status'] = $_POST['match_status'];
            $data['match_winner'] = $_POST['match_winner'];
            $data['current_player'] = $_POST['current_player'];
            $data['a1'] = $_POST['a1'];
            $data['a2'] = $_POST['a2'];
            $data['a3'] = $_POST['a3'];
            $data['b1'] = $_POST['b1'];
            $data['b2'] = $_POST['b2'];
            $data['b3'] = $_POST['b3'];
            $data['c1'] = $_POST['c1'];
            $data['c2'] = $_POST['c2'];
            $data['c3'] = $_POST['c3'];

            $match =  $this->match->saveMatch($data);

            //TODO: validate whether match is empty/null or not!
            if($match !== null){
                http_response_code(200);
                $data = (array)$match;
            }else{
                $data = ["message" => "ERROR_CREATING"];
                http_response_code(500);
            }

            return json_encode($data);
        }

        return null;
    }

    /**
     * @return false|string
     */
    public function updateMatch() {

        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $matchId = $_POST['match_id'];
            $data = [];
            $data['match_round'] = $_POST['match_round'];
            $data['match_status'] = $_POST['match_status'];
            $data['match_winner'] = $_POST['match_winner'];
            $data['current_player'] = $_POST['current_player'];
            $data['a1'] = $_POST['a1'];
            $data['a2'] = $_POST['a2'];
            $data['a3'] = $_POST['a3'];
            $data['b1'] = $_POST['b1'];
            $data['b2'] = $_POST['b2'];
            $data['b3'] = $_POST['b3'];
            $data['c1'] = $_POST['c1'];
            $data['c2'] = $_POST['c2'];
            $data['c3'] = $_POST['c3'];

            $game = new laVieja($data, $data['match_round'],$data['match_winner']);

            $game->processMatch($data['current_player'],$data['match_round']);

            $data['match_round'] = $game->turn;
            $data['match_status'] = $game->status;
            $data['match_winner'] = $game->winner;
            $data['current_player'] = $game->currentPiece;
            $data['updated'] = date("Y/m/d h:i");

            $match =  $this->match->updateMatch($matchId,$data);

            if($match !== null){
                http_response_code(200);
                $response = (array)$match;
            }else{
                $response = ["error" => "ERROR_UPDATING"];
                http_response_code(500);
            }

            return json_encode($response);
        }
    }

    /**
     * @return false|string
     */
    public function updateConfig() {
        $method = $_SERVER['REQUEST_METHOD'];

        if($method === 'POST') {
            $data = [];
            $data['colour'] = $_POST['colour'];

            $match =  $this->match->saveConfig($data);

            if($match !== null){
                http_response_code(200);
                $response = (array)$match;
            }else{
                $response = ["error" => "ERROR_UPDATING"];
                http_response_code(500);
            }

            return json_encode($response);
        }
    }
}