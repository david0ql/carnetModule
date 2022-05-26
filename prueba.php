<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://172.16.7.85:9091/endpoint/carnet/eyJhbGciOiJIUzI1NiJ9.amRnb21lemRlbGdhZG9AdXRzLmVkdS5jbw.BDwPAKLJq3GrXf3TwxrHPzfdaKNinP1hj-xGPP49iBg',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($curl);
var_dump($response);
curl_close($curl);
echo $response;

