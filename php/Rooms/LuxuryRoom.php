<?php

require_once 'Room.php';
    class LuxuryRoom extends Room
    {
        function __construct()
        {
            parent::__construct();

            $this->name = RoomsName::IS_LUXURY;
        }

    }
?>