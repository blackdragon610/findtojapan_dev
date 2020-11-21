<?php
namespace App\Libs;

class GeometryClass
{
    public function fromAddress(string $address)
    {
        //google
        $params = http_build_query(array(
                                       'address'=> $address,
                                       'key'=> configJson("key")["apiKey"]
                                   )
        );

        $base_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=dd';

        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $base_url. $params);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'GET');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($curl);
        return json_decode($response, true);

    }

    public function fromLatlng(float $lat, float $lng) : string
    {
        $keys = configJson("key");

        $latlng = $lat . "," . $lng;
        $area = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?key=" . $keys["apiKey"] . "&language=ja&region=JP&latlng=" . $latlng);
        $areas = json_decode($area);

        if (isset($areas->results[0]->formatted_address)){
            return $areas->results[0]->formatted_address;
        }

        return "";
    }
}
