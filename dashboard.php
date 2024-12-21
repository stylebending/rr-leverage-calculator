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
<div class="mt-10" id="dashboard">
  <div class="flex flex-col justify-center h-full">
    <div class="flex space-x-5">
      <?php if (isset($_SESSION['loggedin'])) { ?>
        <div class="card bg-base-300 shadow-xl flex flex-col grow">
          <h1 class="card-header card-title flex justify-between w-full place-content-center shadow-xl p-10">
            <div class="flex w-full">
              <div class="flex place-content-start w-1/2 items-center">
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="flex">
                  <select class="block bg-base-300 w-full px-3 py-2 text-base border border-gray-300 rounded-box shadow-xl focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" name="selectedAccount">
                    <?php
                    // Assuming you have an array of accounts stored in $phemexAccounts
                    $selected = "";
                    foreach (getPhemexNames() as $account) {
                      if ($account == $_SESSION['currentAccount']['name']) {
                        $selected = "selected";
                      }
                      echo "<option value='" . htmlspecialchars($account) . "'" . $selected . ">" . htmlspecialchars($account) . "</option>";
                      $selected = "";
                    }
                    ?>
                  </select>
                  <button type="submit" class="btn btn-primary m-3 w-50 shadow-xl">Select Account</button>
                </form>
              </div>
              <div class="flex space-x-5 w-1/2 place-content-end items-center">
                <!-- Open the modal using ID.showModal() method -->
                <button class="btn btn-error shadow-xl" onclick="my_modal_1.showModal()">Delete an Account</button>
                <dialog id="my_modal_1" class="modal modal-bottom sm:modal-middle">
                  <div class="modal-box">
                    <p class="">Select the account you want to delete</p>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="flex flex-col w-3/4 mx-auto my-10">
                      <select class="form-select mb-5" name="selectedAccountToDelete">
                        <?php
                        // Assuming you have an array of accounts stored in $phemexAccounts
                        foreach (getPhemexNames() as $account) {
                          echo "<option value='" . htmlspecialchars($account) . "'>" . htmlspecialchars($account) . "</option>";
                        }
                        ?>
                      </select>
                      <input type="submit" value="Delete Account" class="btn btn-error mt-10">
                    </form>
                    <div class="modal-action">
                      <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                      </form>
                    </div>
                  </div>
                </dialog>
                <button class="btn btn-success shadow-xl" onclick="my_modal_2.showModal()">Add an Account</button>
                <dialog id="my_modal_2" class="modal modal-bottom sm:modal-middle">
                  <div class="modal-box">
                    <p class="mb-5">Add an Account</p>
                    <form id="addAccForm" class="w-3/4 mx-auto" action="database/doaddaccount.php" method="POST">
                      Phemex API Key
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
                        <input type="text" class="input input-bordered input-primary mb-3 w-full" placeholder="Phemex API Key" id="apikey" name="apikey" required />
                      </div>
                      Phemex API Secret
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
                        <input type="text" class="input input-bordered input-primary mb-3 w-full" placeholder="Phemex API Secret" id="apisecret" name="apisecret" required />
                      </div>
                      <button type="submit" class="flex-auto btn btn-success shadow-xl w-full">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path d="M13 2C10.2386 2 8 4.23858 8 7C8 7.55228 8.44772 8 9 8C9.55228 8 10 7.55228 10 7C10 5.34315 11.3431 4 13 4H17C18.6569 4 20 5.34315 20 7V17C20 18.6569 18.6569 20 17 20H13C11.3431 20 10 18.6569 10 17C10 16.4477 9.55228 16 9 16C8.44772 16 8 16.4477 8 17C8 19.7614 10.2386 22 13 22H17C19.7614 22 22 19.7614 22 17V7C22 4.23858 19.7614 2 17 2H13Z" fill="#000000"></path>
                            <path d="M3 11C2.44772 11 2 11.4477 2 12C2 12.5523 2.44772 13 3 13H11.2821C11.1931 13.1098 11.1078 13.2163 11.0271 13.318C10.7816 13.6277 10.5738 13.8996 10.427 14.0945C10.3536 14.1921 10.2952 14.2705 10.255 14.3251L10.2084 14.3884L10.1959 14.4055L10.1915 14.4115C10.1914 14.4116 10.191 14.4122 11 15L10.1915 14.4115C9.86687 14.8583 9.96541 15.4844 10.4122 15.809C10.859 16.1336 11.4843 16.0346 11.809 15.5879L11.8118 15.584L11.822 15.57L11.8638 15.5132C11.9007 15.4632 11.9553 15.3897 12.0247 15.2975C12.1637 15.113 12.3612 14.8546 12.5942 14.5606C13.0655 13.9663 13.6623 13.2519 14.2071 12.7071L14.9142 12L14.2071 11.2929C13.6623 10.7481 13.0655 10.0337 12.5942 9.43937C12.3612 9.14542 12.1637 8.88702 12.0247 8.7025C11.9553 8.61033 11.9007 8.53682 11.8638 8.48679L11.822 8.43002L11.8118 8.41602L11.8095 8.41281C11.4848 7.96606 10.859 7.86637 10.4122 8.19098C9.96541 8.51561 9.86636 9.14098 10.191 9.58778L11 9C10.191 9.58778 10.1909 9.58773 10.191 9.58778L10.1925 9.58985L10.1959 9.59454L10.2084 9.61162L10.255 9.67492C10.2952 9.72946 10.3536 9.80795 10.427 9.90549C10.5738 10.1004 10.7816 10.3723 11.0271 10.682C11.1078 10.7837 11.1931 10.8902 11.2821 11H3Z" fill="#000000"></path>
                          </g>
                        </svg>
                        Add Account
                      </button>
                    </form>
                    <div class="modal-action">
                      <form method="dialog">
                        <!-- if there is a button in form, it will close the modal -->
                        <button class="btn">Close</button>
                      </form>
                    </div>
                  </div>
                </dialog>
              </div>
            </div>
          </h1>
          <div class="card-body items-center p-5">
            <?php if (isset($_SESSION['message'])) { ?>
              <div class="flex">
                <div class="alert alert-error"><?php echo $_SESSION['message'] ?></div>
                <?php if (isset($_SESSION['message'])) {
                  unset($_SESSION['message']);
                } ?>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['success'])) { ?>
              <div class="flex">
                <div class="alert alert-success"><?php echo $_SESSION['success'] ?></div>
                <?php if (isset($_SESSION['success'])) {
                  unset($_SESSION['success']);
                } ?>
              </div>
            <?php } ?>
            <?php if (isset($_SESSION['currentAccount'])) { ?>
              <div class="flex w-full">
                <div class="flex flex-col p-5 w-1/2">
                  <div class="flex bg-base-100 p-5 mb-5 shadow-xl rounded-box">
                    <div class="flex flex-col w-2/3 place-content-center">
                      <h3 class="mb-5">USDT Positions</h3>
                    </div>
                    <div class="flex flex-col w-1/3 place-content-end">
                      <button class="btn btn-primary mb-5 shadow-xl" type="button" id="loadUsdtItems">
                        Load
                      </button>
                    </div>
                  </div>
                  <div class="hidden" id="usdtItemsContainer">
                  </div>
                </div>
                <div class="flex flex-col p-5 w-1/2">
                  <div class="flex bg-base-100 p-5 mb-5 shadow-xl rounded-box">
                    <div class="flex flex-col w-2/3 place-content-center">
                      <h3 class="mb-5">BTC Inverse Positions</h3>
                    </div>
                    <div class="flex flex-col w-1/3 place-content-end">
                      <button class="btn btn-primary mb-5 shadow-xl" type="button" id="loadInverseItems">
                        Load
                      </button>
                    </div>
                  </div>
                  <div class="hidden" id="inverseItemsContainer">
                  </div>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</div>
<?php require('footer.php'); ?>
