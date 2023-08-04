<?php

include_once 'RoomsType.php';
include 'Rooms/SingleRoom.php';
include 'Rooms/DoubleRoom.php';
include 'Rooms/DoubleTwinRoom.php';
include 'Rooms/FullBoardRoom.php';
include 'Rooms/HalfBoardRoom.php';
include 'Rooms/LuxuryRoom.php';
include 'Rooms/QueenRoom.php';
include 'Rooms/POARoom.php';

class Hotel
    {
        private $rooms;
        private $name;
        private $stars;
        function __construct() {
            $this->rooms = array();
        }

        /*
         * setter and getter for name
         * */
        public function setName($name){
            $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }


        /*
         * setter and getter for stars
         * */
        public function setStars($stars){
            $this->stars = $stars;
        }
        public function getStars(){
            return $this->stars;
        }
        public function getRooms(){
            return $this->rooms;
        }


        private function newRoom($payload)
        {
            if(in_array($payload['code'],  RoomsType::IS_SINGLE))
            {
                $room = new SingleRoom();
            }
            else if(in_array($payload['code'],  RoomsType::IS_DOUBLE))
            {
                $room = new DoubleRoom();
            }
            else if( in_array($payload['code'],  RoomsType::IS_QUEEN ))
            {
                $room = new QueenRoom();
            }
            else if( in_array($payload['code'],  RoomsType::IS_LUXURY ))
            {
                $room = new LuxuryRoom();
            }
            else if(in_array($payload['code'],  RoomsType::IS_DOUBLE_TWIN ))
            {
                $room = new DoubleTwinRoom();
            }
            else if( in_array($payload['code'], RoomsType::IS_HALF_BOARD ))
            {
                $room = new HalfBoardRoom();
            }
            else if( in_array($payload['code'],  RoomsType::IS_FULL_BOARD ))
            {
                $room = new FullBoardRoom();
            }
            else if( in_array($payload['code'],  RoomsType::IS_POA ))
            {
                $room = new POARoom();
            }


            return $room;
        }

        private function addRoom($givenRoom)
        {

            $room = self::newRoom($givenRoom);

            if($room) {
                $room->setCode($givenRoom['code']);
                $room->setPrice(Operation::wrappingPrice($givenRoom));
                $room->setTaxes(Operation::wrappingTaxes($givenRoom));
                $room->setTotalPrice(Operation::wrappingTotalPrice($givenRoom));

                array_push($this->rooms, $room);
            }

        }

        public function appendRooms($payload)
        {
            foreach($payload as $givenRoom) {
                if(!Room::RoomExist($this->rooms,$givenRoom))
                   self::addRoom($givenRoom);
                else
                    $this->rooms = Room::checkAndChange($this->rooms,$givenRoom);
            }
            return $this->rooms;
        }

        public function sortRooms($sortingType)
        {
            $roomsTotalPrice = array();
            $sortedRooms = $this->rooms;

            foreach ($sortedRooms as $key => $row)
            {
                $roomsTotalPrice[$key] = $row->getTotalPrice();
            }

            if($sortingType == 'DESC')
                array_multisort($roomsTotalPrice, SORT_DESC, $sortedRooms);
            else
                array_multisort($roomsTotalPrice, SORT_ASC, $sortedRooms);

            return $sortedRooms;
        }


        static public function isExist($hotels, $name)
        {
            foreach ($hotels as $index=>$hotel) {
                if($hotel->getName($name) == $name)
                {
                    return $index;
                }
            }
            return null;
        }
    }
?>