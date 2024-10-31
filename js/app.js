// JS that handles creating new TPs and AJAX requests
$(function () {
    // Defining variables
    var $form = $('#my-form');
    var $levForm = $('#lev-form');
    var $fields = $form.find('.fields');
    var tpCount = 0;

    // Function to add TPs when user wants to
    $form.on('click', '.add-fields', function () {
        // Setting the unique tpCount per tp
        tpCount += 1;

        // Creating the div for the TPs
        var div = document.createElement("div");
        div.classList = "row m-5 tp-fields tp-fields-" + tpCount;
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
        tpInput.step = ".01";
        tpInput.min = ".01";
        tpInput.required = true;
        // Creating the tpp input
        var tppInput = document.createElement("input");
        tppInput.classList = "form-control";
        tppInput.id = "tpp-input-" + tpCount;
        tppInput.name = "tpp-input-" + tpCount;
        tppInput.type = "number";
        tppInput.placeholder = "30";
        tppInput.step = ".01";
        tppInput.min = ".01";
        tppInput.required = true;
        // Creating the tp delete button
        var tpBtn = document.createElement("button");
        tpBtn.classList = "remove-fields m-2 btn btn-danger shadow-lg";
        tpBtn.type = "button";
        tpBtn.id = "tpBtn-" + tpCount;
        tpBtn.textContent = "TP verwijderen";
        // Creating $ and % ps
        var ds = document.createElement("span");
        ds.classList = "input-group-text";
        ds.innerText = "$"
        var ps = document.createElement("span");
        ps.classList = "input-group-text";
        ps.innerText = "%"
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

    // Function to remove TPs when user wants to
    $form.on('click', '.remove-fields', function (event) {
        $(event.target).closest('.tp-fields').remove();
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
            console.log(res);
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
                    "Winst percentage ZONDER LEVERAGE: " + data.wp + "%" + "<br>" +
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
            let data = JSON.parse(res);
            if (data.error) {
                $error.removeClass('d-none').html(data.error);
                return;
            } else if (data.levdata) {
                $levdata.removeClass('d-none').html(
                    "Leverage: " + data.lev
                );
                return;
            }
        }).fail(function (res) {
            $error.removeClass('d-none').html(data.error);
        });
    });
});