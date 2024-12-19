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

    // Creating the div for the TPs
    var div = document.createElement("div");
    div.classList =
      "bg-base-100 rounded-lg shadow-xl tp-div my-5 p-8 tp-fields tp-fields-" +
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
    tpInput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
    tpInput.id = "tp-input-" + tpCount;
    tpInput.name = "tp-input-" + tpCount;
    tpInput.type = "number";
    tpInput.placeholder = "63369";
    tpInput.step = ".0001";
    tpInput.min = ".0001";
    tpInput.required = true;
    // Creating the tpp input
    var tppInput = document.createElement("input");
    tppInput.classList = "input input-bordered input-primary place-content-center mb-5 w-full";
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
    tpBtn.appendChild(tpBtnI);
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
    inputFlexTp.appendChild(ds);
    inputFlexTp.appendChild(tpInput);
    // Flex div for tpp input
    var inputFlexTpp = document.createElement("div");
    inputFlexTpp.classList = "flex place-content-center mb-3";
    inputFlexTpp.appendChild(ps);
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
      slTpBtn.appendChild(slTpBtnI);
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
      inputFlexSlTp.appendChild(slDs);
      inputFlexSlTp.appendChild(slTpInput);
      // Flex div for tpp input
      var inputFlexSlTpp = document.createElement("div");
      inputFlexSlTpp.classList = "flex place-content-center mb-3";
      inputFlexSlTpp.appendChild(slPs);
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

      $error.removeClass("d-none").html("Je kan maximaal 1 SL meegeven.");
      setTimeout(function() {
        errorToHide = document.getElementById("error");
        errorToHide.classList.add("d-none");
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
      // First input field
      var kalabel = document.createElement("label");
      kalabel.for = "kabop";
      kalabel.id = "kalabel";
      kalabel.classList = "text-start mt-4";
      kalabel.innerText = "Bedrag op account";
      var kadiv = document.createElement("div");
      kadiv.classList = "input-group";
      kadiv.id = "kadiv";
      var kadivdiv = document.createElement("div");
      kadivdiv.classList = "input-group-prepend";
      var kaspan = document.createElement("span");
      kaspan.classList = "input-group-text";
      var kai = document.createElement("i");
      kai.classList = "bi bi-currency-dollar";
      var kabopinput = document.createElement("input");
      kabopinput.type = "number";
      kabopinput.classList = "form-control";
      kabopinput.placeholder = "500";
      kabopinput.id = "kabop";
      kabopinput.name = "kabop";
      kabopinput.step = "0.0001";
      kabopinput.min = "0.0001";
      kabopinput.required = true;
      kaspan.appendChild(kai);
      kadivdiv.appendChild(kaspan);
      kadiv.appendChild(kadivdiv);
      kadiv.appendChild(kabopinput);
      // Second input field
      var kalabel2 = document.createElement("label");
      kalabel2.for = "kabor";
      kalabel2.id = "kalabel2";
      kalabel2.classList = "text-start mt-4";
      kalabel2.innerText = "Bedrag waar je risico op wilt lopen";
      var kadiv2 = document.createElement("div");
      kadiv2.classList = "input-group";
      kadiv2.id = "kadiv2";
      var kadivdiv2 = document.createElement("div");
      kadivdiv2.classList = "input-group-prepend";
      var kaspan2 = document.createElement("span");
      kaspan2.classList = "input-group-text";
      var kai2 = document.createElement("i");
      kai2.classList = "bi bi-currency-dollar";
      var kabopinput2 = document.createElement("input");
      kabopinput2.type = "number";
      kabopinput2.classList = "form-control";
      kabopinput2.placeholder = "5000";
      kabopinput2.id = "kabor";
      kabopinput2.name = "kabor";
      kabopinput2.step = "0.0001";
      kabopinput2.min = "0.0001";
      kabopinput2.required = true;
      kaspan2.appendChild(kai2);
      kadivdiv2.appendChild(kaspan2);
      kadiv2.appendChild(kadivdiv2);
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

    // Creating the div for the TPs
    var tpDiv = document.createElement("div");
    tpDiv.classList =
      "flex rounded shadow-xl positie-tp-div mb-5 p-3 positie-tp-fields positie-tp-fields-" +
      positieTpCount;
    tpDiv.id = "positie-tp-fields-" + positieTpCount;
    // Creating the label for tpp
    var positieTppLabel = document.createElement("label");
    positieTppLabel.classList = "mt-4";
    positieTppLabel.setAttribute("for", "positie-tpp-input-" + positieTpCount);
    positieTppLabel.id = "positie-tpp-label-" + positieTpCount;
    positieTppLabel.innerText = "TP percentage";
    // Creating the tpp input
    var positieTppInput = document.createElement("input");
    positieTppInput.classList = "";
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
    positieTpBtn.classList = "remove-tp-fields m-2 btn btn-error shadow-xl";
    positieTpBtn.type = "button";
    positieTpBtn.id = "positieTpBtn-" + positieTpCount;
    positieTpBtn.appendChild(positieTpBtnI);
    positieTpBtn.innerHTML += " Delete TP";
    // Creating $ and %
    var tpPsI = document.createElement("i");
    tpPsI.classList = "bi bi-percent";
    var tpPs = document.createElement("span");
    tpPs.classList = "";
    tpPs.appendChild(tpPsI);
    // Tpp percentage input group div
    var tpIgdd = document.createElement("div");
    tpIgdd.classList = "";
    // Tpp input group prepend div
    var tpIgpdd = document.createElement("div");
    tpIgpdd.classList = "";
    tpIgpdd.appendChild(tpPs);
    tpIgdd.appendChild(tpIgpdd);
    tpIgdd.appendChild(positieTppInput);

    // Row
    var tpRow = document.createElement("row");

    // Adding all of these together
    tpDiv.appendChild(positieTppLabel);
    tpDiv.appendChild(tpIgdd);
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
          $error.removeClass("d-none").html(data.error);
          setTimeout(function() {
            errorToHide = document.getElementById("error");
            errorToHide.classList.add("d-none");
          }, 3000);
          return;
        } else if (data.resdata) {
          $resdata.removeClass("d-none").html("Totale eind RR: " + data.rr);
          return;
        }
      })
      .fail(function(res) {
        let data = JSON.parse(res);
        $error.removeClass("d-none").html(data.error);
        setTimeout(function() {
          errorToHide = document.getElementById("error");
          errorToHide.classList.add("d-none");
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
          $error.removeClass("d-none").html(data.error);
          return;
        } else if (data.levdata) {
          if (typeof data.bedrag !== "undefined") {
            $levdata
              .removeClass("d-none")
              .html(
                "Leverage: " +
                data.lev +
                "<br>" +
                "Positiegrootte: " +
                '<i class="bi bi-currency-dollar"></i>' +
                data.bedrag +
                "<br>" +
                "Risk bedrag: " +
                '<i class="bi bi-currency-dollar"></i>' +
                data.rbedrag,
              );
          } else if (typeof data.bedrag === "undefined") {
            $levdata.removeClass("d-none").html("Leverage: " + data.lev);
          }
          return;
        }
      })
      .fail(function() {
        $error.removeClass("d-none").html(data.error);
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
          $error.removeClass("d-none").html(data.error);
          setTimeout(function() {
            errorToHide = document.getElementById("error");
            errorToHide.classList.add("d-none");
          }, 3000);
          return;
        } else if (data.tpdata) {
          // Join the array of TP strings into a single string and display it
          $tpdata.removeClass("d-none").html("TPs grootte: <br>" +
            data.tps.join("<br>")  // Use join to display each element on a new line
          );
          return;
        }
      })
      .fail(function(res) {
        let data = JSON.parse(res);
        $error.removeClass("d-none").html(data.error);
        setTimeout(function() {
          errorToHide = document.getElementById("error");
          errorToHide.classList.add("d-none");
        }, 3000);
      });
  });

  $(function() {
    $("#draggablePanelList, #draggablePanelList2, #draggablePanelList3")
      .sortable({
        connectWith: ".connectedSortable",
        handle: ".panel-heading",
      })
      .disableSelection();
  });
});
