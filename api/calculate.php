<?php

// Check if everything neccessary is set
if (isset($_GET['entry']) && isset($_GET['sl'])) {
  // Setting entry, sl and sl as tp into variables
  $entry = $_GET['entry'];
  $sl = $_GET['sl'];
  // Check fees included or not and set to variable and unset from GET superglobal
  if (isset($_GET['fees'])) {
    $fees = $_GET['fees'];
    unset($_GET['fees']);
  }
  // Check sl included or not and set to variable and unset from GET superglobal
  if (isset($_GET['tp-sl-input']) && isset($_GET['tpp-sl-input'])) {
    $sltp = $_GET['tp-sl-input'];
    unset($_GET['tp-sl-input']);
    $sltpp = $_GET['tpp-sl-input'] / 100;
    unset($_GET['tpp-sl-input']);
  }

  // Remove Entry and SL from the GET superglobal
  unset($_GET['entry']);
  unset($_GET['sl']);

  // Define Tp arrays and wp (profit percentage)
  $tpArr = [];
  $tppArr = [];
  $result = [];
  $wp = 0;
  $tpArrNrO = [];
  $noTps = 0;

  // Check whether TPs are given
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tp-input')) {
      $noTps += 1;
    }
  }

  // Fill tpArrNrO
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tp-input')) {
      array_push($tpArrNrO, (float)$value);
    }
  }

  // Fill tpArr
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tp-input')) {
      array_push($tpArr, ((($value - $entry) / $entry) * 100));
    }
  }

  // Fill tppArr
  foreach ($_GET as $key => $value) {
    if (str_contains($key, 'tpp-input')) {
      array_push($tppArr, ($value / 100));
    }
  }
  
  // Multiply tpArr and tppArr
  foreach ($tpArr as $key => $value) {
    $result[$key] = $value * $tppArr[$key];
  }

  // If it's a long handle calculations whether it's a win or loss
  if (isset($tpArrNrO[0]) && $tpArrNrO[0] > floatval($entry)) {
    // If no fees
    if (!isset($fees)) {
      // Calculate total profit percentage witout sl
      if (!isset($sltp) && !isset($sltpp)) {
        if (array_sum($result) > 0) {
          // If it's a win
         $wp = array_sum($result);
        } else {
          // If it's a loss
          $wp = array_sum($result) * -1;
        }
      } else {
        // Calculate total profit percentage with sl
       if ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) > 0) {
         // If it's a win
        $wp = (array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp));
       } else {
         //  If it's a loss
         $wp = (array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp));
       }
      }
      // Calculate final RR
      $rr = $wp / $sl;
    } else if ($fees == "on") {
      // If with fees
      // Calculate total profit percentage witout sl
      if (!isset($sltp) && !isset($sltpp)) {
        if (array_sum($result) > 0) {
          // If it's a win
         $wp = array_sum($result);
        } else {
          //  If it's a loss
          $wp = (array_sum($result) * -1);
        }
      } else {
        // Calculate total profit percentage with sl
       if ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) > 0) {
         //  If it's a win
        $wp = (array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp));
      } else {
       //  If it's a loss
       $wp = ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)));
      }
      }
      // Calculate final RR
      $rr = $wp / ($sl + 0.07);    
    }
  }

  // If it's a short handle calculations whether it's a win or loss
   if (isset($tpArrNrO[0]) && $tpArrNrO[0] < floatval($entry)) {
     // If no fees
     if (!isset($fees)) {
       // Calculate total profit percentage witout sl
       if (!isset($sltp) && !isset($sltpp)) {
        if (array_sum($result) < 0) {
          // If it's a win
         $wp = abs(array_sum($result));
        } else {
          // If it's a loss
          $wp = array_sum($result) * -1;
        }
       } else {
         // Calculate total profit percentage with sl
        if ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) < 0) {
          // If it's a win
         $wp = abs((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)));
        } else {
          //  If it's a loss
          $wp = (array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) * -1;
        }
       }
       // Calculate final RR
       $rr = $wp / $sl;
     } else if ($fees == "on") {
       // If with fees
       // Calculate total profit percentage witout sl
       if (!isset($sltp) && !isset($sltpp)) {
        if (array_sum($result) < 0) {
          // If it's a win
         $wp = abs(array_sum($result));
        } else {
          //  If it's a loss
          $wp = (array_sum($result) * -1);
        }
       } else {
         // Calculate total profit percentage with sl
        if ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) < 0) {
          //  If it's a win
         $wp = abs((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)));
       } else {
        //  If it's a loss
        $wp = ((array_sum($result) + (((($sltp - $entry) / $entry) * 100) * $sltpp)) * -1);
       }
       // Calculate final RR
       $rr = $wp / ($sl + 0.07);   
     }
    }
  }

  // If no TPs are given but a SL is given
  if ($noTps === 0 && isset($sltp) && isset($sltpp)) {
    // If it's a long
    if ($sltp < $entry) {
      // Without fees
      if (!isset($fees)) {
        $wp = ((($sltp - $entry) / $entry) * 100) * ($sltpp);
      } else {
        // With fees
        $wp = (((($sltp - $entry) / $entry) * 100) * ($sltpp));
      }
      // Calculate final RR
      $rr = $wp / $sl; 
    } else {
      // If it's a short
      // Without fees
      if (!isset($fees)) {
        $wp = ((($sltp - $entry) / $entry) * 100) * ($sltpp) * -1;
      } else {
        // With fees
        $wp = (((($sltp - $entry) / $entry) * 100) * ($sltpp) * -1);
      }
      // Calculate final RR
      $rr = $wp / ($sl + 0.07); 
    }
  }

  // Return JSON response
  if (array_sum($tppArr) >= 0.0001 && array_sum($tppArr) <= 1) {
    echo json_encode([
      'resdata' => true,
      'wp' => round($wp, 2),
      'rr' => round($rr, 2)
    ]);
  } else if (isset($sltp) && isset($sltpp)) {
    echo json_encode([
      'resdata' => true,
      'wp' => round($wp, 2),
      'rr' => round($rr, 2)
    ]);
  } else {
    // Return error message that the TP percentage must sum up to a number between 0.01 en 100
    echo json_encode(['error' => 'Voer TPs in met het totaal van de TPs % tussen de 0.01% en 100% of vul een SL als TP in.']);
  }
} else if (isset($_GET['risk']) && isset($_GET['stoploss'])) {
  // Handle the leverage request/response 
  if (isset($_GET['levfees'])) {
    $levfees = $_GET['levfees'];
    unset($_GET['levfees']);
  }
  if (!isset($levfees)) {
    $leverage = round(($_GET['risk'] / $_GET['stoploss']), 2);
    echo json_encode([
      'levdata' => true,
      'lev' => $leverage
    ]);
  } else if ($levfees == "on") {
    $leverage = round(($_GET['risk'] / ($_GET['stoploss'] + 0.07)), 2);
    echo json_encode([
      'levdata' => true,
      'lev' => $leverage
    ]);
  }
} else {
  // If all the fields are not set return an error message
  echo json_encode(['error' => 'Er is iets fout gegaan, voeg één of meerdere TPs toe, vul alle velden in en probeer het opnieuw.']);
}
