<?php

    class Tax

    {
        private $amount, $currency , $type;

        /*
       * setter and getter for name
       * */
        public function setAmount($amount){
            if(isset($amount))
                $this->amount = $amount;
        }
        public function getAmount(){
            return $this->amount;
        }
        /*
       * setter and getter for name
       * */
        public function setCurrency($currency){
            if(isset($currency))
                $this->currency = $currency;
        }
        public function getCurrency(){
            return $this->currency;
        }
        /*
       * setter and getter for name
       * */
        public function setType($type){
            if(isset($type))
                $this->type = $type;
        }
        public function getType(){
            return $this->type;
        }

    }
?>