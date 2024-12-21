<div class="navbar sticky top-0 z-50 bg-base-300 rounded-box shadow-xl">
  <div class="navbar-start">
    <div class="dropdown">
      <div tabindex="0" role="button" class="btn btn-ghost lg:hidden">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          class="h-5 w-5"
          fill="none"
          viewBox="0 0 24 24"
          stroke="currentColor">
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            stroke-width="2"
            d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
      </div>
      <ul
        tabindex="0"
        class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
        <li><a href="/#freetools">Free Tools</a></li>
        <?php if (!isset($_SESSION['loggedin'])) { ?>
          <li><a href="/#features">Features</a></li>
          <li><a href="/#pricing">Pricing</a></li>
          <li><a href="/login.php">Login / Signup</a></li>
        <?php } ?>
        <?php if (isset($_SESSION['loggedin'])) { ?>
          <li><a href="/dashboard.php">Dashboard</a></li>
          <li><a href="/database/logout.php">Logout</a></li>
        <?php } ?>
      </ul>
    </div>
    <a href="/" class="btn btn-ghost text-xl">Buff My Trades</a>
  </div>
  <div class="navbar-center hidden lg:flex">
    <ul class="menu menu-horizontal px-1">
      <li><a href="/#freetools">Free Tools</a></li>
      <?php if (!isset($_SESSION['loggedin'])) { ?>
        <li><a href="/#features">Features</a></li>
        <li><a href="/#pricing">Pricing</a></li>
        <li><a href="/login.php">Login / Signup</a></li>
      <?php } ?>
      <?php if (isset($_SESSION['loggedin'])) { ?>
        <li><a href="/dashboard.php">Dashboard</a></li>
        <li><a href="/database/logout.php">Logout</a></li>
      <?php } ?>
    </ul>
  </div>
  <div class="navbar-end">
  </div>
</div>
