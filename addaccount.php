<?php session_start() ?>
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
      <div class="col">
        <?php if (isset($_SESSION['loggedin'])) { ?>
          <div class="card shadow-lg text-white mb-3 panel panel-default">
            <h1 class="card-header text-center shadow-lg p-3 panel-heading">
              <i class="bi bi-person-fill"></i> Welkom <?php echo $_SESSION['email'] ?>
              <a href="database/logout.php" class="btn btn-primary d-inline float-end"><i class="bi bi-box-arrow-right"></i> Log Out</a>
              <a href="/" class="btn btn-primary d-inline float-end mx-2"><i class="bi bi-arrow-left"></i> Terug</a>
            </h1>
            <div class="card-body panel-body p-5">
              <?php if (isset($_SESSION['message'])) { ?>
                <div class="row">
                  <div id="loginError" class="alert alert-danger"><?php echo $_SESSION['message'] ?></div>
                  <?php if (isset($_SESSION['message'])) {
                    unset($_SESSION['message']);
                  } ?>
                </div>
              <?php } ?>
              <div class="row">
                <form id="addAccForm" class="p-5 w-50 mx-auto" action="database/doaddaccount.php" method="POST">
                  <div class="row">
                    <label for="apikey" class="text-start">API Key</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                      </div>
                      <input type="text" class="form-control" id="apikey" name="apikey" placeholder="Phemex API Key" required />
                    </div>
                    <label for="password" class="text-start mt-4">API Secret</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <span class="input-group-text"><i class="bi bi-key"></i></span>
                      </div>
                      <input type="text" class="form-control" id="apisecret" name="apisecret" placeholder="Phemex API Seret" required />
                    </div>
                  </div>
                  <div class="row">
                    <button type="submit" class="mt-5 btn btn-success shadow-lg mx-auto">
                      <i class="bi bi-plus-lg"></i> Toevoegen
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <div class="row">
            <div id="loginError" class="alert alert-danger">Log eerst in!</div>
          </div>
        <?php } ?>
      </div>
    </div>
  </div>
  <script src="js/app.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>