    <?php require('header.php'); ?>
    <?php require('navbar.php'); ?>
    <div class="section" id="freetools">
      <div class="flex flex-col justify-center h-full">
        <div class="flex space-x-5">
          <div class="card bg-base-300 shadow-xl flex flex-col grow w-1/3 min-h-[100px] max-h-[80vh] overflow-y-auto">
            <h1 class="card-header card-title flex place-content-center shadow-xl p-3"><svg width="32px" height="32px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.75 6.49998C8.75 6.08576 8.41421 5.74998 8 5.74998C7.58579 5.74998 7.25 6.08576 7.25 6.49998L7.25 7.74999H6C5.58579 7.74999 5.25 8.08578 5.25 8.49999C5.25 8.91421 5.58579 9.24999 6 9.24999L7.25 9.24999V10.5C7.25 10.9142 7.58579 11.25 8 11.25C8.41421 11.25 8.75 10.9142 8.75 10.5V9.24999H10C10.4142 9.24999 10.75 8.91421 10.75 8.49999C10.75 8.08578 10.4142 7.74999 10 7.74999H8.75L8.75 6.49998ZM14 7.74998C13.5858 7.74998 13.25 8.08576 13.25 8.49998C13.25 8.91419 13.5858 9.24998 14 9.24998H18C18.4142 9.24998 18.75 8.91419 18.75 8.49998C18.75 8.08576 18.4142 7.74998 18 7.74998H14ZM14 13.75C13.5858 13.75 13.25 14.0858 13.25 14.5C13.25 14.9142 13.5858 15.25 14 15.25H18C18.4142 15.25 18.75 14.9142 18.75 14.5C18.75 14.0858 18.4142 13.75 18 13.75H14ZM7.03033 13.9697C6.73744 13.6768 6.26256 13.6768 5.96967 13.9697C5.67678 14.2626 5.67678 14.7374 5.96967 15.0303L6.93935 16L5.96968 16.9697C5.67679 17.2626 5.67679 17.7374 5.96968 18.0303C6.26258 18.3232 6.73745 18.3232 7.03034 18.0303L8.00001 17.0607L8.96966 18.0303C9.26255 18.3232 9.73742 18.3232 10.0303 18.0303C10.3232 17.7374 10.3232 17.2626 10.0303 16.9697L9.06067 16L10.0303 15.0303C10.3232 14.7374 10.3232 14.2626 10.0303 13.9697C9.73744 13.6768 9.26256 13.6768 8.96967 13.9697L8.00001 14.9393L7.03033 13.9697ZM14 16.75C13.5858 16.75 13.25 17.0858 13.25 17.5C13.25 17.9142 13.5858 18.25 14 18.25H18C18.4142 18.25 18.75 17.9142 18.75 17.5C18.75 17.0858 18.4142 16.75 18 16.75H14Z" fill="#ffffff"></path>
                </g>
              </svg> RR</h1>
            <div class="card-body">
              <form id="my-form" class="flex-grow flex flex-col p-5">
                <div class="flex">
                  <div id="error" class="hidden alert alert-error"></div>
                </div>
                <div class="flex">
                  <div id="resdata" class="hidden alert alert-info"></div>
                </div>
                Entry
                <div class="flex">
                  <label class="input input-bordered items-center flex">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z" fill="#ffffff"></path>
                      </g>
                    </svg>
                  </label>
                  <input type="number" class="input input-bordered input-primary mb-3 w-full" placeholder="63250" id="entry" name="entry" step=".0001" min="0.0001" required />
                </div>
                Stop Loss
                <div class="flex">
                  <label class="input input-bordered items-center flex">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z" fill="#ffffff"></path>
                      </g>
                    </svg>
                  </label>
                  <input type="number" class="input input-bordered input-primary mb-3 w-full" placeholder="0.33" id="sl" name="sl" step=".0001" min="0.0001" required />
                </div>
                <div class="flex my-3">
                  <input class="toggle toggle-primary mr-2" type="checkbox" role="switch" id="rrcheckbox" name="fees" checked>
                  <label for="rrcheckbox">Take fees into account</label>
                </div>
                <div class="flex place-content-center">
                  <div class="fields m-3">
                  </div>
                </div>
                <div class="card-actions mt-auto flex justify-between">
                  <button type="button" class="flex-auto add-fields m-2 btn btn-success shadow-xl">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <g id="Edit / Add_Plus">
                          <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </g>
                    </svg>
                    Add TP
                  </button>
                  <button type="button" class="flex-auto add-fields-sl m-2 btn btn-error shadow-xl">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <g id="Edit / Add_Plus">
                          <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </g>
                    </svg>
                    Add SL
                  </button>
                  <button type="submit" class="flex-auto m-2 btn btn-primary shadow-xl w-full">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.75 6.49998C8.75 6.08576 8.41421 5.74998 8 5.74998C7.58579 5.74998 7.25 6.08576 7.25 6.49998L7.25 7.74999H6C5.58579 7.74999 5.25 8.08578 5.25 8.49999C5.25 8.91421 5.58579 9.24999 6 9.24999L7.25 9.24999V10.5C7.25 10.9142 7.58579 11.25 8 11.25C8.41421 11.25 8.75 10.9142 8.75 10.5V9.24999H10C10.4142 9.24999 10.75 8.91421 10.75 8.49999C10.75 8.08578 10.4142 7.74999 10 7.74999H8.75L8.75 6.49998ZM14 7.74998C13.5858 7.74998 13.25 8.08576 13.25 8.49998C13.25 8.91419 13.5858 9.24998 14 9.24998H18C18.4142 9.24998 18.75 8.91419 18.75 8.49998C18.75 8.08576 18.4142 7.74998 18 7.74998H14ZM14 13.75C13.5858 13.75 13.25 14.0858 13.25 14.5C13.25 14.9142 13.5858 15.25 14 15.25H18C18.4142 15.25 18.75 14.9142 18.75 14.5C18.75 14.0858 18.4142 13.75 18 13.75H14ZM7.03033 13.9697C6.73744 13.6768 6.26256 13.6768 5.96967 13.9697C5.67678 14.2626 5.67678 14.7374 5.96967 15.0303L6.93935 16L5.96968 16.9697C5.67679 17.2626 5.67679 17.7374 5.96968 18.0303C6.26258 18.3232 6.73745 18.3232 7.03034 18.0303L8.00001 17.0607L8.96966 18.0303C9.26255 18.3232 9.73742 18.3232 10.0303 18.0303C10.3232 17.7374 10.3232 17.2626 10.0303 16.9697L9.06067 16L10.0303 15.0303C10.3232 14.7374 10.3232 14.2626 10.0303 13.9697C9.73744 13.6768 9.26256 13.6768 8.96967 13.9697L8.00001 14.9393L7.03033 13.9697ZM14 16.75C13.5858 16.75 13.25 17.0858 13.25 17.5C13.25 17.9142 13.5858 18.25 14 18.25H18C18.4142 18.25 18.75 17.9142 18.75 17.5C18.75 17.0858 18.4142 16.75 18 16.75H14Z" fill="#000000"></path>
                      </g>
                    </svg>
                    Calculate RR
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="card bg-base-300 shadow-xl flex flex-col grow w-1/3 min-h-[100px] max-h-[80vh] overflow-y-auto">
            <h1 class="card-header card-title flex place-content-center shadow-xl p-3"><svg width="32px" height="32px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path fill="#ffffff" d="M235.344 31.188c-35.92.543-70.472 6.628-102.97 18l5.72 17.468c30.61-10.843 63.185-16.653 97.187-17.156l.064-18.313zm18.687.187l-.06 18.375c46.9 1.963 96.236 13.842 146.56 36.47l9.376-16.25C356.84 45.9 304.253 33.282 254.03 31.374zm-139.093 24.5c-20.133 8.42-39.376 18.953-57.562 31.5l8.813 16.53c17.207-12.117 35.41-22.284 54.468-30.436l-5.72-17.595zm312.97 20.25l-61.5 106.53 55.124 31.814 61.5-106.532-55.124-31.813zm-174.063 6.313l-.03 18.406c39.736 1.29 80.36 11.3 120.342 31.062l9.375-16.22c-42.846-21.33-86.708-32.012-129.686-33.25zm-18.688.062c-29.644 1.034-58.722 6.555-86.625 16.156l5.72 17.53c26.066-9.063 53.198-14.28 80.875-15.28l.03-18.406zM42.126 98.53c-8.205 6.396-16.177 13.24-23.876 20.5l9.97 16.345c7.376-7.136 15.013-13.842 22.874-20.125l-8.938-16.72h-.03zm88.905 6.72c-17.292 7.142-34.04 15.886-50.124 26.125l8.813 16.5c15.13-9.78 30.847-18.16 47.06-25l-5.75-17.625zm122.626 35.28l-.062 18.44c30.17 1.18 61.405 7.815 93.156 20.405l9.438-16.344c-34.7-14.046-69.15-21.353-102.532-22.5zm-18.687.032c-23.744.82-46.85 4.73-69 11.563l5.718 17.5c20.297-6.28 41.433-9.915 63.218-10.688l.063-18.375zm-169.626 1.375c-7.647 5.49-15.13 11.32-22.406 17.5l9.874 16.157c6.96-6.02 14.107-11.72 21.407-17.063l-8.876-16.593zm82.97 16.344c-14.515 5.62-28.545 12.503-42.033 20.595l8.782 16.406c12.534-7.633 25.55-14.124 39-19.436l-5.75-17.563zM90.53 189.03c-6.896 4.782-13.607 9.887-20.155 15.314l9.844 16.125c6.23-5.272 12.61-10.237 19.155-14.876L90.53 189.03zm279.19 17.126L292.28 340.25c11.3 3.162 22.027 7.753 31.94 13.563l75.31-130.47-29.81-17.187zm-114.033 147.78c-60.607.002-110.206 45.816-116.406 104.752h82.126c-2.206-4.67-3.437-9.87-3.437-15.344 0-19.872 16.315-36.156 36.186-36.156 19.872 0 36.188 16.284 36.188 36.156 0 5.475-1.23 10.674-3.438 15.344h85.188c-6.2-58.936-55.8-104.75-116.406-104.75zm-1.53 71.94c-9.773 0-17.5 7.696-17.5 17.468 0 6.678 3.626 12.39 9.03 15.344h16.938c5.404-2.955 9.03-8.666 9.03-15.344 0-9.772-7.727-17.47-17.5-17.47zm-153.47 51.5v15.687h303.344v-15.688H100.69z"></path>
                </g>
              </svg> Leverage</h1>
            <div class="card-body">
              <form id="lev-form" class="flex-grow flex flex-col p-5">
                <div class="place-content-center" id="levrow">
                  <div class="flex">
                    <div id="levdata" class="hidden alert alert-info"></div>
                  </div>
                  Risk
                  <div class="flex">
                    <label class="input input-bordered items-center flex">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z" fill="#ffffff"></path>
                        </g>
                      </svg>
                    </label>
                    <input type="number" class="input input-bordered input-primary mb-3 w-full" placeholder="1" id="risk" name="risk" step=".0001" min="0.0001" required />
                  </div>
                  Stop Loss
                  <div class="flex">
                    <label class="input input-bordered items-center flex">
                      <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                          <path fill-rule="evenodd" clip-rule="evenodd" d="M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z" fill="#ffffff"></path>
                        </g>
                      </svg>
                    </label>
                    <input type="number" class="input input-bordered input-primary mb-3 w-full" placeholder="0.33" id="stoploss" name="stoploss" step=".0001" min="0.0001" required />
                  </div>
                </div>
                <div class="flex my-3">
                  <input class="toggle toggle-primary mr-2" type="checkbox" role="switch" id="levcheckbox" name="levfees" checked>
                  <label for="levcheckbox">Take fees into account</label>
                </div>
                <div class="flex my-3">
                  <input class="toggle toggle-primary mr-2" type="checkbox" role="switch" id="kacheckbox" name="kalevfees">
                  <label for="kacheckbox">Smaller account size</label>
                </div>
                <div class="flex place-content-center">
                  <div class="m-3"></div>
                </div>
                <div class="card-actions mt-auto flex justify-between">
                  <button type="submit" class="flex-auto m-2 btn btn-primary shadow-xl w-full">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.75 6.49998C8.75 6.08576 8.41421 5.74998 8 5.74998C7.58579 5.74998 7.25 6.08576 7.25 6.49998L7.25 7.74999H6C5.58579 7.74999 5.25 8.08578 5.25 8.49999C5.25 8.91421 5.58579 9.24999 6 9.24999L7.25 9.24999V10.5C7.25 10.9142 7.58579 11.25 8 11.25C8.41421 11.25 8.75 10.9142 8.75 10.5V9.24999H10C10.4142 9.24999 10.75 8.91421 10.75 8.49999C10.75 8.08578 10.4142 7.74999 10 7.74999H8.75L8.75 6.49998ZM14 7.74998C13.5858 7.74998 13.25 8.08576 13.25 8.49998C13.25 8.91419 13.5858 9.24998 14 9.24998H18C18.4142 9.24998 18.75 8.91419 18.75 8.49998C18.75 8.08576 18.4142 7.74998 18 7.74998H14ZM14 13.75C13.5858 13.75 13.25 14.0858 13.25 14.5C13.25 14.9142 13.5858 15.25 14 15.25H18C18.4142 15.25 18.75 14.9142 18.75 14.5C18.75 14.0858 18.4142 13.75 18 13.75H14ZM7.03033 13.9697C6.73744 13.6768 6.26256 13.6768 5.96967 13.9697C5.67678 14.2626 5.67678 14.7374 5.96967 15.0303L6.93935 16L5.96968 16.9697C5.67679 17.2626 5.67679 17.7374 5.96968 18.0303C6.26258 18.3232 6.73745 18.3232 7.03034 18.0303L8.00001 17.0607L8.96966 18.0303C9.26255 18.3232 9.73742 18.3232 10.0303 18.0303C10.3232 17.7374 10.3232 17.2626 10.0303 16.9697L9.06067 16L10.0303 15.0303C10.3232 14.7374 10.3232 14.2626 10.0303 13.9697C9.73744 13.6768 9.26256 13.6768 8.96967 13.9697L8.00001 14.9393L7.03033 13.9697ZM14 16.75C13.5858 16.75 13.25 17.0858 13.25 17.5C13.25 17.9142 13.5858 18.25 14 18.25H18C18.4142 18.25 18.75 17.9142 18.75 17.5C18.75 17.0858 18.4142 16.75 18 16.75H14Z" fill="#000000"></path>
                      </g>
                    </svg>
                    Calculate Leverage
                  </button>
                </div>
              </form>
            </div>
          </div>
          <div class="card bg-base-300 shadow-xl flex flex-col grow w-1/3 min-h-[100px] max-h-[80vh] overflow-y-auto">
            <h1 class="card-header card-title flex place-content-center shadow-xl p-3">
              <svg fill="#ffffff" height="32px" width="32px" version="1.2" baseProfile="tiny" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-351 153 256 256" xml:space="preserve" stroke="#ffffff">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                  <path d="M-122.1,236.9l4.4-11.3h-20.6l3.7,11.3H-122.1z M-117.7,240.6L-117.7,240.6l-20.6-0.1v0.1c-7.2,3.7-12.1,11.2-12.1,19.8 c0,12.4,10,22.3,22.3,22.3c12.4,0,22.3-10,22.3-22.3C-105.6,251.8-110.5,244.3-117.7,240.6z M-126.6,271.2v3.2h-3.1v-2.9 c-2.1-0.1-4.1-0.7-5.3-1.3l0.9-3.7c1.3,0.7,3.2,1.3,5.2,1.3c1.7,0,3.1-0.7,3.1-2c0-1.2-1.1-2-3.3-2.7c-3.3-1.1-5.6-2.7-5.6-5.7 c0-2.8,2-4.9,5.3-5.6v-2.9h3.1v2.8c2.1,0.1,3.5,0.5,4.5,1.1l-0.9,3.6c-0.8-0.4-2.3-1.1-4.5-1.1c-2,0-2.7,0.9-2.7,1.7 c0,1.1,1.1,1.7,3.7,2.7c3.7,1.3,5.2,3.1,5.2,5.8C-121,268.1-123,270.5-126.6,271.2z M-302.2,208.3l6.9-18.3h-33.2l5.8,18.3H-302.2z M-295.3,214.3v-0.1h-33.4v0.1c-11.7,6-19.5,18.2-19.5,32.2c0,20.1,16.2,36.3,36.3,36.3c20.1,0,36.3-16.2,36.3-36.3 C-275.6,232.5-283.6,220.3-295.3,214.3z M-309.6,264v5.2h-4.9v-4.8c-3.5-0.1-6.6-1.1-8.6-2.1l1.5-6c2.1,1.2,5.2,2.3,8.4,2.3 c2.9,0,4.9-1.1,4.9-3.2c0-1.9-1.6-3.2-5.3-4.4c-5.5-1.9-9.2-4.4-9.2-9.3c0-4.5,3.2-8,8.6-9v-4.8h4.9v4.5c3.5,0.1,5.7,0.8,7.3,1.7 l-1.5,5.7c-1.3-0.5-3.7-1.7-7.3-1.7c-3.3,0-4.4,1.5-4.4,2.8c0,1.7,1.7,2.8,6.1,4.4c6,2.1,8.5,4.9,8.5,9.4 C-300.6,259.1-303.8,262.9-309.6,264z M-218.3,238.7c14.6,0,26.3-11.7,26.3-26.3c0-14.6-11.7-26.3-26.3-26.3s-26.3,11.7-26.3,26.3 C-244.6,227-232.9,238.7-218.3,238.7z M-279.3,315.1h-47.3c-15.4,0-16.2-23.4,0.3-23.4h40.8l23.7-34.6c6.9-9.6,14.9-14.1,26.1-14.1 h35.1c11.2,0,19.1,4.3,26.1,14.1l23.7,34.6h41.2c16.5,0,15.4,23.4,0.5,23.4h-47.3c-3.7,0-8.2-1.3-10.9-5.3l-18.1-25.8l-0.1,67.3 h-64.7l-0.1-67.3l-17.9,25.8C-271.1,313.7-275.6,315.1-279.3,315.1z"></path>
                </g>
              </svg>
              TPs
            </h1>
            <div class="card-body">
              <form id="tp-form" class="flex-grow flex flex-col p-5">
                <div class="flex" id="tprow">
                  <div id="tpdata" class="hidden alert alert-info"></div>
                </div>
                Position Size
                <div class="flex">
                  <label class="input input-bordered items-center flex">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z" fill="#ffffff"></path>
                      </g>
                    </svg>
                  </label>
                  <input type="number" class="input input-bordered input-primary mb-3 w-full" placeholder="1000" id="positiegrootte" name="positiegrootte" step=".0001" min="0.0001" required />
                </div>
                <div class="flex place-content-center">
                  <div class="tpfields m-3">
                  </div>
                </div>
                <div class="card-actions mt-auto flex justify-between">
                  <button type="button" class="add-tp-fields flex-auto m-2 btn btn-success shadow-xl">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <g id="Edit / Add_Plus">
                          <path id="Vector" d="M6 12H12M12 12H18M12 12V18M12 12V6" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </g>
                      </g>
                    </svg>
                    Add TP
                  </button>
                  <button type="submit" class="flex-auto m-2 btn btn-primary shadow-xl w-full">
                    <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                      <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                      <g id="SVGRepo_iconCarrier">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C22 4.92893 22 7.28595 22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22ZM8.75 6.49998C8.75 6.08576 8.41421 5.74998 8 5.74998C7.58579 5.74998 7.25 6.08576 7.25 6.49998L7.25 7.74999H6C5.58579 7.74999 5.25 8.08578 5.25 8.49999C5.25 8.91421 5.58579 9.24999 6 9.24999L7.25 9.24999V10.5C7.25 10.9142 7.58579 11.25 8 11.25C8.41421 11.25 8.75 10.9142 8.75 10.5V9.24999H10C10.4142 9.24999 10.75 8.91421 10.75 8.49999C10.75 8.08578 10.4142 7.74999 10 7.74999H8.75L8.75 6.49998ZM14 7.74998C13.5858 7.74998 13.25 8.08576 13.25 8.49998C13.25 8.91419 13.5858 9.24998 14 9.24998H18C18.4142 9.24998 18.75 8.91419 18.75 8.49998C18.75 8.08576 18.4142 7.74998 18 7.74998H14ZM14 13.75C13.5858 13.75 13.25 14.0858 13.25 14.5C13.25 14.9142 13.5858 15.25 14 15.25H18C18.4142 15.25 18.75 14.9142 18.75 14.5C18.75 14.0858 18.4142 13.75 18 13.75H14ZM7.03033 13.9697C6.73744 13.6768 6.26256 13.6768 5.96967 13.9697C5.67678 14.2626 5.67678 14.7374 5.96967 15.0303L6.93935 16L5.96968 16.9697C5.67679 17.2626 5.67679 17.7374 5.96968 18.0303C6.26258 18.3232 6.73745 18.3232 7.03034 18.0303L8.00001 17.0607L8.96966 18.0303C9.26255 18.3232 9.73742 18.3232 10.0303 18.0303C10.3232 17.7374 10.3232 17.2626 10.0303 16.9697L9.06067 16L10.0303 15.0303C10.3232 14.7374 10.3232 14.2626 10.0303 13.9697C9.73744 13.6768 9.26256 13.6768 8.96967 13.9697L8.00001 14.9393L7.03033 13.9697ZM14 16.75C13.5858 16.75 13.25 17.0858 13.25 17.5C13.25 17.9142 13.5858 18.25 14 18.25H18C18.4142 18.25 18.75 17.9142 18.75 17.5C18.75 17.0858 18.4142 16.75 18 16.75H14Z" fill="#000000"></path>
                      </g>
                    </svg>
                    Calculate TP Size
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php if (!isset($_SESSION['loggedin'])) { ?>
      <div class="section" id="features">
        <div class="flex justify-center items-center h-full my-5 space-x-5 columns-2 place-content-center">
          <div class="card bg-base-300 shadow-xl flex flex-col grow w-1/3">
            <div class="card-body items-center">
              <div class="skeleton h-80 w-80"></div>
              <div class="card-actions mt-auto flex justify-between">
              </div>
            </div>
          </div>
          <div class="card items-center bg-base-300 p-10 shadow-xl flex flex-col grow w-2/3">
            <h1 class="card-title">Trading Interface | Features</h1>
            <hr class="w-1/3 my-5">
            <div class="card-body">
              <ul class="space-y-5">
                <li>&#10004; Enjoy our simple but robust trading interface</li>
                <li>&#10004; Never forget your stop loss again</li>
                <li>&#10004; Automated actual final RR calculation for your trades</li>
                <li>&#10004; Automated take profit size calculation for your trades</li>
                <li>&#10004; Automated leverage / position size calculation for your trades</li>
                <li>&#10004; No overcomplicated user interface, like an exchange</li>
                <li>&#10004; No overstimulation that forces you to take bad trades</li>
                <li>&#10004; Currently supported exchanges: Blofin</li>
              </ul>
              <div class="card-actions mt-auto flex justify-between">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="section" id="pricing">
        <div class="flex justify-center items-center h-full my-5 space-x-5 columns-2 place-content-center">
          <div class="card items-center p-10 bg-base-300 shadow-xl flex flex-col grow w-1/2">
            <h1 class="card-title">Free / Unregistered User</h1>
            <hr class="w-1/3 my-5">
            <div class="card-body items-center">
              <ul class="space-y-5">
                <li>&#10004; Actual final RR calculator</li>
                <li>&#10004; Leverage / position size calculator</li>
                <li>&#10004; Take profit size calculator</li>
              </ul>
              <div class="card-actions mt-auto flex justify-between">
              </div>
            </div>
          </div>
          <div class="card items-center p-10 bg-base-300 shadow-xl flex flex-col grow w-1/2">
            <h1 class="card-title">$5 / month</h1>
            <hr class="w-1/3 my-5">
            <div class="card-body items-center">
              <ul class="space-y-5">
                <li>&#10004; Simple and robust trading interface</li>
                <li>&#10004; Automated actual final RR calculator</li>
                <li>&#10004; Automated leverage / position size calculator</li>
                <li>&#10004; Automated take profit size calculator</li>
                <li>&#10004; Currently supported exchanges: Blofin</li>
              </ul>
              <div class="card-actions mt-auto flex justify-between">
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <?php require('footer.php'); ?>
