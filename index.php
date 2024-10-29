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
                    <div id="resdata" class="d-none alert alert-primary"></div>
                </div>
                <div class="row">
                    <label class="input input-bordered gap-2 m-2">
                        Entry $
                        <input type="number" class="grow" placeholder="63250" id="entry" name="entry" step=".01" min="0.01" required />
                    </label>
                    <label class="input input-bordered gap-2 m-2">
                        Stop Loss %
                        <input type="number" class="grow" placeholder="0.33" id="sl" name="sl" step=".01" min="0.01" required />
                    </label>
                </div>
                <div class="row">
                    <div class="fields m-3">
                    </div>
                </div>
                <div class="row">
                    <div>
                        <button type="button" class="add-fields m-2">
                            TP Toevoegen
                        </button>

                        <button type="submit" class="m-2">
                            RR Berekenen
                        </button>
                    </div>
                </div>
            </form>
            <div class="row">
                <h1 class="m-5">Leverage Berekenen</h1>
            </div>
            <div class="row">
            <form id="lev-form">
                <div class="row mt-5">
                    <div class="row">
                        <div id="levdata" class="d-none alert alert-primary"></div>
                    </div>
                    <label class="input input-bordered gap-2 m-2">
                        Risk %
                        <input type="number" class="grow" placeholder="1" id="risk" name="risk" step=".01" min="0.01" required />
                    </label>
                    <label class="input input-bordered gap-2 m-2">
                        Stop Loss %
                        <input type="number" class="grow" placeholder="0.33" id="stoploss" name="stoploss" step=".01" min="0.01" required />
                    </label>
                </div>
                <div class="row">
                    <button type="submit" class="m-2">
                        Leverage Berekenen
                    </button>
                </div>
        </div>
    </div>
    <script src="app.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>