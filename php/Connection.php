<?php

class Connection
{

    static private $APIsList;
    static public function ReadData($apisList){

        self::$APIsList = $apisList;
        $allData = array();
        foreach (self::$APIsList as $api) {
            $result   = json_decode( self::CallAPI('GET',$api));
            foreach ( (array)$result as $elem) {
                array_push($allData, $elem);
            }
        }
        $allData = json_decode(json_encode($allData) , true);
        return $allData;
    }
    static private function CallAPI($method, $url, $data = false)
    {
        $curl = curl_init();

        switch ($method)
        {
            case "POST":
                curl_setopt($curl, CURLOPT_POST, 1);

                if ($data)
                    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
                break;
            case "PUT":
                curl_setopt($curl, CURLOPT_PUT, 1);
                break;
            default:
                if ($data)
                    $url = sprintf("%s?%s", $url, http_build_query($data));
        }

        // Optional Authentication:
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, "username:password");

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($curl);

        curl_close($curl);

        return $result;
    }

}