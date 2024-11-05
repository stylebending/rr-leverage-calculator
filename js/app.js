// JS that handles creating new TPs and AJAX requests
$(function () {
    // Defining variables
    var $form = $('#my-form');
    var $levForm = $('#lev-form');
    var $kalevForm = $('#kalev-form');
    var $fields = $form.find('.fields');
    var $levrow = $('#levrow');
    var $levrowtoggle = $('#kacheckbox');
    var tpCount = 0;
    var slTpCount = 0;

    // Function to add TPs when user wants to
    $form.on('click', '.add-fields', function () {
        // Setting the unique tpCount per tp
        tpCount += 1;

        // Creating the div for the TPs
        var div = document.createElement("div");
        div.classList = "row input-group rounded shadow-lg tp-div mb-5 p-5 tp-fields tp-fields-" + tpCount;
        div.id = "tp-fields-" + tpCount;
        // Creating the label for tp
        var tpLabel = document.createElement("label");
        tpLabel.classList = "text-start";
        tpLabel.setAttribute("for", "tp-input-" + tpCount);
        tpLabel.id = "tp-label-" + tpCount;
        tpLabel.innerText = "TP bedrag"
        // Creating the label for tpp
        var tppLabel = document.createElement("label");
        tppLabel.classList = "text-start mt-4";
        tppLabel.setAttribute("for", "tpp-input-" + tpCount);
        tppLabel.id = "tpp-label-" + tpCount;
        tppLabel.innerText = "TP percentage"
        // Creating the tp input
        var tpInput = document.createElement("input");
        tpInput.classList = "form-control";
        tpInput.id = "tp-input-" + tpCount;
        tpInput.name = "tp-input-" + tpCount;
        tpInput.type = "number";
        tpInput.placeholder = "63369";
        tpInput.step = ".0001";
        tpInput.min = ".0001";
        tpInput.required = true;
        // Creating the tpp input
        var tppInput = document.createElement("input");
        tppInput.classList = "form-control";
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
        tpBtn.classList = "remove-fields m-2 btn btn-danger shadow-lg";
        tpBtn.type = "button";
        tpBtn.id = "tpBtn-" + tpCount;
        tpBtn.appendChild(tpBtnI);
        tpBtn.innerHTML += " TP verwijderen";
        // Creating $ and %
        var psI = document.createElement("i");
        psI.classList = "bi bi-percent";
        var dsI = document.createElement("i");
        dsI.classList = "bi bi-currency-dollar";
        var ds = document.createElement("span");
        ds.classList = "input-group-text";
        ds.appendChild(dsI);
        var ps = document.createElement("span");
        ps.classList = "input-group-text";
        ps.appendChild(psI);
        // Tp bedrag input group div
        var igd = document.createElement("div");
        igd.classList = "input-group";
        // Tp input group prepend div
        var igpd = document.createElement("div");
        igpd.classList = "input-group-prepend";
        igpd.appendChild(ds);
        igd.appendChild(igpd);
        igd.appendChild(tpInput);
        // Tpp percentage input group div
        var igdd = document.createElement("div");
        igdd.classList = "input-group";
        // Tpp input group prepend div
        var igpdd = document.createElement("div");
        igpdd.classList = "input-group-prepend";
        igpdd.appendChild(ps);
        igdd.appendChild(igpdd);
        igdd.appendChild(tppInput);

        // Row
        var row = document.createElement("row");

        // Adding all of these together
        div.appendChild(tpLabel);
        div.appendChild(igd);
        div.appendChild(tppLabel);
        div.appendChild(igdd);
        div.appendChild(tpBtn);
        row.appendChild(div);
        // Putting them into the fields div
        $fields.prepend($(row));
    });

    // Function to add SL as TP when user wants to
    $form.on('click', '.add-fields-sl', function () {
        // Setting the unique tpCount per sl as tp
        if (slTpCount === 0) {
            slTpCount += 1;
            // Creating the div for the SL as TP
            var slDiv = document.createElement("div");
            slDiv.classList = "row input-group rounded shadow-lg sl-tp-div mb-5 p-5 sl-tp-fields tp-sl-field";
            slDiv.id = "tp-sl-field";
            // Creating the label for sl as tp
            var slTpLabel = document.createElement("label");
            slTpLabel.classList = "text-start";
            slTpLabel.setAttribute("for", "tp-sl-input");
            slTpLabel.id = "tp-sl-label";
            slTpLabel.innerText = "SL bedrag";
            // Creating the label for sl tpp
            var slTppLabel = document.createElement("label");
            slTppLabel.classList = "text-start mt-4";
            slTppLabel.setAttribute("for", "tpp-sl-input");
            slTppLabel.id = "tpp-sl-label";
            slTppLabel.innerText = "SL percentage"
            // Creating the sl as tp input
            var slTpInput = document.createElement("input");
            slTpInput.classList = "form-control";
            slTpInput.id = "tp-sl-input";
            slTpInput.name = "tp-sl-input";
            slTpInput.type = "number";
            slTpInput.placeholder = "63369";
            slTpInput.step = ".0001";
            slTpInput.min = ".0001";
            slTpInput.required = true;
            // Creating the sl tpp input
            var slTppInput = document.createElement("input");
            slTppInput.classList = "form-control";
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
            slTpBtn.classList = "remove-sl-tp-fields m-2 btn btn-danger shadow-lg";
            slTpBtn.type = "button";
            slTpBtn.id = "slTpBtn";
            slTpBtn.appendChild(slTpBtnI);
            slTpBtn.innerHTML += " SL verwijderen";
            // Creating $ and %
            var slDs = document.createElement("span");
            var slDsI = document.createElement("i");
            slDsI.classList = "bi bi-percent";
            var slPsI = document.createElement("i");
            slPsI.classList = "bi bi-currency-dollar";
            slDs.classList = "input-group-text";
            slDs.appendChild(slPsI);
            var slPs = document.createElement("span");
            slPs.classList = "input-group-text";
            slPs.appendChild(slDsI);
            // SL as Tp bedrag input group div
            var slIgd = document.createElement("div");
            slIgd.classList = "input-group";
            // SL as Tp input group prepend div
            var slIgpd = document.createElement("div");
            slIgpd.classList = "input-group-prepend";
            slIgpd.appendChild(slDs);
            slIgd.appendChild(slIgpd);
            slIgd.appendChild(slTpInput);
            // SL Tpp percentage input group div
            var slIgdd = document.createElement("div");
            slIgdd.classList = "input-group";
            // SL Tpp input group prepend div
            var slIgpdd = document.createElement("div");
            slIgpdd.classList = "input-group-prepend";
            slIgpdd.appendChild(slPs);
            slIgdd.appendChild(slIgpdd);
            slIgdd.appendChild(slTppInput);

            // SL Row
            var slRow = document.createElement("row");

            // Adding all of these together
            slDiv.appendChild(slTpLabel);
            slDiv.appendChild(slIgd);
            slDiv.appendChild(slTppLabel);
            slDiv.appendChild(slIgdd);
            slDiv.appendChild(slTpBtn);
            slRow.appendChild(slDiv);
            // Putting them into the fields div
            $fields.prepend($(slRow));
        } else {
            // Display error if there is already a SL as TP added
            let $error = $('#error');

            $error.removeClass('d-none').html('Je kan maximaal 1 SL meegeven.');
            setTimeout(function () {
                errorToHide = document.getElementById("error");
                errorToHide.classList.add("d-none");
            }, 3000);
        }
    });

    // Function to remove TPs when user wants to
    $form.on('click', '.remove-fields', function (event) {
        $(event.target).closest('.tp-fields').remove();
    });

    // Function to remove SL as TPs when user wants to
    $form.on('click', '.remove-sl-tp-fields', function (event) {
        slTpCount -= 1;
        $(event.target).closest('.sl-tp-fields').remove();
    });

    // If toggled on show the extra fields
    $levForm.on('click', '#kacheckbox', function () {
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
            $('#kalabel').remove();
            $('#kadiv').remove();
            $('#kalabel2').remove();
            $('#kadiv2').remove();
        }
    });

    // Form submit and AJAX request
    $form.on('submit', function (e) {
        e.preventDefault();

        // Getting the error en resdata div
        let $error = $('#error');
        let $resdata = $('#resdata');

        // Handling the AJAX request
        $.ajax({
            type: 'GET',
            url: 'api/calculate.php',
            data: $(this).serialize()
        }).then(function (res) {
            let data = JSON.parse(res);
            if (data.error) {
                $error.removeClass('d-none').html(data.error);
                setTimeout(function () {
                    errorToHide = document.getElementById("error");
                    errorToHide.classList.add("d-none");
                }, 3000);
                return;
            } else if (data.resdata) {
                $resdata.removeClass('d-none').html(
                    "Totale eind RR: " + data.rr
                );
                return;
            }
        }).fail(function (res) {
            let data = JSON.parse(res);
            $error.removeClass('d-none').html(data.error);
            setTimeout(function () {
                errorToHide = document.getElementById("error");
                errorToHide.classList.add("d-none");
            }, 3000);
        });
    });

    // LevForm submit and AJAX request
    $levForm.on('submit', function (e) {
        e.preventDefault();

        // Getting the error en resdata div
        let $error = $('#error');
        let $levdata = $('#levdata');

        // Handling the AJAX request
        $.ajax({
            type: 'GET',
            url: 'api/calculate.php',
            data: $(this).serialize()
        }).then(function (res) {
            console.log(res);
            let data = JSON.parse(res);
            if (data.error) {
                $error.removeClass('d-none').html(data.error);
                return;
            } else if (data.levdata) {
                if (typeof data.bedrag !== 'undefined') {
                    $levdata.removeClass('d-none').html(
                        "Leverage: " + data.lev + "<br>" +
                        "Positiegrootte: " + '<i class="bi bi-currency-dollar"></i>' + data.bedrag
                    );
                } else if (typeof data.bedrag === 'undefined') {
                    $levdata.removeClass('d-none').html(
                        "Leverage: " + data.lev
                    );
                }
                return;
            }
        }).fail(function (res) {
            $error.removeClass('d-none').html(data.error);
        });
    });

    // KaLevForm submit and AJAX request
    $kalevForm.on('submit', function (e) {
        e.preventDefault();

        // Getting the error en resdata div
        let $error = $('#error');
        let $levdata = $('#levdata');

        // Handling the AJAX request
        $.ajax({
            type: 'GET',
            url: 'api/calculate.php',
            data: $(this).serialize()
        }).then(function (res) {
            console.log(res);
            let data = JSON.parse(res);
            if (data.error) {
                $error.removeClass('d-none').html(data.error);
                return;
            } else if (data.kalevdata) {
                $kalevdata.removeClass('d-none').html(
                    "Leverage: " + data.kalev + "<br>" +
                    "Positiegrootte: " + '<i class="bi bi-currency-dollar"></i>' + data.bedrag
                );
                return;
            }
        }).fail(function (res) {
            $error.removeClass('d-none').html(data.error);
        });
    });

    // Code below makes the right column panels draggable
    jQuery(function ($) {
        var panelList = $('#draggablePanelList');

        panelList.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
            handle: '.panel-heading',
            update: function () {
                $('.panel', panelList).each(function (index, elem) {
                    var $listItem = $(elem),
                        newIndex = $listItem.index();

                    // Persist the new indices.
                });
            }
        });
    });

    jQuery(function ($) {
        var panelList2 = $('#draggablePanelList2');

        panelList2.sortable({
            // Only make the .panel-heading child elements support dragging.
            // Omit this to make then entire <li>...</li> draggable.
            handle: '.panel-heading',
            update: function () {
                $('.panel', panelList2).each(function (index, elem) {
                    var $listItem = $(elem),
                        newIndex = $listItem.index();

                    // Persist the new indices.
                });
            }
        });
    });
});