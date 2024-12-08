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