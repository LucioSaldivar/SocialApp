<?php
declare(strict_types=1);

namespace SocialApp\Processors;

use function GuzzleHttp\json_encode;

class SendDataUrl
{
    public function cUrlInsert(array $data)
    {
        $curl = curl_init();

        \curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://609928bd99011f00171403fb.mockapi.io/ratings',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        echo $response;
    }
}