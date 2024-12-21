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
                  <button type="submit" class="btn btn-primary m-3 w-50 shadow-xl">
                    <svg version="1.1" id="Uploaded to svgrepo.com" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 32 32" xml:space="preserve" fill="#000000">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                          .puchipuchi_een {
                            fill: #000000;
                          }
                        </style>
                        <path class="puchipuchi_een" d="M7,6c0-2.757,2.243-5,5-5s5,2.243,5,5c0,1.627-0.793,3.061-2,3.974V6c0-1.654-1.346-3-3-3 S9,4.346,9,6v3.974C7.793,9.061,7,7.627,7,6z M24,13c-1.104,0-2,0.896-2,2v-1c0-1.104-0.896-2-2-2s-2,0.896-2,2v-1 c0-1.104-0.896-2-2-2s-2,0.896-2,2V6c0-1.104-0.896-2-2-2s-2,0.896-2,2v10.277C9.705,16.106,9.366,16,9,16c-1.104,0-2,0.896-2,2v3 c0,0.454,0.155,0.895,0.438,1.249L11,28h12l2.293-3.293C25.682,24.318,26,23.55,26,23v-8C26,13.896,25.104,13,24,13z M11,29v1 c0,0.552,0.447,1,1,1h10c0.553,0,1-0.448,1-1v-1H11z"></path>
                      </g>
                    </svg>
                    Select Account
                  </button>
                </form>
              </div>
              <div class="flex space-x-5 w-1/2 place-content-end items-center">
                <!-- Open the modal using ID.showModal() method -->
                <button class="btn btn-error shadow-xl" onclick="my_modal_1.showModal()">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <path d="M2.75 6.16667C2.75 5.70644 3.09538 5.33335 3.52143 5.33335L6.18567 5.3329C6.71502 5.31841 7.18202 4.95482 7.36214 4.41691C7.36688 4.40277 7.37232 4.38532 7.39185 4.32203L7.50665 3.94993C7.5769 3.72179 7.6381 3.52303 7.72375 3.34536C8.06209 2.64349 8.68808 2.1561 9.41147 2.03132C9.59457 1.99973 9.78848 1.99987 10.0111 2.00002H13.4891C13.7117 1.99987 13.9056 1.99973 14.0887 2.03132C14.8121 2.1561 15.4381 2.64349 15.7764 3.34536C15.8621 3.52303 15.9233 3.72179 15.9935 3.94993L16.1083 4.32203C16.1279 4.38532 16.1333 4.40277 16.138 4.41691C16.3182 4.95482 16.8778 5.31886 17.4071 5.33335H19.9786C20.4046 5.33335 20.75 5.70644 20.75 6.16667C20.75 6.62691 20.4046 7 19.9786 7H3.52143C3.09538 7 2.75 6.62691 2.75 6.16667Z" fill="#000000"></path>
                      <path d="M11.6068 21.9998H12.3937C15.1012 21.9998 16.4549 21.9998 17.3351 21.1366C18.2153 20.2734 18.3054 18.8575 18.4855 16.0256L18.745 11.945C18.8427 10.4085 18.8916 9.6402 18.45 9.15335C18.0084 8.6665 17.2628 8.6665 15.7714 8.6665H8.22905C6.73771 8.6665 5.99204 8.6665 5.55047 9.15335C5.10891 9.6402 5.15777 10.4085 5.25549 11.945L5.515 16.0256C5.6951 18.8575 5.78515 20.2734 6.66534 21.1366C7.54553 21.9998 8.89927 21.9998 11.6068 21.9998Z" fill="#000000"></path>
                    </g>
                  </svg>
                  Delete an Account
                </button>
                <dialog id="my_modal_1" class="modal modal-bottom sm:modal-middle">
                  <div class="modal-box">
                    <p class="">Select the account you want to delete</p>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" class="flex flex-col w-3/4 mx-auto my-10">
                      <select class="block bg-base-300 w-full px-3 py-2 text-base border border-gray-300 rounded-box shadow-xl focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm mb-5" name="selectedAccountToDelete">
                        <?php
                        // Assuming you have an array of accounts stored in $phemexAccounts
                        foreach (getPhemexNames() as $account) {
                          echo "<option value='" . htmlspecialchars($account) . "'>" . htmlspecialchars($account) . "</option>";
                        }
                        ?>
                      </select>
                      <button type="submit" class="btn btn-error mt-10">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path d="M2.75 6.16667C2.75 5.70644 3.09538 5.33335 3.52143 5.33335L6.18567 5.3329C6.71502 5.31841 7.18202 4.95482 7.36214 4.41691C7.36688 4.40277 7.37232 4.38532 7.39185 4.32203L7.50665 3.94993C7.5769 3.72179 7.6381 3.52303 7.72375 3.34536C8.06209 2.64349 8.68808 2.1561 9.41147 2.03132C9.59457 1.99973 9.78848 1.99987 10.0111 2.00002H13.4891C13.7117 1.99987 13.9056 1.99973 14.0887 2.03132C14.8121 2.1561 15.4381 2.64349 15.7764 3.34536C15.8621 3.52303 15.9233 3.72179 15.9935 3.94993L16.1083 4.32203C16.1279 4.38532 16.1333 4.40277 16.138 4.41691C16.3182 4.95482 16.8778 5.31886 17.4071 5.33335H19.9786C20.4046 5.33335 20.75 5.70644 20.75 6.16667C20.75 6.62691 20.4046 7 19.9786 7H3.52143C3.09538 7 2.75 6.62691 2.75 6.16667Z" fill="#000000"></path>
                            <path d="M11.6068 21.9998H12.3937C15.1012 21.9998 16.4549 21.9998 17.3351 21.1366C18.2153 20.2734 18.3054 18.8575 18.4855 16.0256L18.745 11.945C18.8427 10.4085 18.8916 9.6402 18.45 9.15335C18.0084 8.6665 17.2628 8.6665 15.7714 8.6665H8.22905C6.73771 8.6665 5.99204 8.6665 5.55047 9.15335C5.10891 9.6402 5.15777 10.4085 5.25549 11.945L5.515 16.0256C5.6951 18.8575 5.78515 20.2734 6.66534 21.1366C7.54553 21.9998 8.89927 21.9998 11.6068 21.9998Z" fill="#000000"></path>
                          </g>
                        </svg>
                        Delete Account
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
                <button class="btn btn-success shadow-xl" onclick="my_modal_2.showModal()">
                  <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                      <g id="Edit / Add_Plus">
                        <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                      </g>
                    </g>
                  </svg>
                  Add an Account
                </button>
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
                            <g id="Edit / Add_Plus">
                              <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            </g>
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
                        <svg fill="#000000" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 296.999 296.999" xml:space="preserve">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <g>
                              <g>
                                <path d="M294.853,178.121c-1.814-1.671-4.404-2.203-6.729-1.382l-25.97,9.168c17.558-70.878-24.569-143.07-94.69-161.569 c-34.475-9.094-70.423-4.215-101.225,13.737C35.438,56.028,13.475,84.901,4.397,119.377c-8.083,30.698-4.951,63.329,8.819,91.883 c13.616,28.234,36.767,50.846,65.186,63.669c3.256,1.47,6.737,2.203,10.214,2.203c3.647,0,7.293-0.807,10.672-2.418 c6.59-3.141,11.435-8.99,13.293-16.047c3.086-11.721-2.756-23.89-13.893-28.937c-37.335-16.923-56.844-58.027-46.387-97.737 c5.7-21.65,19.508-39.794,38.878-51.089c19.372-11.295,41.963-14.378,63.611-8.675c44.273,11.659,70.99,56.813,60.113,101.108 l-17.584-20.48c-1.612-1.878-4.135-2.705-6.544-2.152c-2.412,0.555-4.318,2.401-4.948,4.794l-11.478,43.588 c-0.566,2.153-0.02,4.447,1.457,6.112l40.428,45.603c1.785,2.012,4.604,2.752,7.144,1.882l57.644-19.78 c2.106-0.723,3.711-2.45,4.279-4.603l11.479-43.587C297.408,182.329,296.667,179.792,294.853,178.121z"></path>
                              </g>
                            </g>
                          </g>
                        </svg>
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
                        <svg fill="#000000" height="24px" width="24px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 296.999 296.999" xml:space="preserve">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <g>
                              <g>
                                <path d="M294.853,178.121c-1.814-1.671-4.404-2.203-6.729-1.382l-25.97,9.168c17.558-70.878-24.569-143.07-94.69-161.569 c-34.475-9.094-70.423-4.215-101.225,13.737C35.438,56.028,13.475,84.901,4.397,119.377c-8.083,30.698-4.951,63.329,8.819,91.883 c13.616,28.234,36.767,50.846,65.186,63.669c3.256,1.47,6.737,2.203,10.214,2.203c3.647,0,7.293-0.807,10.672-2.418 c6.59-3.141,11.435-8.99,13.293-16.047c3.086-11.721-2.756-23.89-13.893-28.937c-37.335-16.923-56.844-58.027-46.387-97.737 c5.7-21.65,19.508-39.794,38.878-51.089c19.372-11.295,41.963-14.378,63.611-8.675c44.273,11.659,70.99,56.813,60.113,101.108 l-17.584-20.48c-1.612-1.878-4.135-2.705-6.544-2.152c-2.412,0.555-4.318,2.401-4.948,4.794l-11.478,43.588 c-0.566,2.153-0.02,4.447,1.457,6.112l40.428,45.603c1.785,2.012,4.604,2.752,7.144,1.882l57.644-19.78 c2.106-0.723,3.711-2.45,4.279-4.603l11.479-43.587C297.408,182.329,296.667,179.792,294.853,178.121z"></path>
                              </g>
                            </g>
                          </g>
                        </svg>
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
