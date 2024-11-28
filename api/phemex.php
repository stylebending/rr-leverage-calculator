<?php

include 'models/Trade.php';

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
            $requestPath = "/api-data/g-futures/closedPosition";
            $queryString = "?currency=USDT";
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
            function hasMinusSign($value)
            {
              return (substr(strval($value), 0, 1) == "-");
            }

            $trades = [];

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
              $tRoi = round($tradeData['roi'], 2);
              $tLeverage = $tradeData['leverage'];
              // TODO: Risk en RR berekeningen werken niet, ROI is winst op positiegrootte?
              if ($tClosedPnlRv != 0 && $tRoi != 0) {
                $tRr = round($tradeData['roi'] * 100, 2);
              } else {
                $tRr = "";
              }

              $wlColor = "";

              if (hasMinusSign($tClosedPnlRv)) {
                $wl = "Loss";
                $wlColor = "bg-danger bg-opacity-75 ";
              } else {
                $wl = "Win";
                $wlColor = "bg-success bg-opacity-75 ";
              }


              $trade = new Trade();
              $trade->setSymbol($tSymbol);
              $trade->setDirection($tSide);
              $trade->setWinLoss($wl);
              $trade->setOpenDate($tOpenDate);
              $trade->setCloseDate($tUpdateDate);
              $trade->setLeverage($tLeverage);
              $trade->setPositionSize($tClosedSize);
              $trade->setEntry($tOpenPrice);
              $trade->setExit($tClosePrice);
              $trade->setFees($tExchangeFeeRv);
              $trade->setFunding($tFundingFeeRv);
              $trade->setClosedPnl($tClosedPnlRv);
              $trade->setRoi($tRoi);
              $trade->setRr($tRr);

              $trades[] = $trade;

              echo '<div class="card tCard ' . $wlColor . 'shadow-lg text-white mb-3">' .
                '<div class="card-header shadow-lg"><div class="row">' . '<h5 class="col text-start">' . $tSide . '</h5><h5 class="col text-center">' . $tSymbol . '</h5><h5 class="col text-end">' . $wl . '</h5></div>' .
                '<div class="row">' . '<h5 class="col text-start">' . $tOpenDate . '</h5> | <h5 class="col text-end">' . $tUpdateDate . '</h5></div></div>' .
                '<div class="card-body row mx-auto">' .
                '<div class="border border-white text-center text-justify shadow-lg text-white rounded p-5 my-5">' .
                '<div class="row">' .
                '<div class="col border-white border-end">' .
                "Leverage: " . "<br>" .
                "<hr>" .
                "Positiegrootte: " . "<br>" .
                "<hr>" .
                "Entry: " . "<br>" .
                "<hr>" .
                "Exit: " . "<br>" .
                "<hr>" .
                "Fees: " . "<br>" .
                "<hr>" .
                "Funding: " . "<br>" .
                "<hr>" .
                "Gesloten PnL: " . "<br>" .
                "<hr>" .
                "ROI: " . "<br>" .
                "<hr>" .
                "RR " . "<br>" .
                "<hr>" .
                '</div>' .
                '<div class="col">' .
                $tLeverage . " X" . "<br>" .
                "<hr>" .
                "$ " . $tClosedSize . "<br>" .
                "<hr>" .
                "$ " . $tOpenPrice . "<br>" .
                "<hr>" .
                "$ " . $tClosePrice . "<br>" .
                "<hr>" .
                "$ " . $tExchangeFeeRv . "<br>" .
                "<hr>" .
                "$ " . $tFundingFeeRv . "<br>" .
                "<hr>" .
                "$ " . $tClosedPnlRv . "<br>" .
                "<hr>" .
                $tRoi * 100 . " " . "%" . "<br>" .
                "<hr>" .
                $tRr . "<br>" .
                "<hr>" .
                '</div>' .
                '</div>' .
                "RR klopt waarschijnlijk niet!<br>" .
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
                $tradeHistory = $responseData['data'];
                var_dump($tradeHistory);
                die();
              }
            }
          }
        }
      }
    }
  }
}
