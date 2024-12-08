<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>RR & Leverage Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="RR and Leverage Calculator">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <script src="js/app.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap-icons.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css">
</head>

<body class="bg-dark">
  <div class="container text-white p-5 m-5 rounded mx-auto">
    <nav class="navbar navbar-dark bg-dark fixed-top shadow-lg">
      <div class="container-fluid">
        <a class="navbar-brand" href="/">Simple Trading</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
          <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">Simple Trading</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body">
            <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="/">Home</a>
              </li>
              <?php if (!isset($_SESSION['loggedin'])) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/login.php">Login</a>
                </li>
              <?php } else if (isset($_SESSION['loggedin'])) { ?>
                <li class="nav-item">
                  <a class="nav-link" href="/account.php">Account</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/database/logout.php">Logout</a>
                </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </div>
    </nav>
    <div class="row">
      <div id="draggablePanelList" class="col connectedSortable">
        <div class="card shadow-lg text-white mb-3 panel panel-default">
          <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-calculator-fill"></i> RR</h1>
          <div class="card-body panel-body">
            <form id="my-form" class="p-5">
              <div class="row">
                <div id="error" class="d-none alert alert-danger"></div>
              </div>
              <div class="row">
                <div id="resdata" class="d-none alert alert-info"></div>
              </div>
              <div class="row">
                <label for="entry" class="text-start">Entry</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="63250" id="entry" name="entry" step=".0001" min="0.0001" required />
                </div>
                <label for="sl" class="text-start mt-4">Stop Loss</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-percent"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="0.33" id="sl" name="sl" step=".0001" min="0.0001" required />
                </div>
              </div>
              <div class="row p-3 mt-4">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="rrcheckbox" name="fees" checked>
                  <label class="form-check-label" for="rrcheckbox">Fees meenemen in berekening</label>
                </div>
              </div>
              <div class="row">
                <div class="fields grid row-gap-2 m-3">
                </div>
              </div>
              <div class="row">
                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                  <i class="bi bi-plus-slash-minus"></i> RR Berekenen
                </button>
                <button type="button" class="add-fields m-2 btn btn-success shadow-lg">
                  <i class="bi bi-plus-lg"></i> TP Toevoegen
                </button>
                <button type="button" class="add-fields-sl m-2 btn btn-danger shadow-lg">
                  <i class="bi bi-plus-lg"></i> SL Toevoegen
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="draggablePanelList2" class="col connectedSortable">
        <div class="card shadow-lg text-white mb-3 panel panel-default">
          <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-crosshair"></i> Leverage</h1>
          <div class="card-body panel-body">
            <form id="lev-form" class="p-5">
              <div class="row" id="levrow">
                <div class="row">
                  <div id="levdata" class="d-none alert alert-info"></div>
                </div>
                <label for="risk" class="text-start">Risk</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-percent"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="1" id="risk" name="risk" step=".0001" min="0.0001" required />
                </div>
                <label for="stoploss" class="text-start mt-4">Stop Loss</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-percent"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="0.33" id="stoploss" name="stoploss" step=".0001" min="0.0001" required />
                </div>
              </div>
              <div class="row p-3 mt-4">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="levcheckbox" name="levfees" checked>
                  <label class="form-check-label" for="levcheckbox">Fees meenemen in berekening</label>
                </div>
              </div>
              <div class="row p-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="kacheckbox" name="kalevfees">
                  <label class="form-check-label" for="kacheckbox">Klein account</label>
                </div>
              </div>
              <div class="row">
                <div class="m-3"></div>
              </div>
              <div class="row">
                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                  <i class="bi bi-plus-slash-minus"></i> Leverage Berekenen
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div id="draggablePanelList3" class="col connectedSortable">
        <div class="card shadow-lg text-white mb-3 panel panel-default">
          <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-currency-exchange"></i> TPs</h1>
          <div class="card-body panel-body">
            <form id="tp-form" class="p-5">
              <div class="row" id="tprow">
                <div id="tpdata" class="d-none alert alert-info"></div>
              </div>
              <div class="row">
                <label for="positiegrootte" class="text-start">Positiegrootte</label>
                <div class="input-group">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                  </div>
                  <input type="number" class="form-control" placeholder="1000" id="positiegrootte" name="positiegrootte" step=".0001" min="0.0001" required />
                </div>
              </div>
              <div class="row">
                <div class="tpfields grid row-gap-2 m-3">
                </div>
              </div>
              <div class="row">
                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                  <i class="bi bi-plus-slash-minus"></i> TPs Berekenen
                </button>
                <button type="button" class="add-tp-fields m-2 btn btn-success shadow-lg">
                  <i class="bi bi-plus-lg"></i> TP Toevoegen
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>

</html>
