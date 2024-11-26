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
            $now = time();
            $h = date("H", $now);
            $i = date("i", $now) + 1;
            $s = date("s", $now);
            $m = date("m", $now);
            $d = date("d", $now);
            $y = date("Y", $now);
            $expiry = mktime($h, $i, $s, $m, $d, $y);
            $symbol = "BTCUSD";
            $currency = "USDT";
            $start = mktime($h, $i, $s, $m - 1, $d, $y);
            $end = $now;
            $offset = 0;
            $limit = 100;
            // TODO: https://phemex-docs.github.io/#query-open-orders-by-symbol-2
            $requestPath = "/exchange/order/v2/orderList";
            $queryString = "?currency=" . $currency . "&start=" . $start . "&end=" . $end . "&offset=" . $offset . "&limit=" . $limit;
            $stringToHash = $requestPath . substr($queryString, 1) . $expiry;
            $signature = hash_hmac('sha256', $stringToHash, $actSec);
            $context = stream_context_create([
              'http' => [
                'method' => 'GET',
                'header' => [
                  'Content-Type: application/json',
                  'x-phemex-access-token: ' . $actKey,
                  'x-phemex-request-expiry: ' . $expiry,
                  'x-phemex-request-signature: ' . $signature
                ],
              ]
            ]);
            $response = file_get_contents('https://api.phemex.com' . $requestPath . $queryString, false, $context);
            $responseData = json_decode($response, true);
            var_dump($responseData);
            die();
            $tradeHistory = $responseData['data'];
            foreach ($tradeHistory as $trade => $tradeData) {
              $actDateUnix = round($tradeData['updatedTimeNs'] / 1000000000);
              $actDate = date("d-m-Y H:i:s", $actDateUnix);
              $deze = $tradeData['symbol'];
              var_dump($actDate);
              echo "<br>";
              var_dump($deze);
            }
          }
        }
      }
    }
  }
}
