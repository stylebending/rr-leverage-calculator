<?php

function getServerTime()
{
  $context = stream_context_create([
    'http' => [
      'method' => 'GET',
    ]
  ]);
  $response = file_get_contents('https://api.phemex.com/public/time', false, $context);
  $responseData = json_decode($response, true);
  $serverTime = date("d-m-Y | H:i:s", round($responseData['data']['serverTime'] / 1000));
  echo $serverTime;
}
