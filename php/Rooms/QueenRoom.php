<?php
require_once 'Room.php';
    class QueenRoom extends Room
    {
        function __construct()
        {
            parent::__construct();
            $this->name = RoomsName::IS_QUEEN;
        }


    }
?>