    <?php require('header.php'); ?>
    <?php require('navbar.php'); ?>
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
    <?php require('footer.php'); ?>
