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

// TODO: functie getAccounts maken om daarop getClosedTrades te callen in de view indien nodig

function getClosedTrades()
{
  $con = "sqlite:database/database.sqlite";
  $cipher_algo = 'AES-256-CBC';
  $key = 'fejJoPDtzZF7u6gwGYzS8QOIRK0A8c0r';

  try {
    $pdo = new PDO($con);
  } catch (PDOException $e) {
    echo $e->getMessage();
  }

  $pdo = new PDO($con);
  // gebruiker accounts ophalen dus van db en foreach key value pair decrypten en api call maken
  $stmt = $pdo->prepare('SELECT apiks FROM users WHERE email = :email');
  $stmt->execute([
    ':email' => $_SESSION['email']
  ]);
  $apiks = $stmt->fetchAll();
  foreach ($apiks as $newapiks) {
    $dbapiks = $newapiks['apiks'];
    if ($dbapiks !== null) {
      $explodeddbapiks = explode('}', $dbapiks);
      foreach ($explodeddbapiks as $explodeddbkey => $value) {
        $valuetodecode = json_decode($value . "}");
        if ($valuetodecode !== null) {
          foreach ($valuetodecode as $dbkey => $value) {
            $actKey = openssl_decrypt($dbkey, $cipher_algo, $key);
            $actSec = openssl_decrypt($value, $cipher_algo, $key);
            echo $actKey;
            echo "<br>";
            echo $actSec;
            echo "<br>";
            $now = time();
            $h = date("H", $now);
            $i = date("i", $now);
            $s = date("s", $now);
            $m = date("m", $now);
            $d = date("d", $now);
            $y = date("Y", $now);
            $expiry = mktime($h, $i, $s, $m, $d, $y);
            // TODO: API CALLS GELUKT!!! nu moeten we de juiste request path en string vinden, deze hieronder nu geven alle ingegeven orders ipv alleen echte orders denk ik
            $requestPath = "/exchange/public/nomics/trades";
            $queryString = "?market=BTCUSD&since=0-0-0";
            $stringToHash = $requestPath . $queryString . $expiry;
            $context = stream_context_create([
              'http' => [
                'method' => 'GET',
                'header' => [
                  'x-phemex-access-token:' . $actKey,
                  'x-phemex-request-expiry:' . $expiry,
                  'x-phemex-request-signature:' . hash_hmac('sha256', $stringToHash, $actSec)
                ],
              ]
            ]);
            $response = file_get_contents('https://api.phemex.com' . $requestPath . $queryString, false, $context);
            $responseData = json_decode($response, true);
            $tradeHistory = $responseData['data'];
            foreach ($tradeHistory as $trade => $tradeData) {
              $timestamp = $tradeData['timestamp'];
              echo $timestamp . "<br>";
            }
          }
        }
      }
    }
  }
}
