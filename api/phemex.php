<?php

function connectDB()
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
  return [
    'pdo' => $pdo,
    'cipher_algo' => $cipher_algo,
    'key' => $key
  ];
}

function hasMinusSign($value)
{
  return (substr(strval($value), 0, 1) == "-");
}

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

function getClosedPositions()
{
  $connection = connectDB();
  // gebruiker accounts ophalen dus van db en foreach key value pair decrypten en api call maken
  $stmt = $connection['pdo']->prepare('SELECT apiks FROM users WHERE email = :email');
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
            $actKey = openssl_decrypt($dbkey, $connection['cipher_algo'], $connection['key']);
            $actSec = openssl_decrypt($value, $connection['cipher_algo'], $connection['key']);
            $now = time();
            $h = date("H", $now);
            $i = date("i", $now) + 1;
            $s = date("s", $now);
            $m = date("m", $now);
            $d = date("d", $now);
            $y = date("Y", $now);
            $expiry = mktime($h, $i, $s, $m, $d, $y);
            // TODO: de m-2 hieronder hele jaar door werkend maken
            $start = mktime($h, $i, $s, $m - 2, $d, $y);
            $requestPath = "/exchange/order/v2/orderList";
            $queryString = "?currency=USDT&ordStatus=7&start=" . $start . "000" . "&end=" . $now . "000" . "&offset=0&limit=200";
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
            $tradeHistory = $responseData['data'];

            foreach ($tradeHistory as $trade => $tradeData) {
              $actDateUnix = round($tradeData['createdAt'] / 1000);
              $actUpdateUnix = round($tradeData['updatedAt'] / 1000);
              $openDate = date("d-m-Y H:i:s", $actDateUnix);
              $updateDate = date("d-m-Y H:i:s", $actUpdateUnix);
              $symbol = $tradeData['symbol'];
              if ($tradeData['side'] === 1) {
                $side = "Long";
              } else if ($tradeData['side'] === 2) {
                $side = "Short";
              }
              $execOrderPrice = round($tradeData['execPriceRp'], 4);
              $execOrderQty = $tradeData['execQtyRq'];
              if ($tradeData['ordType'] == 0) {
                $ordType = "Liquidatie";
              } else if ($tradeData['ordType'] == 1) {
                $ordType = "Market";
              } else if ($tradeData['ordType'] == 2) {
                $ordType = "Limit";
              } else if ($tradeData['ordType'] == 3) {
                $ordType = "Stop";
              } else if ($tradeData['ordType'] == 4) {
                $ordType = "StopLimit";
              } else if ($tradeData['ordType'] == 5) {
                $ordType = "MarketIfTouched";
              } else if ($tradeData['ordType'] == 6) {
                $ordType = "LimitIfTouched";
              }
              if ($tradeData['tradeType'] == 1) {
                $tradeType = "Trade";
              } else if ($tradeData['tradeType'] == 4) {
                $tradeType = "Funding";
              } else if ($tradeData['tradeType'] == 6) {
                $tradeType = "LiqTrade";
              } else if ($tradeData['tradeType'] == 7) {
                $tradeType = "AdlTrade";
                $tradeType = $tradeData['tradeType'];
              }

              echo '<div class="card tCard shadow-lg text-white mb-3">' .
                '<div class="card-header shadow-lg"><div class="row">' . '<h5 class="col text-start">' . $side . '</h5><h5 class="col text-center">' . $symbol . '</h5><h5 class="col text-end">' . $updateDate . '</h5></div>' .
                '</div>' .
                '<div class="card-body row mx-auto">' .
                '<div class="border border-white text-center text-justify shadow-lg text-white rounded p-5 my-5">' .
                '<div class="row">' .
                '<div class="col border-white border-end">' .
                "Ordergrootte " . "<br>" .
                "<hr>" .
                "Orderprijs " . "<br>" .
                "<hr>" .
                "Ordertype " . "<br>" .
                "<hr>" .
                "Tradetype " . "<br>" .
                "<hr>" .
                '</div>' .
                '<div class="col">' .
                "$ " . $execOrderQty . "<br>" .
                "<hr>" .
                "$ " . $execOrderPrice . "<br>" .
                "<hr>" .
                $ordType . "<br>" .
                "<hr>" .
                $tradeType . "<br>" .
                "<hr>" .
                '</div>' .
                '</div>' .
                "</div>" .
                "</div>" .
                "</div>";
              echo "<br>";
              echo "<br>";
            }
          }
        }
      }
    }
    function getClosedInversePositions()
    {
      $connection = connectDB();
      // gebruiker accounts ophalen dus van db en foreach key value pair decrypten en api call maken
      $stmt = $connection['pdo']->prepare('SELECT apiks FROM users WHERE email = :email');
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
                $actKey = openssl_decrypt($dbkey, $connection['cipher_algo'], $connection['key']);
                $actSec = openssl_decrypt($value, $connection['cipher_algo'], $connection['key']);
                $now = time();
                $h = date("H", $now);
                $i = date("i", $now) + 1;
                $s = date("s", $now);
                $m = date("m", $now);
                $d = date("d", $now);
                $y = date("Y", $now);
                $expiry = mktime($h, $i, $s, $m, $d, $y);
                $requestPath = "/exchange/order/list";
                $queryString = "?symbol=BTCUSD";
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
                $tradeHistory = $responseData['data']['rows'];
                foreach ($tradeHistory as $trade => $tradeData) {
                  if ($tradeData['ordStatus'] == "Filled") {
                    $actDateUnix = round($tradeData['actionTimeNs'] / 1000000000);
                    $tOpenDate = date("d-m-Y H:i:s", $actDateUnix);
                    $actDateUnix2 = round($tradeData['transactTimeNs'] / 1000000000);
                    $tOpenDate2 = date("d-m-Y H:i:s", $actDateUnix2); // DIT IS DE ECHTE TIJD WAAROP ORDER IS DOORGEGAAN
                    $tGroupID = $tradeData['orderID'];
                    echo round($tradeData['priceEp'] / 10000, 2) . " " . $tOpenDate  . " " . $tOpenDate2 . " " . $tGroupID . "<br>";
                  }
                }
              }
            }
          }
        }
      }
    }
  }
}
