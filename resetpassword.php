    <?php require('header.php'); ?>
    <?php
    if (isset($_SESSION['loggedin']) == true) {
      header('Location: dashboard.php');
      exit();
    }
    ?>
    <?php require('navbar.php'); ?>
    <div class="section" id="resetpw">
      <div class="flex flex-col justify-center h-full">
        <div class="flex space-x-5 place-content-center">
          <?php if (!isset($_SESSION['loggedin'])) { ?>
            <div class="card bg-base-300 shadow-xl flex flex-col grow">
              <h1 class="card-header card-title flex place-content-center shadow-xl p-3">
                <svg fill="#ffffff" xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 52 52" enable-background="new 0 0 52 52" xml:space="preserve">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <g>
                      <path d="M42,23H10c-2.2,0-4,1.8-4,4v19c0,2.2,1.8,4,4,4h32c2.2,0,4-1.8,4-4V27C46,24.8,44.2,23,42,23z M31,44.5 c-1.5,1-3.2,1.5-5,1.5c-0.6,0-1.2-0.1-1.8-0.2c-2.4-0.5-4.4-1.8-5.7-3.8l3.3-2.2c0.7,1.1,1.9,1.9,3.2,2.1c1.3,0.3,2.6,0,3.8-0.8 c2.3-1.5,2.9-4.7,1.4-6.9c-0.7-1.1-1.9-1.9-3.2-2.1c-1.3-0.3-2.6,0-3.8,0.8c-0.3,0.2-0.5,0.4-0.7,0.6L26,37h-9v-9l2.6,2.6 c0.4-0.4,0.9-0.8,1.3-1.1c2-1.3,4.4-1.8,6.8-1.4c2.4,0.5,4.4,1.8,5.7,3.8C36.2,36.1,35.1,41.7,31,44.5z"></path>
                      <path d="M10,18.1v0.4C10,18.4,10,18.3,10,18.1C10,18.1,10,18.1,10,18.1z"></path>
                      <path d="M11,19h4c0.6,0,1-0.3,1-0.9V18c0-5.7,4.9-10.4,10.7-10C32,8.4,36,13,36,18.4v-0.3c0,0.6,0.4,0.9,1,0.9h4 c0.6,0,1-0.3,1-0.9V18c0-9.1-7.6-16.4-16.8-16c-8.5,0.4-15,7.6-15.2,16.1C10.1,18.6,10.5,19,11,19z"></path>
                    </g>
                  </g>
                </svg>
                Reset Password
              </h1>
              <div class="card-body">
                <?php if (isset($_SESSION['message'])) { ?>
                  <div class="flex">
                    <div id="loginError" class="alert alert-error"><?php echo $_SESSION['message'] ?></div>
                    <?php if (isset($_SESSION['message'])) {
                      unset($_SESSION['message']);
                    } ?>
                  </div>
                <?php } ?>
                <?php if (isset($_SESSION['success'])) { ?>
                  <div class="flex">
                    <div id="loginSuccess" class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
                    <?php if (isset($_SESSION['success'])) {
                      unset($_SESSION['success']);
                    } ?>
                  </div>
                <?php } ?>
                <form id="resetPasswordForm" class="w-1/2 p-5 mx-auto" action="database/resetpassword.php" method="POST">
                  Email
                  <div class="flex">
                    <label class="input input-bordered items-center flex">
                      <svg fill="#ffffff" width="24px" height="24px" viewBox="0 0 1920 1920" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path d="M1920 428.266v1189.54l-464.16-580.146-88.203 70.585 468.679 585.904H83.684l468.679-585.904-88.202-70.585L0 1617.805V428.265l959.944 832.441L1920 428.266ZM1919.932 226v52.627l-959.943 832.44L.045 278.628V226h1919.887Z" fill-rule="evenodd"></path>
                        </g>
                      </svg>
                    </label>
                    <input type="email" class="input input-bordered input-primary mb-3 w-full" placeholder="user@email.com" id="email" name="email" required />
                  </div>
                  <button type="submit" class="flex-auto my-5 btn btn-primary shadow-xl w-full">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path d="M20.7639 12H10.0556M3 8.00003H5.5M4 12H5.5M4.5 16H5.5M9.96153 12.4896L9.07002 15.4486C8.73252 16.5688 8.56376 17.1289 8.70734 17.4633C8.83199 17.7537 9.08656 17.9681 9.39391 18.0415C9.74792 18.1261 10.2711 17.8645 11.3175 17.3413L19.1378 13.4311C20.059 12.9705 20.5197 12.7402 20.6675 12.4285C20.7961 12.1573 20.7961 11.8427 20.6675 11.5715C20.5197 11.2598 20.059 11.0295 19.1378 10.5689L11.3068 6.65342C10.2633 6.13168 9.74156 5.87081 9.38789 5.95502C9.0808 6.02815 8.82627 6.24198 8.70128 6.53184C8.55731 6.86569 8.72427 7.42461 9.05819 8.54246L9.96261 11.5701C10.0137 11.7411 10.0392 11.8266 10.0493 11.9137C10.0583 11.991 10.0582 12.069 10.049 12.1463C10.0387 12.2334 10.013 12.3188 9.96153 12.4896Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </svg>
                    Send Reset Mail
                  </button>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php require('footer.php'); ?>
