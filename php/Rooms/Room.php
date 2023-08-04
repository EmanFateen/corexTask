<?php
include_once 'RoomsName.php';


    abstract class Room
    {
        protected $code, $name, $price, $taxes, $totalPrice;

        function __construct()
        {

        }

        /*
         * setter and getter for code
         * */
        public function setCode($code){
            if(isset($code))
                $this->code = $code;
        }
        public function getCode(){
            return $this->code;
        }

        /*
        * setter and getter for name
        * */
        public function setName($name){
            if(isset($name))
                $this->name = $name;
        }
        public function getName(){
            return $this->name;
        }

        /*
        * setter and getter for price
        * */
        public function setPrice($price){
            if(isset($price))
                $this->price = $price;
        }
        public function getPrice(){
            return $this->price;
        }

        /*
        * setter and getter for total price
        * */
        public function setTotalPrice($totalPrice){
            if(isset($totalPrice))
                $this->totalPrice = $totalPrice;
        }
        public function getTotalPrice(){
            return $this->totalPrice;
        }

        /*
        * setter and getter for total price
        * */
        public function setTaxes($taxes){
            $this->taxes = $taxes;
        }
        public function getTaxes(){
            return $this->taxes;
        }

        static private function getRoomType($givenRoomCode){

            if(in_array($givenRoomCode,  RoomsType::IS_SINGLE))
            {
                return RoomsType::IS_SINGLE;
            }
            else if(in_array($givenRoomCode, RoomsType::IS_DOUBLE))
            {
                return RoomsType::IS_DOUBLE;
            }
            else if( in_array($givenRoomCode,  RoomsType::IS_QUEEN ))
            {
                return RoomsType::IS_QUEEN;
            }
            else if( in_array($givenRoomCode,  RoomsType::IS_LUXURY ))
            {
               return RoomsType::IS_LUXURY;
            }
            else if(in_array($givenRoomCode,  RoomsType::IS_DOUBLE_TWIN ))
            {
                return RoomsType::IS_DOUBLE_TWIN;
            }
            else if( in_array($givenRoomCode, RoomsType::IS_HALF_BOARD ))
            {
                return RoomsType::IS_HALF_BOARD;
            }
            else if( in_array($givenRoomCode,  RoomsType::IS_FULL_BOARD ))
            {
                return RoomsType::IS_FULL_BOARD;
            }
            else if( in_array($givenRoomCode,  RoomsType::IS_POA ))
            {
                return RoomsType::IS_POA;
            }


        }

        static public function RoomExist($rooms, $givenRoom)
        {
            $givenRoomType = self::getRoomType($givenRoom['code']);
            foreach ($rooms as $hotelRoom) {
                if(in_array($hotelRoom->getCode(),$givenRoomType))
                    return true;
            }
            return false;
        }
        static public function checkAndChange($rooms, $givenRoom)
        {

            $index = self::getMinRoom($rooms,$givenRoom);
            // given room has lower price
            if(isset($index))
            {
                $rooms[$index]->setPrice(Operation::wrappingPrice($givenRoom));
                $rooms[$index]->setTaxes(Operation::wrappingTaxes($givenRoom));
                $rooms[$index]->setTotalPrice(Operation::wrappingTotalPrice($givenRoom));
            }
            // will not change
            return $rooms;
        }
        static public function getMinRoom($rooms,$givenRoom)
        {
            $givenRoomType = self::getRoomType($givenRoom['code']);
            foreach ($rooms as $index=> $hotelRoom) {
                if(in_array($hotelRoom->getCode(),$givenRoomType)) {
                    if ($hotelRoom->getTotalPrice() <= Operation::wrappingTotalPrice($givenRoom))
                        return null;
                    return $index;
                }
            }
        }

    }
?>