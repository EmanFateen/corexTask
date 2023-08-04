<?php
require_once 'Room.php';
    class HalfBoardRoom extends Room
    {
        function __construct()
        {
            parent::__construct();

            $this->name = RoomsName::IS_HALF_BOARD;
        }


    }
?>