<?php

include 'Operation.php';
include 'Connection.php';

include 'Hotels/Hotel.php';

    class main
    {
        static private $hotels = [];
        public function buildHotels($payload){
            foreach ($payload as $elem)
            {

                $currentHotelIndex = Hotel::isExist(self::$hotels,$elem['name']);
                if ( !isset($currentHotelIndex))
                {
                    $hotel = new Hotel();
                    $hotel->setName($elem['name']);
                    $hotel->setStars($elem['stars']);
                    array_push(self::$hotels,$hotel);
                    $currentHotelIndex = count(self::$hotels) -1 ;
                }
                if(isset($elem['rooms'])) {
                    self::$hotels[$currentHotelIndex]->appendRooms($elem['rooms']);
                }
            }
        }
        public function showHotels()
        {
            foreach(self::$hotels as $hotel) {
                    $sortedRooms = $hotel->sortRooms("DESC");
                    print ('Hotel Name: ' . $hotel->getName().'<br>');
                    print ('Hotel Star: ' . $hotel->getStars().'<br>');
                    print ('Hotel Rooms:'.'<br>');
                    foreach ($sortedRooms as $room)
                    {
                            print ( str_repeat('&nbsp;', 5).'Room Code: '.$room->getCode().'<br>');
                            print ( str_repeat('&nbsp;', 5).'Room Name: '.$room->getName().'<br>');
                            print ( str_repeat('&nbsp;', 5).'Room Price: '.$room->getPrice().'<br>');

                            foreach ($room->getTaxes() as $tax)
                            {
                                print (str_repeat('&nbsp;', 8).'tax amount: '.$tax->getAmount().'<br>');
                                print (str_repeat('&nbsp;', 8).'tax currency: '.$tax->getCurrency().'<br>');
                                print (str_repeat('&nbsp;', 8).'tax type: '.$tax->getType().'<br>');

                            }
                            print ( str_repeat('&nbsp;', 5).'Room Total Price: '.$room->getTotalPrice().'<br>');

                        print ('<br>');
                    }
                print ('<br>');
                }

        }

    }


    $givenAPIs = $_POST['apis'];

    if(isset($givenAPIs)) {
        $APIs = explode('$END$',$givenAPIs);
        $payload = Connection::ReadData($APIs);
        $main = new main();
        $main->buildHotels($payload);
        $main->showHotels();
    }

?>