// JS that handles creating new TPs and AJAX requests
$(function() {
  // Defining variables
  var $form = $("#my-form");
  var $levForm = $("#lev-form");
  var $tpForm = $("#tp-form");
  var $fields = $form.find(".fields");
  var $tpFields = $tpForm.find(".tpfields");
  var $levrow = $("#levrow");
  var positieTpCount = 0;
  var tpCount = 0;
  var slTpCount = 0;

  // Function to add TPs when user wants to
  $form.on("click", ".add-fields", function() {
    // Setting the unique tpCount per tp
    tpCount += 1;

    // Creating $ svg label
    var dsSvgLabel = document.createElement("label");
    dsSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

    // Creating $ svg
    var dsSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
    dsSvg.setAttribute('width', '24px');
    dsSvg.setAttribute('height', '24px');
    dsSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
    dsSvg.setAttribute('fill', 'none');
    dsSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    dsSvg.setAttribute('stroke', '#ffffff');

    var dsSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
    dsSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
    dsSvgG.setAttribute('stroke-width', '0');

    var dsSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    dsSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
    dsSvgG2.setAttribute('stroke-linecap', 'round');
    dsSvgG2.setAttribute('stroke-linejoin', 'round');

    var dsSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    dsSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

    var dsSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    dsSvgPath.setAttribute('fill-rule', 'evenodd');
    dsSvgPath.setAttribute('clip-rule', 'evenodd');
    dsSvgPath.setAttribute('d', 'M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z');
    dsSvgPath.setAttribute('fill', '#ffffff');
    dsSvg.appendChild(dsSvgG);
    dsSvg.appendChild(dsSvgG2);
    dsSvgG3.appendChild(dsSvgPath);
    dsSvg.appendChild(dsSvgG3);
    dsSvgLabel.appendChild(dsSvg);

    // Creating % svg label
    var psSvgLabel = document.createElement("label");
    psSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

    // Creating % svg
    var psSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
    psSvg.setAttribute('width', '24px');
    psSvg.setAttribute('height', '24px');
    psSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
    psSvg.setAttribute('fill', 'none');
    psSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    psSvg.setAttribute('stroke', '#ffffff');

    var psSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
    psSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
    psSvgG.setAttribute('stroke-width', '0');

    var psSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    psSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
    psSvgG2.setAttribute('stroke-linecap', 'round');
    psSvgG2.setAttribute('stroke-linejoin', 'round');

    var psSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    psSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

    var psSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    psSvgPath.setAttribute('fill-rule', 'evenodd');
    psSvgPath.setAttribute('clip-rule', 'evenodd');
    psSvgPath.setAttribute('d', 'M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z');
    psSvgPath.setAttribute('fill', '#ffffff');
    psSvg.appendChild(psSvgG);
    psSvg.appendChild(psSvgG2);
    psSvgG3.appendChild(psSvgPath);
    psSvg.appendChild(psSvgG3);
    psSvgLabel.appendChild(psSvg);

    // Creating trash svg
    var trashSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
    trashSvg.setAttribute('width', '24px');
    trashSvg.setAttribute('height', '24px');
    trashSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
    trashSvg.setAttribute('fill', 'none');
    trashSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    trashSvg.setAttribute('stroke', '#000000');

    var trashSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
    trashSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
    trashSvgG.setAttribute('stroke-width', '0');

    var trashSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    trashSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
    trashSvgG2.setAttribute('stroke-linecap', 'round');
    trashSvgG2.setAttribute('stroke-linejoin', 'round');

    var trashSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    trashSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

    var trashSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    trashSvgPath.setAttribute('fill-rule', 'evenodd');
    trashSvgPath.setAttribute('clip-rule', 'evenodd');
    trashSvgPath.setAttribute('d', 'M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z');
    trashSvgPath.setAttribute('fill', '#000000');
    trashSvg.appendChild(trashSvgG);
    trashSvg.appendChild(trashSvgG2);
    trashSvgG3.appendChild(trashSvgPath);
    trashSvg.appendChild(trashSvgG3);

    // Creating the div for the TPs
    var div = document.createElement("div");
    div.classList =
      "bg-base-100 rounded-lg shadow-xl my-5 p-8 tp-div tp-fields tp-fields-" +
      tpCount;
    div.id = "tp-fields-" + tpCount;
    // Creating the label for tp
    var tpLabel = document.createElement("p");
    tpLabel.classList = "";
    tpLabel.id = "tp-label-" + tpCount;
    tpLabel.innerText = "TP price";
    // Creating the label for tpp
    var tppLabel = document.createElement("p");
    tppLabel.classList = "";
    tppLabel.id = "tpp-label-" + tpCount;
    tppLabel.innerText = "TP percentage";
    // Creating the tp input
    var tpInput = document.createElement("input");
    tpInput.classList = "input input-bordered input-primary mb-3 w-full";
    tpInput.id = "tp-input-" + tpCount;
    tpInput.name = "tp-input-" + tpCount;
    tpInput.type = "number";
    tpInput.placeholder = "63369";
    tpInput.step = ".0001";
    tpInput.min = ".0001";
    tpInput.required = true;
    // Creating the tpp input
    var tppInput = document.createElement("input");
    tppInput.classList = "input input-bordered input-primary mb-3 w-full";
    tppInput.id = "tpp-input-" + tpCount;
    tppInput.name = "tpp-input-" + tpCount;
    tppInput.type = "number";
    tppInput.placeholder = "30";
    tppInput.step = ".0001";
    tppInput.min = ".0001";
    tppInput.required = true;
    // Creating the tp delete button
    var tpBtn = document.createElement("button");
    var tpBtnI = document.createElement("i");
    tpBtnI.classList = "bi bi-trash-fill";
    tpBtn.classList = "remove-fields mt-2 btn btn-error shadow-xl w-full";
    tpBtn.type = "button";
    tpBtn.id = "tpBtn-" + tpCount;
    tpBtn.appendChild(trashSvg);
    tpBtn.innerHTML += " Delete TP";
    // Creating $ and %
    var psI = document.createElement("i");
    psI.classList = "bi bi-percent";
    var dsI = document.createElement("i");
    dsI.classList = "bi bi-currency-dollar";
    var ds = document.createElement("span");
    ds.classList = "place-content-center mr-2";
    ds.appendChild(dsI);
    var ps = document.createElement("span");
    ps.classList = "place-content-center mr-2";
    ps.appendChild(psI);

    // Row
    var row = document.createElement("div");
    row.classList = "flex";
    // Flex div for tp input
    var inputFlexTp = document.createElement("div");
    inputFlexTp.classList = "flex place-content-center mb-3";
    inputFlexTp.appendChild(dsSvgLabel);
    inputFlexTp.appendChild(tpInput);
    // Flex div for tpp input
    var inputFlexTpp = document.createElement("div");
    inputFlexTpp.classList = "flex place-content-center mb-3";
    inputFlexTpp.appendChild(psSvgLabel);
    inputFlexTpp.appendChild(tppInput);

    // Adding all of these together
    div.appendChild(tpLabel);
    div.appendChild(inputFlexTp);
    div.appendChild(tppLabel);
    div.appendChild(inputFlexTpp);
    div.appendChild(tpBtn);
    row.appendChild(div);
    // Putting them into the fields div
    $fields.prepend($(row));
  });

  // Function to add SL as TP when user wants to
  $form.on("click", ".add-fields-sl", function() {
    // Setting the unique tpCount per sl as tp
    if (slTpCount === 0) {
      slTpCount += 1;
      // Creating $ svg label
      var dsSvgLabel = document.createElement("label");
      dsSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

      // Creating $ svg
      var dsSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
      dsSvg.setAttribute('width', '24px');
      dsSvg.setAttribute('height', '24px');
      dsSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
      dsSvg.setAttribute('fill', 'none');
      dsSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      dsSvg.setAttribute('stroke', '#ffffff');

      var dsSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
      dsSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
      dsSvgG.setAttribute('stroke-width', '0');

      var dsSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
      dsSvgG2.setAttribute('stroke-linecap', 'round');
      dsSvgG2.setAttribute('stroke-linejoin', 'round');

      var dsSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

      var dsSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
      dsSvgPath.setAttribute('fill-rule', 'evenodd');
      dsSvgPath.setAttribute('clip-rule', 'evenodd');
      dsSvgPath.setAttribute('d', 'M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z');
      dsSvgPath.setAttribute('fill', '#ffffff');
      dsSvg.appendChild(dsSvgG);
      dsSvg.appendChild(dsSvgG2);
      dsSvgG3.appendChild(dsSvgPath);
      dsSvg.appendChild(dsSvgG3);
      dsSvgLabel.appendChild(dsSvg);

      // Creating % svg label
      var psSvgLabel = document.createElement("label");
      psSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

      // Creating % svg
      var psSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
      psSvg.setAttribute('width', '24px');
      psSvg.setAttribute('height', '24px');
      psSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
      psSvg.setAttribute('fill', 'none');
      psSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      psSvg.setAttribute('stroke', '#ffffff');

      var psSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
      psSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
      psSvgG.setAttribute('stroke-width', '0');

      var psSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      psSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
      psSvgG2.setAttribute('stroke-linecap', 'round');
      psSvgG2.setAttribute('stroke-linejoin', 'round');

      var psSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      psSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

      var psSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
      psSvgPath.setAttribute('fill-rule', 'evenodd');
      psSvgPath.setAttribute('clip-rule', 'evenodd');
      psSvgPath.setAttribute('d', 'M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z');
      psSvgPath.setAttribute('fill', '#ffffff');
      psSvg.appendChild(psSvgG);
      psSvg.appendChild(psSvgG2);
      psSvgG3.appendChild(psSvgPath);
      psSvg.appendChild(psSvgG3);
      psSvgLabel.appendChild(psSvg);

      // Creating trash svg
      var trashSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
      trashSvg.setAttribute('width', '24px');
      trashSvg.setAttribute('height', '24px');
      trashSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
      trashSvg.setAttribute('fill', 'none');
      trashSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      trashSvg.setAttribute('stroke', '#000000');

      var trashSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
      trashSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
      trashSvgG.setAttribute('stroke-width', '0');

      var trashSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      trashSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
      trashSvgG2.setAttribute('stroke-linecap', 'round');
      trashSvgG2.setAttribute('stroke-linejoin', 'round');

      var trashSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      trashSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

      var trashSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
      trashSvgPath.setAttribute('fill-rule', 'evenodd');
      trashSvgPath.setAttribute('clip-rule', 'evenodd');
      trashSvgPath.setAttribute('d', 'M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z');
      trashSvgPath.setAttribute('fill', '#000000');
      trashSvg.appendChild(trashSvgG);
      trashSvg.appendChild(trashSvgG2);
      trashSvgG3.appendChild(trashSvgPath);
      trashSvg.appendChild(trashSvgG3);

      // Creating the div for the SL as TP
      var slDiv = document.createElement("div");
      slDiv.classList = "bg-base-100 rounded-lg shadow-xl my-5 p-8 sl-tp-div sl-tp-fields tp-sl-field";
      slDiv.id = "tp-sl-field";
      // Creating the label for sl as tp
      var slTpLabel = document.createElement("label");
      slTpLabel.classList = "";
      slTpLabel.id = "tp-sl-label";
      slTpLabel.innerText = "SL price";
      // Creating the label for sl tpp
      var slTppLabel = document.createElement("label");
      slTppLabel.classList = "";
      slTppLabel.id = "tpp-sl-label";
      slTppLabel.innerText = "SL percentage";
      // Creating the sl as tp input
      var slTpInput = document.createElement("input");
      slTpInput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
      slTpInput.id = "tp-sl-input";
      slTpInput.name = "tp-sl-input";
      slTpInput.type = "number";
      slTpInput.placeholder = "63369";
      slTpInput.step = ".0001";
      slTpInput.min = ".0001";
      slTpInput.required = true;
      // Creating the sl tpp input
      var slTppInput = document.createElement("input");
      slTppInput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
      slTppInput.id = "tpp-sl-input";
      slTppInput.name = "tpp-sl-input";
      slTppInput.type = "number";
      slTppInput.placeholder = "30";
      slTppInput.step = ".0001";
      slTppInput.min = ".0001";
      slTppInput.required = true;
      // Creating the sl as tp delete button
      var slTpBtn = document.createElement("button");
      var slTpBtnI = document.createElement("i");
      slTpBtnI.classList = "bi bi-trash-fill";
      slTpBtn.classList = "remove-sl-tp-fields mt-2 btn btn-error shadow-xl w-full";
      slTpBtn.type = "button";
      slTpBtn.id = "slTpBtn";
      slTpBtn.appendChild(trashSvg);
      slTpBtn.innerHTML += " Delete SL";
      // Creating $ and %
      var slDs = document.createElement("span");
      var slDsI = document.createElement("i");
      slDsI.classList = "bi bi-percent";
      var slPsI = document.createElement("i");
      slPsI.classList = "bi bi-currency-dollar";
      slDs.classList = "place-content-center mr-2";
      slDs.appendChild(slPsI);
      var slPs = document.createElement("span");
      slPs.classList = "place-content-center mr-2";
      slPs.appendChild(slDsI);

      // SL Row
      var slRow = document.createElement("div");
      slRow.classList = "flex";
      // Flex div for tp input
      var inputFlexSlTp = document.createElement("div");
      inputFlexSlTp.classList = "flex place-content-center mb-3";
      inputFlexSlTp.appendChild(dsSvgLabel);
      inputFlexSlTp.appendChild(slTpInput);
      // Flex div for tpp input
      var inputFlexSlTpp = document.createElement("div");
      inputFlexSlTpp.classList = "flex place-content-center mb-3";
      inputFlexSlTpp.appendChild(psSvgLabel);
      inputFlexSlTpp.appendChild(slTppInput);

      // Adding all of these together
      slDiv.appendChild(slTpLabel);
      slDiv.appendChild(inputFlexSlTp);
      slDiv.appendChild(slTppLabel);
      slDiv.appendChild(inputFlexSlTpp);
      slDiv.appendChild(slTpBtn);
      slRow.appendChild(slDiv);
      // Putting them into the fields div
      $fields.prepend($(slRow));
    } else {
      // Display error if there is already a SL as TP added
      let $error = $("#error");

      $error.removeClass("hidden").html("Maximum 1 SL allowed.");
      setTimeout(function() {
        errorToHide = document.getElementById("error");
        errorToHide.classList.add("hidden");
      }, 3000);
    }
  });

  // Function to remove TPs when user wants to
  $form.on("click", ".remove-fields", function(event) {
    $(event.target).closest(".tp-fields").remove();
  });

  // Function to remove SL as TPs when user wants to
  $form.on("click", ".remove-sl-tp-fields", function(event) {
    slTpCount -= 1;
    $(event.target).closest(".sl-tp-fields").remove();
  });

  // If toggled on show the extra fields
  $levForm.on("click", "#kacheckbox", function() {
    if (document.getElementById("kacheckbox").checked === true) {
      // Creating $ svg label
      var dsSvgLabel = document.createElement("label");
      dsSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

      // Creating $ svg
      var dsSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
      dsSvg.setAttribute('width', '24px');
      dsSvg.setAttribute('height', '24px');
      dsSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
      dsSvg.setAttribute('fill', 'none');
      dsSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      dsSvg.setAttribute('stroke', '#ffffff');

      var dsSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
      dsSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
      dsSvgG.setAttribute('stroke-width', '0');

      var dsSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
      dsSvgG2.setAttribute('stroke-linecap', 'round');
      dsSvgG2.setAttribute('stroke-linejoin', 'round');

      var dsSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

      var dsSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
      dsSvgPath.setAttribute('fill-rule', 'evenodd');
      dsSvgPath.setAttribute('clip-rule', 'evenodd');
      dsSvgPath.setAttribute('d', 'M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z');
      dsSvgPath.setAttribute('fill', '#ffffff');
      dsSvg.appendChild(dsSvgG);
      dsSvg.appendChild(dsSvgG2);
      dsSvgG3.appendChild(dsSvgPath);
      dsSvg.appendChild(dsSvgG3);
      dsSvgLabel.appendChild(dsSvg);
      // Creating $ svg label2
      var dsSvg2Label = document.createElement("label");
      dsSvg2Label.setAttribute('class', 'input input-bordered items-center flex');

      // Creating $ svg2
      var dsSvg2 = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
      dsSvg2.setAttribute('width', '24px');
      dsSvg2.setAttribute('height', '24px');
      dsSvg2.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
      dsSvg2.setAttribute('fill', 'none');
      dsSvg2.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
      dsSvg2.setAttribute('stroke', '#ffffff');

      var dsSvg2G = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
      dsSvg2G.setAttribute('id', 'SVGRepo_bgCarrier');
      dsSvg2G.setAttribute('stroke-width', '0');

      var dsSvg2G2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvg2G2.setAttribute('id', 'SVGRepo_tracerCarrier');
      dsSvg2G2.setAttribute('stroke-linecap', 'round');
      dsSvg2G2.setAttribute('stroke-linejoin', 'round');

      var dsSvg2G3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
      dsSvg2G3.setAttribute('id', 'SVGRepo_iconCarrier');

      var dsSvg2Path = document.createElementNS("http://www.w3.org/2000/svg", "path");
      dsSvg2Path.setAttribute('fill-rule', 'evenodd');
      dsSvg2Path.setAttribute('clip-rule', 'evenodd');
      dsSvg2Path.setAttribute('d', 'M13 3.5C13 2.94772 12.5523 2.5 12 2.5C11.4477 2.5 11 2.94772 11 3.5V4.0592C9.82995 4.19942 8.75336 4.58509 7.89614 5.1772C6.79552 5.93745 6 7.09027 6 8.5C6 9.77399 6.49167 10.9571 7.5778 11.7926C8.43438 12.4515 9.58764 12.8385 11 12.959V17.9219C10.2161 17.7963 9.54046 17.5279 9.03281 17.1772C8.32378 16.6874 8 16.0903 8 15.5C8 14.9477 7.55228 14.5 7 14.5C6.44772 14.5 6 14.9477 6 15.5C6 16.9097 6.79552 18.0626 7.89614 18.8228C8.75336 19.4149 9.82995 19.8006 11 19.9408V20.5C11 21.0523 11.4477 21.5 12 21.5C12.5523 21.5 13 21.0523 13 20.5V19.9435C14.1622 19.8101 15.2376 19.4425 16.0974 18.8585C17.2122 18.1013 18 16.9436 18 15.5C18 14.1934 17.5144 13.0022 16.4158 12.1712C15.557 11.5216 14.4039 11.1534 13 11.039V6.07813C13.7839 6.20366 14.4596 6.47214 14.9672 6.82279C15.6762 7.31255 16 7.90973 16 8.5C16 9.05228 16.4477 9.5 17 9.5C17.5523 9.5 18 9.05228 18 8.5C18 7.09027 17.2045 5.93745 16.1039 5.17721C15.2467 4.58508 14.1701 4.19941 13 4.0592V3.5ZM11 6.07814C10.2161 6.20367 9.54046 6.47215 9.03281 6.8228C8.32378 7.31255 8 7.90973 8 8.5C8 9.22601 8.25834 9.79286 8.79722 10.2074C9.24297 10.5503 9.94692 10.8384 11 10.9502V6.07814ZM13 13.047V17.9263C13.7911 17.8064 14.4682 17.5474 14.9737 17.204C15.6685 16.7321 16 16.1398 16 15.5C16 14.7232 15.7356 14.1644 15.2093 13.7663C14.7658 13.4309 14.0616 13.1537 13 13.047Z');
      dsSvg2Path.setAttribute('fill', '#ffffff');
      dsSvg2.appendChild(dsSvg2G);
      dsSvg2.appendChild(dsSvg2G2);
      dsSvg2G3.appendChild(dsSvg2Path);
      dsSvg2.appendChild(dsSvg2G3);
      dsSvg2Label.appendChild(dsSvg2);
      // First input field
      var kalabel = document.createElement("label");
      kalabel.id = "kalabel";
      kalabel.classList = "";
      kalabel.innerText = "Account size";
      var kadiv = document.createElement("div");
      kadiv.classList = "flex";
      kadiv.id = "kadiv";
      var kaspan = document.createElement("span");
      kaspan.classList = "place-content-center";
      var kai = document.createElement("i");
      kai.classList = "bi bi-currency-dollar";
      var kabopinput = document.createElement("input");
      kabopinput.type = "number";
      kabopinput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
      kabopinput.placeholder = "500";
      kabopinput.id = "kabop";
      kabopinput.name = "kabop";
      kabopinput.step = "0.0001";
      kabopinput.min = "0.0001";
      kabopinput.required = true;
      kaspan.appendChild(kai);
      kadiv.appendChild(dsSvg2Label);
      kadiv.appendChild(kabopinput);
      // Second input field
      var kalabel2 = document.createElement("label");
      kalabel2.id = "kalabel2";
      kalabel2.classList = "";
      kalabel2.innerText = "Account size to risk";
      var kadiv2 = document.createElement("div");
      kadiv2.classList = "flex";
      kadiv2.id = "kadiv2";
      var kaspan2 = document.createElement("span");
      kaspan2.classList = "place-content-center";
      var kai2 = document.createElement("i");
      kai2.classList = "bi bi-currency-dollar";
      var kabopinput2 = document.createElement("input");
      kabopinput2.type = "number";
      kabopinput2.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
      kabopinput2.placeholder = "5000";
      kabopinput2.id = "kabor";
      kabopinput2.name = "kabor";
      kabopinput2.step = "0.0001";
      kabopinput2.min = "0.0001";
      kabopinput2.required = true;
      kaspan2.appendChild(kai2);
      kadiv2.appendChild(dsSvgLabel);
      kadiv2.appendChild(kabopinput2);
      // Add them to the row
      $levrow.append(kalabel);
      $levrow.append(kadiv);
      $levrow.append(kalabel2);
      $levrow.append(kadiv2);
    } else if (document.getElementById("kacheckbox").checked === false) {
      $("#kalabel").remove();
      $("#kadiv").remove();
      $("#kalabel2").remove();
      $("#kadiv2").remove();
    }
  });

  // Function to add TPs when user wants to
  $tpForm.on("click", ".add-tp-fields", function() {
    // Setting the unique tpCount per tp
    positieTpCount += 1;

    // Creating % svg label
    var psSvgLabel = document.createElement("label");
    psSvgLabel.setAttribute('class', 'input input-bordered items-center flex');

    // Creating % svg
    var psSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
    psSvg.setAttribute('width', '24px');
    psSvg.setAttribute('height', '24px');
    psSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
    psSvg.setAttribute('fill', 'none');
    psSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    psSvg.setAttribute('stroke', '#ffffff');

    var psSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
    psSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
    psSvgG.setAttribute('stroke-width', '0');

    var psSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    psSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
    psSvgG2.setAttribute('stroke-linecap', 'round');
    psSvgG2.setAttribute('stroke-linejoin', 'round');

    var psSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    psSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

    var psSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    psSvgPath.setAttribute('fill-rule', 'evenodd');
    psSvgPath.setAttribute('clip-rule', 'evenodd');
    psSvgPath.setAttribute('d', 'M8 6C6.89543 6 6 6.89543 6 8C6 9.10457 6.89543 10 8 10C9.10457 10 10 9.10457 10 8C10 6.89543 9.10457 6 8 6ZM4 8C4 5.79086 5.79086 4 8 4C10.2091 4 12 5.79086 12 8C12 10.2091 10.2091 12 8 12C5.79086 12 4 10.2091 4 8ZM17 15C15.8954 15 15 15.8954 15 17C15 18.1046 15.8954 19 17 19C18.1046 19 19 18.1046 19 17C19 15.8954 18.1046 15 17 15ZM13 17C13 14.7909 14.7909 13 17 13C19.2091 13 21 14.7909 21 17C21 19.2091 19.2091 21 17 21C14.7909 21 13 19.2091 13 17ZM19.7071 6.70711C20.0976 6.31658 20.0976 5.68342 19.7071 5.29289C19.3166 4.90237 18.6834 4.90237 18.2929 5.29289L5.29289 18.2929C4.90237 18.6834 4.90237 19.3166 5.29289 19.7071C5.68342 20.0976 6.31658 20.0976 6.70711 19.7071L19.7071 6.70711Z');
    psSvgPath.setAttribute('fill', '#ffffff');
    psSvg.appendChild(psSvgG);
    psSvg.appendChild(psSvgG2);
    psSvgG3.appendChild(psSvgPath);
    psSvg.appendChild(psSvgG3);
    psSvgLabel.appendChild(psSvg);

    // Creating trash svg
    var trashSvg = document.createElementNS("http://www.w3.org/2000/svg", "svg"); // Correct namespace
    trashSvg.setAttribute('width', '24px');
    trashSvg.setAttribute('height', '24px');
    trashSvg.setAttribute('viewBox', '0 0 24 24'); // Note: viewBox should start with a capital 'B'
    trashSvg.setAttribute('fill', 'none');
    trashSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
    trashSvg.setAttribute('stroke', '#000000');

    var trashSvgG = document.createElementNS("http://www.w3.org/2000/svg", "g"); // Namespace for groups
    trashSvgG.setAttribute('id', 'SVGRepo_bgCarrier');
    trashSvgG.setAttribute('stroke-width', '0');

    var trashSvgG2 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    trashSvgG2.setAttribute('id', 'SVGRepo_tracerCarrier');
    trashSvgG2.setAttribute('stroke-linecap', 'round');
    trashSvgG2.setAttribute('stroke-linejoin', 'round');

    var trashSvgG3 = document.createElementNS("http://www.w3.org/2000/svg", "g");
    trashSvgG3.setAttribute('id', 'SVGRepo_iconCarrier');

    var trashSvgPath = document.createElementNS("http://www.w3.org/2000/svg", "path");
    trashSvgPath.setAttribute('fill-rule', 'evenodd');
    trashSvgPath.setAttribute('clip-rule', 'evenodd');
    trashSvgPath.setAttribute('d', 'M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z');
    trashSvgPath.setAttribute('fill', '#000000');
    trashSvg.appendChild(trashSvgG);
    trashSvg.appendChild(trashSvgG2);
    trashSvgG3.appendChild(trashSvgPath);
    trashSvg.appendChild(trashSvgG3);

    // Creating the div for the TPs
    var tpDiv = document.createElement("div");
    tpDiv.classList =
      "bg-base-100 rounded-lg shadow-xl my-5 p-8 positie-tp-div positie-tp-fields positie-tp-fields-" +
      positieTpCount;
    tpDiv.id = "positie-tp-fields-" + positieTpCount;
    // Creating the label for tpp
    var positieTppLabel = document.createElement("p");
    positieTppLabel.classList = "";
    positieTppLabel.id = "positie-tpp-label-" + positieTpCount;
    positieTppLabel.innerText = "TP percentage";
    // Creating the tpp input
    var positieTppInput = document.createElement("input");
    positieTppInput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
    positieTppInput.id = "positie-tpp-input-" + positieTpCount;
    positieTppInput.name = "positie-tpp-input-" + positieTpCount;
    positieTppInput.type = "number";
    positieTppInput.placeholder = "30";
    positieTppInput.step = ".0001";
    positieTppInput.min = ".0001";
    positieTppInput.required = true;
    // Creating the tp delete button
    var positieTpBtn = document.createElement("button");
    var positieTpBtnI = document.createElement("i");
    positieTpBtnI.classList = "bi bi-trash-fill";
    positieTpBtn.classList = "remove-tp-fields m-2 btn btn-error shadow-xl w-full";
    positieTpBtn.type = "button";
    positieTpBtn.id = "positieTpBtn-" + positieTpCount;
    positieTpBtn.appendChild(trashSvg);
    positieTpBtn.innerHTML += " Delete TP";
    // Creating $ and %
    var tpPsI = document.createElement("i");
    tpPsI.classList = "bi bi-percent";
    var tpPs = document.createElement("span");
    tpPs.classList = "place-content-center mr-2";
    tpPs.appendChild(tpPsI);

    // Row
    var tpRow = document.createElement("div");
    tpRow.classList = "flex";
    // Flex div for tp input
    var inputFlexTpTp = document.createElement("div");
    inputFlexTpTp.classList = "flex place-content-center mb-3";
    inputFlexTpTp.appendChild(psSvgLabel);
    inputFlexTpTp.appendChild(positieTppInput);
    tpDiv.appendChild(positieTppLabel);
    tpDiv.appendChild(inputFlexTpTp);

    // Adding all of these together
    tpDiv.appendChild(positieTpBtn);
    tpRow.appendChild(tpDiv);
    // Putting them into the fields div
    $tpFields.prepend($(tpRow));
  });

  // Function to remove TPs when user wants to
  $tpForm.on("click", ".remove-tp-fields", function(event) {
    $(event.target).closest(".positie-tp-fields").remove();
  });

  // Form submit and AJAX request
  $form.on("submit", function(e) {
    e.preventDefault();

    // Getting the error en resdata div
    let $error = $("#error");
    let $resdata = $("#resdata");

    // Handling the AJAX request
    $.ajax({
      type: "GET",
      url: "api/calculate.php",
      data: $(this).serialize(),
    })
      .then(function(res) {
        let data = JSON.parse(res);
        if (data.error) {
          $error.removeClass("hidden").html(data.error);
          setTimeout(function() {
            errorToHide = document.getElementById("error");
            errorToHide.classList.add("hidden");
          }, 3000);
          return;
        } else if (data.resdata) {
          $resdata.removeClass("hidden").html("Total final RR: " + data.rr);
          return;
        }
      })
      .fail(function(res) {
        let data = JSON.parse(res);
        $error.removeClass("hidden").html(data.error);
        setTimeout(function() {
          errorToHide = document.getElementById("error");
          errorToHide.classList.add("hidden");
        }, 3000);
      });
  });

  // LevForm submit and AJAX request
  $levForm.on("submit", function(e) {
    e.preventDefault();

    // Getting the error en resdata div
    let $error = $("#error");
    let $levdata = $("#levdata");

    // Handling the AJAX request
    $.ajax({
      type: "GET",
      url: "api/calculate.php",
      data: $(this).serialize(),
    })
      .then(function(res) {
        console.log(res);
        let data = JSON.parse(res);
        if (data.error) {
          $error.removeClass("hidden").html(data.error);
          return;
        } else if (data.levdata) {
          if (typeof data.bedrag !== "undefined") {
            $levdata
              .removeClass("hidden")
              .html(
                "Leverage: " + data.lev + "<br>" +
                "Position size: " + data.bedrag + "<br>" +
                "Risk amount: " + data.rbedrag,
              );
          } else if (typeof data.bedrag === "undefined") {
            $levdata.removeClass("hidden").html("Leverage: " + data.lev);
          }
          return;
        }
      })
      .fail(function() {
        $error.removeClass("hidden").html(data.error);
      });
  });

  // Form submit and AJAX request
  $tpForm.on("submit", function(e) {
    e.preventDefault();

    // Getting the error en resdata div
    let $error = $("#error");
    let $tpdata = $("#tpdata");

    // Handling the AJAX request
    $.ajax({
      type: "GET",
      url: "api/calculate.php",
      data: $(this).serialize(),
    })
      .then(function(res) {
        let data = JSON.parse(res);
        if (data.error) {
          $error.removeClass("hidden").html(data.error);
          setTimeout(function() {
            errorToHide = document.getElementById("error");
            errorToHide.classList.add("hidden");
          }, 3000);
          return;
        } else if (data.tpdata) {
          // Join the array of TP strings into a single string and display it
          $tpdata.removeClass("hidden").html("TPs size: <br>" +
            data.tps.join("<br>")  // Use join to display each element on a new line
          );
          return;
        }
      })
      .fail(function(res) {
        let data = JSON.parse(res);
        $error.removeClass("hidden").html(data.error);
        setTimeout(function() {
          errorToHide = document.getElementById("error");
          errorToHide.classList.add("hidden");
        }, 3000);
      });
  });

  const element = document.getElementById('loadUsdtItems');

  if (element) {
    document.getElementById('loadUsdtItems').addEventListener('click', function() {
      // Handling the AJAX request
      $.ajax({
        type: "GET",
        url: "api/phemex.php",
      })
        .then(function(res) {
          let data = JSON.parse(res);
        })
        .fail(function(res) {
          let data = JSON.parse(res);
        });

      itemsContainer.innerHTML = `
    <div class="card bg-base-100 shadow-xl mb-5">
      <div class="card-header p-5 shadow-xl">
        <div class="flex justify-between">
          <h5 class="flex justify-start"> $side </h5>
          <h5 class="flex justify-center"> $symbol </h5>
          <h5 class="flex justify-end"> $entryTransactTime </h5>
        </div>
      </div>
      <div class="card-body flex mx-auto w-full">
        <div class="border border-white shadow-xl rounded-box p-5 my-5 justify-items-center">
          <div class="flex place-content-center w-2/3">
            <div class="flex flex-col w-1/2">
              $RR <br>
              <br>
              $SL prijs <br>
              <br>
              $Laatste order <br>
              <br>
            </div>
            <div class="flex flex-col w-1/2">
              $rr <br>
              <br>
              $slPrijs <br>
              <br>
              $lD <br>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  `;

      // Remove the 'hidden' class to show the container
      document.getElementById('usdtItemsContainer').classList.remove('hidden');
    });

    document.getElementById('loadInverseItems').addEventListener('click', function() {
      // Handling the AJAX request
      $.ajax({
        type: "GET",
        url: "api/phemex.php",
      })
        .then(function(res) {
          let data = JSON.parse(res);
        })
        .fail(function(res) {
          let data = JSON.parse(res);
        });

      itemsContainer.innerHTML = `
    <div class="card bg-base-100 shadow-xl mb-5">
      <div class="card-header p-5 shadow-xl">
        <div class="flex justify-between">
          <h5 class="flex justify-start"> $side </h5>
          <h5 class="flex justify-center"> $symbol </h5>
          <h5 class="flex justify-end"> $entryTransactTime </h5>
        </div>
      </div>
      <div class="card-body flex mx-auto w-full">
        <div class="border border-white shadow-xl rounded-box p-5 my-5 justify-items-center">
          <div class="flex place-content-center w-2/3">
            <div class="flex flex-col w-1/2">
              $RR <br>
              <br>
              $SL prijs <br>
              <br>
              $Laatste order <br>
              <br>
            </div>
            <div class="flex flex-col w-1/2">
              $rr <br>
              <br>
              $slPrijs <br>
              <br>
              $lD <br>
              <br>
            </div>
          </div>
        </div>
      </div>
    </div>
    <br>
  `;

      // Remove the 'hidden' class to show the container
      document.getElementById('inverseItemsContainer').classList.remove('hidden');
    });
  }
});
