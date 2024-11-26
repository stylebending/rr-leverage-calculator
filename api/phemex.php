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
            // TODO: OP PHEMEX API GITHUB (TAB STAAT OPEN) STAAT GOEIE LOGICA VOOR IF ERROR OF NIET, OVERNEMEN
            // TODO: de $m - 1 hieronder heel het jaar door werkend maken
            // TODO: https://phemex-docs.github.io/#query-closed-positions
            $requestPath = "/api-data/g-futures/closedPosition";
            $queryString = "";
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
              $actDateUnix = round($tradeData['openedTimeNs'] / 1000);
              $actUpdateUnix = round($tradeData['updatedTimeNs'] / 1000);
              $tOpenDate = date("d-m-Y H:i:s", $actDateUnix);
              $tUpdateDate = date("d-m-Y H:i:s", $actUpdateUnix);
              $tSymbol = $tradeData['symbol'];
              if ($tradeData['side'] === 1) {
                $tSide = "Long";
              } else if ($tradeData['side'] === 2) {
                $tSide = "Short";
              }
              $tOpenPrice = round($tradeData['openPrice'], 4);
              $tClosePrice = round($tradeData['closePrice'], 4);
              $tClosedSize = $tradeData['closedSizeRq'];
              $tClosedPnlRv = round($tradeData['closedPnlRv'], 2);
              $tExchangeFeeRv = round($tradeData['exchangeFeeRv'], 2);
              $tFundingFeeRv = round($tradeData['fundingFeeRv'], 2);
              $tRoi = round($tradeData['roi'], 2) * 100;
              $tLeverage = $tradeData['leverage'];
              echo "Datum geopened: " . $tOpenDate . "<br>" .
                "Datum gesloten: " . $tUpdateDate . "<br>" .
                "Pair: " . $tSymbol . "<br>" .
                "Richting: " . $tSide . "<br>" .
                "Prijs geopened: "  . "$ " . $tOpenPrice . "<br>" .
                "Prijs gesloten: "  . "$ " . $tClosePrice . "<br>" .
                "Positiegrootte: "  . "$ " . $tClosedSize . "<br>" .
                "Gesloten PnL: " . "$ " . $tClosedPnlRv . "<br>" .
                "Fees betaald: " . "$ " . $tExchangeFeeRv . "<br>" .
                "Funding betaald: " . "$ " . $tFundingFeeRv . "<br>" .
                "ROI: " . $tRoi . " " . "%" . "<br>" .
                "Leverage: " . $tLeverage;
              echo "<br>";
              echo "<br>";
            }
          }
        }
      }
    }
  }
}