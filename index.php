<!DOCTYPE html>
<html lang="en-US">

<head>
  <title>RR & Leverage Calculator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="RR and Leverage Calculator">
  <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <script src="js/jquery-3.7.1.min.js"></script>
  <script src="js/jquery-ui.min.js"></script>
  <link rel="stylesheet" href="css/bootstrap-icons.min.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/app.css">
</head>

<body class="bg-dark">
  <div class="container text-white p-5 m-5 rounded mx-auto">
    <div class="row">
      <div class="card mx-auto shadow-lg text-white mb-3 panel panel-default">
        <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-person-fill"></i> Log In</h1>
        <div class="card-body panel-body">
          <form id="loginForm" class="p-5 w-50 mx-auto" action="database/connect.php" method="POST">
            <div class="row">
              <label for="email" class="text-start">Email</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                </div>
                <input type="email" class="form-control" id="email" name="email" placeholder="user@email.com" required />
              </div>
              <label for="password" class="text-start mt-4">Wachtwoord</label>
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="bi bi-key"></i></span>
                </div>
                <input type="password" class="form-control" id="password" name="password" placeholder="wachtwoord" required />
              </div>
            </div>
            <div class="row">
              <button type="submit" class="mt-5 btn btn-primary shadow-lg mx-auto">
                <i class="bi bi-box-arrow-in-right"></i> Log In
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <div class="row">
      <div id="draggablePanelList" class="col connectedSortable">
        <div class="card shadow-lg text-white mb-3 panel panel-default">
          <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-currency-exchange"></i> RR</h1>
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
                  <label class="form-check-label" for="rrcheckbox">Fees meenemen in berekening?</label>
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
              <div class="row">
                <p class="mt-5">
                  <i class="bi bi-info-circle"></i> Als je SL meegeeft, gebruik dan de SL knop
                </p>
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
                  <label class="form-check-label" for="levcheckbox">Fees meenemen in berekening?</label>
                </div>
              </div>
              <div class="row p-3">
                <div class="form-check form-switch">
                  <input class="form-check-input" type="checkbox" role="switch" id="kacheckbox" name="kalevfees">
                  <label class="form-check-label" for="kacheckbox">Klein account?</label>
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
    </div>
  </div>
  <script src="js/app.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>
