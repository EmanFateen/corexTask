<?php
require_once 'Room.php';
    class FullBoardRoom extends Room
    {
        function __construct()
        {
            parent::__construct();

            $this->name = RoomsName::IS_FULL_BOARD;
        }


    }
?>