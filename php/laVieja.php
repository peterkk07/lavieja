<?php

require_once 'dbConn.php';

class laVieja
{
    private $match;

    public $spaces = array(
        'A1' => null,
        'B1' => null,
        'C1' => null,
        'A2' => null,
        'B2' => null,
        'C2' => null,
        'A3' => null,
        'B3' => null,
        'C3' => null
    );

    public $victory_conditions = array(
        array('A1', 'B1', 'C1'),
        array('A2', 'B2', 'C2'),
        array('A3', 'B3', 'C3'),
        array('A1', 'A2', 'A3'),
        array('B1', 'B2', 'B3'),
        array('C1', 'C2', 'C3'),
        array('A1', 'B2', 'C3'),
        array('A3', 'B2', 'C1')
    );

    public $players = array(
        'X' => 'X',
        'O' => 'O'
    );

    public $turn = 0;
    public $winner = 'N';
    public $currentPiece = 'X';
    public $status = 'IN_PROGRESS';

    public function __construct($matchData, $matchTurn, $matchWinner)
    {
        $this->populateBoard($matchData);
        $this->turn = $matchTurn;
        $this->winner = $matchWinner;
    }

    public function populateBoard($data)
    {
        $this->spaces['A1'] = $data['a1'];
        $this->spaces['B1'] = $data['b1'];
        $this->spaces['C1'] = $data['c1'];
        $this->spaces['A2'] = $data['a2'];
        $this->spaces['B2'] = $data['b2'];
        $this->spaces['C2'] = $data['c2'];
        $this->spaces['A3'] = $data['a3'];
        $this->spaces['B3'] = $data['b3'];
        $this->spaces['C3'] = $data['c3'];
    }

    public function matchHasWinner()
    {
        return (!in_array($this->winner,['N','D']));
    }

    //check the match status: if a player occupies cells in VC, wins
    //otherwise, up the turn.
    //if turns reach 8, then it's a draw
    public function processMatch($playerPiece, $currentTurn)
    {
        $this->turn = $currentTurn;
        $player_occupied_spaces = $this->getCellsForPlayer($playerPiece);

        foreach ($this->victory_conditions as $vc) {
            if ($vc === array_intersect($vc, $player_occupied_spaces)) {
                $this->winner = $playerPiece;
                $this->status = 'FINISH';
            }
        }

        if ($this->status == 'IN_PROGRESS' && $this->turn >= 8) {
            $this->winner = 'N'; //NONE!
            $this->status = 'DRAW'; //DRAW!
            $this->turn++;
        }else{
            $this->currentPiece = $playerPiece === 'X' ? 'O' : 'X';
            $this->turn++;
        }
    }

    /**
     * @param $player
     * @return array
     */
    public function getCellsForPlayer($player)
    {
        return array_keys($this->spaces, $player);
    }

}