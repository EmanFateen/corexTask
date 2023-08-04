<?php

require_once 'Room.php';
    class POARoom extends Room
    {
        function __construct()
        {
            parent::__construct();
            $this->name = RoomsName::IS_POA;
        }


    }
?>