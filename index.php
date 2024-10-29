<!DOCTYPE html>
<html lang="en-US">

<head>
    <title>RR Berekenen</title>
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <script crossorigin="anonymous" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="app.css">
</head>

<body class="bg-dark">
    <div class="container text-white p-5 m-5 rounded mx-auto">
        <div class="row">
            <div class="col">
                <div class="card shadow-lg text-white text-center">
                    <h1 class="card-header">RR Berekenen</h1>
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
                                <label for="sl" class="text-start mt-4">Stop loss</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="0.33" id="sl" name="sl" step=".01" min="0.01" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="fields m-3">
                                </div>
                            </div>
                            <div class="row">
                                <button type="button" class="add-fields m-2 btn btn-primary shadow-lg">
                                    TP Toevoegen
                                </button>

                                <button type="submit" class="m-2 btn btn-primary shadow-lg">
                                    RR Berekenen
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card shadow-lg text-white text-center">
                    <h1 class="card-header">Leverage Berekenen</h1>
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
                                <label for="stoploss" class="text-start mt-4">Stop loss</label>
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">%</span>
                                    </div>
                                    <input type="number" class="form-control" placeholder="0.33" id="stoploss" name="stoploss" step=".01" min="0.01" required />
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
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>