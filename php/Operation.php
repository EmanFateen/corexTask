<?php

include 'Taxes/Tax.php';
class Operation{


    static public function wrappingPrice($payload)
    {
        if(isset($payload['net_rate'])) {
            return $payload['net_rate'];
        }
        else if(isset($payload['net_price'])) {
            return $payload['net_price'];
        }

    }

    static public function wrappingTotalPrice($payload)
    {
        if(isset($payload['total'])) {
            return $payload['total'];
        }
        else if(isset($payload['totalPrice'])) {
            return $payload['totalPrice'];
        }

    }


    static public function wrappingTaxes($givenTaxes)
    {
        $taxes = array();
        if(isset($givenTaxes['taxes'])) {

            if (count($givenTaxes['taxes']) == count($givenTaxes['taxes'], COUNT_RECURSIVE)) {
                $tax = new Tax();
                $tax->setAmount($givenTaxes['taxes']['amount']);
                $tax->setCurrency($givenTaxes['taxes']['currency']);
                $tax->setType($givenTaxes['taxes']['type']);
                array_push($taxes, $tax);
            }
            else{
                foreach ($givenTaxes['taxes'] as $elem) {
                    //print_r($givenTaxes);

                    $tax = new Tax();
                    $tax->setAmount($elem['amount']);
                    $tax->setCurrency($elem['currency']);
                    $tax->setType($elem['type']);
                    array_push($taxes, $tax);
                }
            }

            return $taxes;
        }
        return null;


    }

}


?>