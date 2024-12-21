    <?php require('header.php'); ?>
    <?php
    if (isset($_SESSION['loggedin']) == true) {
      header('Location: dashboard.php');
      exit();
    }
    ?>
    <?php require('navbar.php'); ?>
    <div class="section" id="login">
      <div class="flex flex-col justify-center h-full">
        <div class="flex space-x-5 place-content-center">
          <?php if (!isset($_SESSION['loggedin'])) { ?>
            <div class="card bg-base-300 shadow-xl flex flex-col grow">
              <h1 class="card-header card-title flex place-content-center shadow-xl p-3">
                <svg height="32px" width="32px" version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512" xml:space="preserve" fill="#000000">
                  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                  <g id="SVGRepo_iconCarrier">
                    <style type="text/css">
                      .st0 {
                        fill: #ffffff;
                      }
                    </style>
                    <g>
                      <path class="st0" d="M155.81,0v173.889h33.417V33.417h235.592l-74.87,50.656c-8.469,5.727-13.535,15.289-13.535,25.503v286.24 H189.227V282.079H155.81v147.154h180.604v70.93c0,4.382,2.423,8.404,6.29,10.451c3.867,2.056,8.558,1.811,12.189-0.644 l119.318-80.736V0H155.81z"></path>
                      <path class="st0" d="M228.657,290.4c0,1.844,1.068,3.524,2.75,4.3c1.664,0.775,3.638,0.514,5.042-0.685l78.044-66.035 l-78.044-66.034c-1.404-1.2-3.378-1.46-5.042-0.686c-1.681,0.775-2.75,2.456-2.75,4.3v33.392H37.79v58.064h190.868V290.4z"></path>
                    </g>
                  </g>
                </svg> Log In
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
                <form id="loginForm" class="w-1/2 p-5 mx-auto" action="database/login.php" method="POST">
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
                  Password
                  <div class="flex">
                    <label class="input input-bordered items-center flex">
                      <svg width="24px" height="24px" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path d="M17.408 3.412a1.974 1.974 0 0 0 0-2.82 1.973 1.973 0 0 0-2.819 0l-.29.29-.59-.59a1.009 1.009 0 0 0-1.65.35l-.35-.35a1.004 1.004 0 1 0-1.42 1.42l.35.35a1.033 1.033 0 0 0-.58.58l-.35-.35a1.004 1.004 0 0 0-1.42 1.42L9.879 5.3l-3.02 3.01c-.01.01-.02.03-.03.04A4.885 4.885 0 0 0 5 8a5 5 0 1 0 5 5 4.885 4.885 0 0 0-.35-1.83c.01-.01.03-.02.04-.03l7.718-7.728zM5 15a2 2 0 1 1 0-4 2 2 0 0 1 0 4z" fill="#ffffff" fill-rule="evenodd"></path>
                        </g>
                      </svg>
                    </label>
                    <input type="password" class="input input-bordered input-primary mb-3 w-full" placeholder="password" id="password" name="password" required />
                  </div>
                  <div class="flex my-3">
                    <input class="toggle toggle-primary mr-2" type="checkbox" role="switch" id="registercheckbox" name="registercheckbox">
                    <label for="registercheckbox">Register account</label>
                  </div>
                  <button type="submit" class="flex-auto btn btn-primary shadow-xl w-full">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path d="M13 2C10.2386 2 8 4.23858 8 7C8 7.55228 8.44772 8 9 8C9.55228 8 10 7.55228 10 7C10 5.34315 11.3431 4 13 4H17C18.6569 4 20 5.34315 20 7V17C20 18.6569 18.6569 20 17 20H13C11.3431 20 10 18.6569 10 17C10 16.4477 9.55228 16 9 16C8.44772 16 8 16.4477 8 17C8 19.7614 10.2386 22 13 22H17C19.7614 22 22 19.7614 22 17V7C22 4.23858 19.7614 2 17 2H13Z" fill="#000000"></path>
                        <path d="M3 11C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11.2821C11.1931 13.1098 11.1078 13.2163 11.0271 13.318C10.7816 13.6277 10.5738 13.8996 10.427 14.0945C10.3536 14.1921 10.2952 14.2705 10.255 14.3251L10.2084 14.3884L10.1959 14.4055L10.1915 14.4115C10.1914 14.4116 10.191 14.4122 11 15L10.1915 14.4115C9.86687 14.8583 9.96541 15.4844 10.4122 15.809C10.859 16.1336 11.4843 16.0346 11.809 15.5879L11.8118 15.584L11.822 15.57L11.8638 15.5132C11.9007 15.4632 11.9553 15.3897 12.0247 15.2975C12.1637 15.113 12.3612 14.8546 12.5942 14.5606C13.0655 13.9663 13.6623 13.2519 14.2071 12.7071L14.9142 12L14.2071 11.2929C13.6623 10.7481 13.0655 10.0337 12.5942 9.43937C12.3612 9.14542 12.1637 8.88702 12.0247 8.7025C11.9553 8.61033 11.9007 8.53682 11.8638 8.48679L11.822 8.43002L11.8118 8.41602L11.8095 8.41281C11.4848 7.96606 10.859 7.86637 10.4122 8.19098C9.96541 8.51561 9.86636 9.14098 10.191 9.58778L11 9C10.191 9.58778 10.1909 9.58773 10.191 9.58778L10.1925 9.58985L10.1959 9.59454L10.2084 9.61162L10.255 9.67492C10.2952 9.72946 10.3536 9.80795 10.427 9.90549C10.5738 10.1004 10.7816 10.3723 11.0271 10.682C11.1078 10.7837 11.1931 10.8902 11.2821 11H3Z" fill="#000000"></path>
                      </g>
                    </svg>
                    Login
                  </button>
                </form>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <?php require('footer.php'); ?>
