<?php require('header.php'); ?>
<?php
if (isset($_SESSION['loggedin']) !== true) {
  header('Location: login.php');
  exit();
}
?>
<?php require('navbar.php'); ?>
<?php if (isset($_SESSION['loggedin'])) {
  require_once('api/phemex.php');
} ?>
<div class="row">
  <div class="col">
    <?php if (isset($_SESSION['loggedin'])) { ?>
      <div class="card shadow-lg text-white mb-3 panel panel-default">
        <h1 class="card-header text-center shadow-lg p-5 panel-heading">
          <p class="float-start"><i class="bi bi-person-fill"></i> Welkom <?php echo $_SESSION['email'] ?></p>
          <a href="addaccount.php" class="btn btn-success d-inline float-end mx-2"><i class="bi bi-plus-lg"></i> Account toevoegen</a>
        </h1>
        <div class="card-body panel-body p-5">
          <div class="row mb-5">
            <div data-bs-theme="dark">
              <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <select class="form-select" name="selectedAccount">
                  <?php
                  // Assuming you have an array of accounts stored in $phemexAccounts
                  foreach (getPhemexNames() as $account) {
                    echo "<option value='" . htmlspecialchars($account) . "'>" . htmlspecialchars($account) . "</option>";
                  }
                  ?>
                </select>
                <input type="submit" value="Selecteer Account" class="btn btn-primary mt-3 mb-3">
              </form>
            </div>
          </div>
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
                <?php getClosedPositions(); ?>
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
                <?php getClosedInversePositions(); ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<?php require('footer.php'); ?>
