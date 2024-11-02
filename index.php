<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>RR & Leverage Calculator</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="description" content="RR and Leverage Calculator">
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <script src="js/jquery-3.7.1.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/app.css">
</head>

<body class="bg-dark">
    <div class="container text-white p-5 m-5 rounded mx-auto">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg text-white">
                    <h1 class="card-header text-center shadow-lg">RR</h1>
                    <div class="card-body">
                        <form id="my-form" class="p-5">
                            <div class="row">
                                <div id="error" class="d-none alert alert-danger"></div>
                            </div>
                            <div class="row">
                                <div id="resdata" class="d-none alert alert-info"></div>
                            </div>
                            <div class="row">
                                <label for="entry" class="text-start">Entry</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="63250" id="entry" name="entry" step=".01" min="0.01" required />
                                </div>
                                <label for="sl" class="text-start mt-4">Stop Loss</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="0.33" id="sl" name="sl" step=".01" min="0.01" required />
                                </div>
                            </div>
                            <div class="row p-3 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="fees" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Fees meenemen in berekening?</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="fields grid row-gap-2 m-3">
                                </div>
                            </div>
                            <div class="row">
                                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                                    RR Berekenen
                                </button>
                                <button type="button" class="add-fields m-2 btn btn-success shadow-lg">
                                    TP Toevoegen
                                </button>
                                <button type="button" class="add-fields-sl m-2 btn btn-danger shadow-lg">
                                    SL Toevoegen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-lg text-white">
                    <h1 class="card-header text-center shadow-lg">Leverage</h1>
                    <div class="card-body">
                        <form id="lev-form" class="p-5">
                            <div class="row">
                                <div class="row">
                                    <div id="levdata" class="d-none alert alert-info"></div>
                                </div>
                                <label for="risk" class="text-start">Risk</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="1" id="risk" name="risk" step=".01" min="0.01" required />
                                </div>
                                <label for="stoploss" class="text-start mt-4">Stop Loss</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="0.33" id="stoploss" name="stoploss" step=".01" min="0.01" required />
                                </div>
                            </div>
                            <div class="row p-3 mt-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" name="levfees" checked>
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Fees meenemen in berekening?</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="m-3"></div>
                            </div>
                            <div class="row">
                                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                                    Leverage Berekenen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/app.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>