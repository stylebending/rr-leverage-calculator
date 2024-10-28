<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>RR Berekenen</title>

    <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center">
        <div class="row">
            <h1 class="m-5">RR Berekenen</h1>
        </div>
        <div class="row">
            <form id="my-form">
                <div class="row">
                    <div id="error" class="d-none alert alert-danger"></div>
                </div>
                <div class="row">
                    <label class="input input-bordered gap-2 m-2">
                        $
                        <input type="number" class="grow" placeholder="Entry prijs" id="entry" name="entry" required />
                    </label>
                    <label class="input input-bordered gap-2 m-2">
                        %
                        <input type="number" class="grow" placeholder="Risk percentage" id="risk" name="risk" required />
                    </label>
                </div>
                <div class="row">
                    <div class="fields m-5">
                    </div>
                </div>
                <div class="row">
                    <div class="m-5">
                        <button type="button" class="add-fields m-2">
                            TP Toevoegen
                        </button>

                        <button type="submit" class="m-2">
                            RR Berekenen
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- <script type="text/x-templates" id="fields-templates">
        <div class="tp-fields" id="tp-fields">
            <label class="input input-bordered gap-2 m-2">
            $
            <input type="number" name="tp" id="tp" class="grow" placeholder="TP prijs" required>
            </label>
            <label class="input input-bordered gap-2 m-2">
            <input type="number" name="tpp" id="tpp" class="grow" placeholder="TP percentage" required>
            %
            </label>
            <button type="button" class="remove-fields m-2">
                TP verwijderen
            </button>
        </div>
</script> -->

    <script>
        // JS that handles creating new TPs and AJAX request
        $(function() {
            // Defining variables
            var $form = $('#my-form');
            var $fields = $form.find('.fields');
            var tpCount = 0;

            // Function to add TPs when user wants to
            $form.on('click', '.add-fields', function() {
                // Setting the unique tpCount per tp
                tpCount += 1;

                // Creating the div for the TPs
                var div = document.createElement("div");
                div.classList = "tp-fields tp-fields-" + tpCount;
                div.id = "tp-fields-" + tpCount;
                // Creating the label for tp
                var tpLabel = document.createElement("label");
                tpLabel.classList = "input input-bordered gap-2 m-2";
                tpLabel.id = "tp-label-" + tpCount;
                // Creating the tp input
                var tpInput = document.createElement("input");
                tpInput.classList = "grow m-2";
                tpInput.id = "tp-input-" + tpCount;
                tpInput.name = "tp-input-" + tpCount;
                tpInput.type = "number";
                tpInput.placeholder = "TP prijs";
                tpInput.required = true;
                // Creating the tpp input
                var tppInput = document.createElement("input");
                tppInput.classList = "grow m-2";
                tppInput.id = "tpp-input-" + tpCount;
                tppInput.name = "tpp-input-" + tpCount;
                tppInput.type = "number";
                tppInput.placeholder = "TP percentage";
                tppInput.required = true;
                // Creating the tp delete button
                var tpBtn = document.createElement("button");
                tpBtn.classList = "remove-fields m-2";
                tpBtn.type = "button";
                tpBtn.id = "tpBtn-" + tpCount;
                tpBtn.textContent = "TP verwijderen";
                // Creating $ and % ps
                var ds = document.createElement("span");
                var ps = document.createElement("span");
                ps.classList = "ms-5";
                ds.innerText = "$"
                ps.innerText = "%"
                // Adding all of these together
                tpLabel.appendChild(ds);
                tpLabel.appendChild(tpInput);
                tpLabel.appendChild(ps);
                tpLabel.appendChild(tppInput);
                div.appendChild(tpLabel);
                div.appendChild(tpBtn);
                $fields.prepend($(div));
            });

            // Function to remove TPs when user wants to
            $form.on('click', '.remove-fields', function(event) {
                $(event.target).closest('.tp-fields').remove();
            });

            // Form submit and AJAX request
            $form.on('submit', function(e) {
                e.preventDefault();

                // Getting the error div
                let $error = $('#error');

                // Handling the AJAX request
                $.ajax({
                    type: 'GET',
                    url: 'calculate.php',
                    data: $(this).serialize()
                }).then(function(res) {
                    let data = JSON.parse(res);
                    if (data.error) {
                        $error.removeClass('d-none').html(data.error);
                        return;
                    } else if (data.rr) {
                        // Laat RR zien aan gebruiker
                    }
                }).fail(function(res) {
                    $error.removeClass('d-none').html(data.error);
                });
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>