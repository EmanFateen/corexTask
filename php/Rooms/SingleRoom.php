<?php

require_once 'Room.php';
    class SingleRoom extends Room
    {
        function __construct()
        {
            parent::__construct();
            $this->name = RoomsName::IS_SINGLE;
        }

    }
?>