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
      <div class="col">
        <?php if (!isset($_SESSION['loggedin'])) { ?>
          <div class="card shadow-lg text-white mb-3 panel panel-default">
            <h1 class="card-header text-center shadow-lg p-3 panel-heading"><i class="bi bi-person-fill"></i> Log In</h1>
            <div class="card-body panel-body">
              <?php if (isset($_SESSION['message'])) { ?>
                <div class="row">
                  <div id="loginError" class="alert alert-danger"><?php echo $_SESSION['message'] ?></div>
                  <?php if (isset($_SESSION['message'])) {
                    unset($_SESSION['message']);
                  } ?>
                </div>
              <?php } ?>
              <?php if (isset($_SESSION['success'])) { ?>
                <div class="row">
                  <div id="loginSuccess" class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
                  <?php if (isset($_SESSION['success'])) {
                    unset($_SESSION['success']);
                  } ?>
                </div>
              <?php } ?>
              <form id="loginForm" class="p-5 w-50 mx-auto" action="database/login.php" method="POST">
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
                <div class="row p-3 mt-4">
                  <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="registercheckbox" name="registercheckbox">
                    <label class="form-check-label" for="registercheckbox">Registreren</label>
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
        <?php } ?>
      </div>
    </div>
  </div>
</body>

</html>
