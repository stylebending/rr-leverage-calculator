<?php session_start(); ?>
<?php if (isset($_SESSION['loggedin'])) {
  require 'api/phemex.php';
} ?>
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
                  <a class="nav-link" href="/login.php">Account</a>
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
      <div class="col">
        <?php if (isset($_SESSION['loggedin'])) { ?>
          Phemex server tijd: <?php getServerTime() ?>
          <div class="card shadow-lg text-white mb-3 panel panel-default">
            <h1 class="card-header text-center shadow-lg p-5 panel-heading">
              <p class="float-start"><i class="bi bi-person-fill"></i> Welkom <?php echo $_SESSION['email'] ?></p>
              <a href="database/logout.php" class="btn btn-primary d-inline float-end"><i class="bi bi-box-arrow-right"></i> Log Out</a>
              <a href="addaccount.php" class="btn btn-success d-inline float-end mx-2"><i class="bi bi-plus-lg"></i> Account toevoegen</a>
            </h1>
            <div class="card-body panel-body p-5">
              <div class="row">
                <div class="col border-primary-subtle border-end p-5">
                  <div class="row">
                    <div class="col-8">
                      <h3 class="mb-3">USDT Posities</h3>
                    </div>
                    <div class="col-4">
                      <button class="btn btn-primary mb-3 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClosedPositions" aria-expanded="false" aria-controls="collapseExample">
                        Laden
                      </button>
                    </div>
                  </div>
                  <div class="collapse" id="collapseClosedPositions">
                    <?php getClosedPositions() ?>
                  </div>
                </div>
                <div class="col p-5">
                  <div class="row">
                    <div class="col-8">
                      <h3 class="mb-3">Inverse Posities</h3>
                    </div>
                    <div class="col-4">
                      <button class="btn btn-primary mb-3 float-end" type="button" data-bs-toggle="collapse" data-bs-target="#collapseClosedInversePositions" aria-expanded="false" aria-controls="collapseExample">
                        Laden
                      </button>
                    </div>
                  </div>
                  <div class="collapse" id="collapseClosedInversePositions">
                    <?php getClosedInversePositions() ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>
