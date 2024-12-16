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
          <div class="float-start" data-bs-theme="dark">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="d-flex">
              <select class="form-select" name="selectedAccount">
                <?php
                // Assuming you have an array of accounts stored in $phemexAccounts
                foreach (getPhemexNames() as $account) {
                  echo "<option value='" . htmlspecialchars($account) . "'>" . htmlspecialchars($account) . "</option>";
                }
                ?>
              </select>
              <input type="submit" value="Selecteer Account" class="btn btn-outline-primary m-3">
            </form>
          </div>
          <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-outline-danger d-inline float-end mx-2 mt-3"><i class="bi bi-person-x-fill"></i> Account verwijderen</button>
          <!-- Modal -->
          <div data-bs-theme="dark" class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel">Account verwijderen</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <p class="mb-5">Selecteer het account dat je wil verwijderen</p>
                  <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="w-75 mx-auto">
                    <select class="form-select mb-5" name="selectedAccountToDelete">
                      <?php
                      // Assuming you have an array of accounts stored in $phemexAccounts
                      foreach (getPhemexNames() as $account) {
                        echo "<option value='" . htmlspecialchars($account) . "'>" . htmlspecialchars($account) . "</option>";
                      }
                      ?>
                    </select>
                    <input type="submit" value="Verwijderen" class="btn btn-danger">
                  </form>
                </div>
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
          <button data-bs-toggle="modal" data-bs-target="#exampleModal2" class="btn btn-outline-success d-inline float-end mx-2 mt-3"><i class="bi bi-person-plus-fill"></i> Account toevoegen</button>
          <!-- Modal -->
          <div data-bs-theme="dark" class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModal2Label" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModal2Label">Account toevoegen</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form id="addAccForm" class="w-75 mx-auto" action="database/doaddaccount.php" method="POST">
                    <div class="row">
                      <label for="apikey" class="text-start">Phemex API Key</label>
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-text"><i class="bi bi-key"></i></span>
                        </div>
                        <input type="text" class="form-control" id="apikey" name="apikey" placeholder="Phemex API Key" required />
                      </div>
                      <label for="apisecret" class="text-start mt-4">Phemex API Secret</label>
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
                <div class="modal-footer">
                </div>
              </div>
            </div>
          </div>
        </h1>
        <div class="card-body panel-body p-5">
          <?php if (isset($_SESSION['currentAccount'])) { ?>
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
                    <h3 class="mb-3">BTC Inverse Posities</h3>
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
          <?php } ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
<?php require('footer.php'); ?>
