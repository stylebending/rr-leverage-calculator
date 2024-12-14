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

function groupOrdersIntoTrades($orders)
{
  $trades = [];
  $currentTrade = [];
  $isInTrade = false;
  // Reverse the orders array so that we start from the last order
  $orders = array_reverse($orders);

  foreach ($orders as $order) {
    // Check for an entry order (closedPnlEv == 0)
    if ($order['closedPnlEv'] == 0) {
      // If we were already in a trade, finalize the current trade and start a new one
      if ($isInTrade) {
        $trades[] = $currentTrade;
        $currentTrade = [];
      }

      // Start a new trade with the current entry order
      $isInTrade = true;
    }

    // If we are in a trade, add the current order to the trade
    if ($isInTrade) {
      $currentTrade[] = $order;
    }
  }

  // Add the last trade if it's still open (i.e., there was no subsequent entry order)
  if ($isInTrade) {
    $trades[] = $currentTrade;
  }

  return array_reverse($trades);
}

function groupInverseOrdersIntoTrades($orders)
{
  $trades = [];
  $currentTrade = [];
  $isInTrade = false;
  // Reverse the orders array so that we start from the last order
  $orders = array_reverse($orders);

  foreach ($orders as $order) {
    // Check for an entry order (closedPnlEv == 0)
    if ($order['side'] == $order['posSide']) {
      // If we were already in a trade, finalize the current trade and start a new one
      if ($isInTrade) {
        $trades[] = $currentTrade;
        $currentTrade = [];
      }

      // Start a new trade with the current entry order
      $isInTrade = true;
    }

    // If we are in a trade, add the current order to the trade
    if ($isInTrade) {
      $currentTrade[] = $order;
    }
  }

  // Add the last trade if it's still open (i.e., there was no subsequent entry order)
  if ($isInTrade) {
    $trades[] = $currentTrade;
  }

  return array_reverse($trades);
}

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
            $startMonth = date("m", strtotime("-2 months"));
            $start = mktime($h, $i, $s, $startMonth, $d, $y);
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

            $groupedOrders = groupInverseOrdersIntoTrades($tradeHistory);
            // Voor elke trade
            foreach ($groupedOrders as $trade) {
              // Sort orders in the current trade by transaction time
              usort($trade, function ($a, $b) {
                return $a['updatedAt'] <=> $b['updatedAt']; // Compare transactTimeNs values
              });
              $laatsteOrder = array_key_last($trade);
              $laatsteDatum = round($trade[$laatsteOrder]['updatedAt'] / 1000);
              $lD = date("d-m-Y H:i:s", $laatsteDatum);
              $slGrootte = "";
              $slPrijs = "";
              $tps = [];
              // TODO: er kunnen meerdere stop losses zijn, zoals bij andere todo dus werkend maken voor meerdere entries en sls net als tps
              // Voor elke order
              foreach ($trade as $order) {
                $symbol = $order['symbol'];
                // Als order een entry is
                if ($order['side'] == $order['posSide']) {
                  $entryTransactTimeUnix = round($order['updatedAt'] / 1000);
                  $entryTransactTime = date("d-m-Y H:i:s", $entryTransactTimeUnix);
                  $positieGroottte = $order['execQtyRq'];
                  $entry = round($order['priceRp'], 4);
                  $slArea = round($order['stopPxRp'] / 10000, 2);
                  if ($order['side'] == 1) {
                    $side = "Long";
                    $ogRisk = ((($slArea - $entry) / $entry) * -1) * 100;
                  } else if ($order['side'] == 2) {
                    $side = "Short";
                    $ogRisk = (($slArea - $entry) / $entry) * 100;
                  }
                }
                // Als order een sl is
                if ($order['tradeType'] == 6) {
                  $slGrootte = ($order['execQtyRq'] / $positieGroottte) * 100;
                  $slPrijs = round($order['priceRp'], 4);
                }
                // Als order een tp is
                if ($order['tradeType'] == 7) {
                  $tpPrijs = round($order['priceRp'], 4);
                  $tpGrootte = ($order['execQtyRq'] / $positieGroottte) * 100;
                  $tps[$tpPrijs] = $tpGrootte;
                }
              }

              $rr = 0;
              $wp = 0;
              // TODO: Deze berekening goed checken bij allemaal verschillende trade scenarios
              // voor elk scenaria uitdenken, long, short, win, loss, no tps only sl, only sl no tps
              if ($side == "Long") {
                if (!empty($tps)) {
                  foreach ($tps as $tpP => $tpG) {
                    $wp += ((($tpP - $entry) / $entry) * 100) * ($tpG / 100);
                  }
                }
                if (!empty($slPrijs)) {
                  $slp = $slGrootte / 100;

                  $slToSubstract = ((($slPrijs - $entry) / $entry) * 100) * $slp;
                  $actualWp = $wp + $slToSubstract;

                  // RR = WP% / SL%
                  $rr = round($actualWp / $ogRisk, 2);
                } else {
                  $rr = "Open trade";
                }
              } else if ($side == "Short") {
                if (!empty($tps)) {
                  foreach ($tps as $tpP => $tpG) {
                    $wp += ((($tpP - $entry) / $entry) * 100) * ($tpG / 100) * -1;
                  }
                }
                if (!empty($slPrijs)) {
                  $slp = $slGrootte / 100;

                  $slToSubstract = ((($slPrijs - $entry) / $entry) * 100) * $slp * -1;
                  $actualWp = $wp + $slToSubstract;

                  // RR = WP% / SL%
                  $rr = round($actualWp / $ogRisk, 2);
                } else {
                  $rr = "Open trade";
                }
              }

              // TODO: voor nu 1 entry, 1 sl en meerdere tps, maar iets verzinnen voor trades met meerdere entrie en sls

              echo '<div class="card tCard shadow-lg text-white mb-3">' .
                '<div class="card-header shadow-lg"><div class="row">' . '<h5 class="col text-start">' . $side . '</h5><h5 class="col text-center">' . $symbol . '</h5><h5 class="col text-end">' . $entryTransactTime . '</h5></div>' .
                '</div>' .
                '<div class="card-body row mx-auto">' .
                '<div class="border border-white text-center text-justify shadow-lg text-white rounded p-5 my-5">' .
                '<div class="row">' .
                '<div class="col border-white border-end">' .
                "RR " . "<br>" .
                "<hr>" .
                "SL prijs " . "<br>" .
                "<hr>" .
                "Laatste order " . "<br>" .
                "<hr>" .
                '</div>' .
                '<div class="col">' .
                $rr . "<br>" .
                "<hr>" .
                $slPrijs . "<br>" .
                "<hr>" .
                $lD . "<br>" .
                "<hr>" .
                '</div>' .
                '</div>' .
                "</div>" .
                "</div>" .
                "</div>";
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
                $queryString = "?symbol=BTCUSD&ordStatus=Filled";
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

                $groupedOrders = groupOrdersIntoTrades($tradeHistory);
                // Voor elke trade
                foreach ($groupedOrders as $trade) {
                  // Sort orders in the current trade by transaction time
                  usort($trade, function ($a, $b) {
                    return $a['transactTimeNs'] <=> $b['transactTimeNs']; // Compare transactTimeNs values
                  });
                  $laatsteOrder = array_key_last($trade);
                  $laatsteDatum = round($trade[$laatsteOrder]['transactTimeNs'] / 1000000000);
                  $lD = date("d-m-Y H:i:s", $laatsteDatum);
                  $slGrootte = "";
                  $slPrijs = "";
                  $tps = [];
                  // Voor elke order
                  foreach ($trade as $order) {
                    $symbol = $order['symbol'];
                    // Als order een entry is
                    if ($order['closedPnlEv'] == 0) {
                      $entryTransactTimeUnix = round($order['transactTimeNs'] / 1000000000);
                      $entryTransactTime = date("d-m-Y H:i:s", $entryTransactTimeUnix);
                      $positieGroottte = $order['orderQty'];
                      $entry = round($order['priceEp'] / 10000, 2);
                      $slArea = round($order['stopLossEp'] / 10000, 2);
                      if ($order['side'] === "Buy") {
                        $side = "Long";
                        $ogRisk = ((($slArea - $entry) / $entry) * -1) * 100;
                      } else if ($order['side'] === "Sell") {
                        $side = "Short";
                        $ogRisk = (($slArea - $entry) / $entry) * 100;
                      }
                    }
                    // Als order een sl is
                    if ($order['orderType'] == "Stop") {
                      $slGrootte = ($order['orderQty'] / $positieGroottte) * 100;
                      $slPrijs = round($order['priceEp'] / 10000, 2);
                    }
                    // Als order een tp is
                    if ($order['closedPnlEv'] > 0 && $order['orderType'] == "Limit") {
                      $tpPrijs = round($order['priceEp'] / 10000, 2);
                      $tpGrootte = ($order['orderQty'] / $positieGroottte) * 100;
                      $tps[$tpPrijs] = $tpGrootte;
                    }
                  }

                  $rr = 0;
                  $wp = 0;
                  // TODO: Deze berekening goed checken bij allemaal verschillende trade scenarios
                  // voor elk scenaria uitdenken, long, short, win, loss, no tps only sl, only sl no tps
                  if ($side == "Long") {
                    if (!empty($tps)) {
                      foreach ($tps as $tpP => $tpG) {
                        $wp += ((($tpP - $entry) / $entry) * 100) * ($tpG / 100);
                      }
                    }
                    if (!empty($slPrijs)) {
                      $slp = $slGrootte / 100;

                      $slToSubstract = ((($slPrijs - $entry) / $entry) * 100) * $slp;
                      $actualWp = $wp + $slToSubstract;

                      // RR = WP% / SL%
                      $rr = round($actualWp / $ogRisk, 2);
                    } else {
                      $rr = "Open trade";
                    }
                  } else if ($side == "Short") {
                    if (!empty($tps)) {
                      foreach ($tps as $tpP => $tpG) {
                        $wp += ((($tpP - $entry) / $entry) * 100) * ($tpG / 100) * -1;
                      }
                    }
                    if (!empty($slPrijs)) {
                      $slp = $slGrootte / 100;

                      $slToSubstract = ((($slPrijs - $entry) / $entry) * 100) * $slp * -1;
                      $actualWp = $wp + $slToSubstract;

                      // RR = WP% / SL%
                      $rr = round($actualWp / $ogRisk, 2);
                    } else {
                      $rr = "Open trade";
                    }
                  }

                  // TODO: voor nu 1 entry, 1 sl en meerdere tps, maar iets verzinnen voor trades met meerdere entrie en sls

                  echo '<div class="card tCard shadow-lg text-white mb-3">' .
                    '<div class="card-header shadow-lg"><div class="row">' . '<h5 class="col text-start">' . $side . '</h5><h5 class="col text-center">' . $symbol . '</h5><h5 class="col text-end">' . $entryTransactTime . '</h5></div>' .
                    '</div>' .
                    '<div class="card-body row mx-auto">' .
                    '<div class="border border-white text-center text-justify shadow-lg text-white rounded p-5 my-5">' .
                    '<div class="row">' .
                    '<div class="col border-white border-end">' .
                    "RR " . "<br>" .
                    "<hr>" .
                    "SL prijs " . "<br>" .
                    "<hr>" .
                    "Laatste order " . "<br>" .
                    "<hr>" .
                    '</div>' .
                    '<div class="col">' .
                    $rr . "<br>" .
                    "<hr>" .
                    $slPrijs . "<br>" .
                    "<hr>" .
                    $lD . "<br>" .
                    "<hr>" .
                    '</div>' .
                    '</div>' .
                    "</div>" .
                    "</div>" .
                    "</div>";
                  echo "<br>";
                }
              }
            }
          }
        }
      }
    }
  }
}
