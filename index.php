<?php

use App\ToDoController;

require __DIR__ . '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    (new ToDoController)->handle();
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="To Do List">
    <meta name="author" content="Nihar Ranjan Halder">
    <title>To Do list</title>
    <link rel="stylesheet" type="text/css" href="public/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="public/css/style.css">
</head>

<body>

    <header class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-body border-bottom shadow-sm">
        <p class="h5 my-0 me-md-auto fw-normal">Neher Test</p>
    </header>

    <main class="container">
        <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
            <h1 class="display-4">todos</h1>
        </div>

        <div class="row">
            <div class="col"></div>
            <div class="col-6">
                <div class="card mb-6 shadow-sm">
                    <div class="card-header">
                        <input id="card-input" type="text" class="form-control" placeholder="What needs to be done?">
                    </div>
                    <div class="card-body">
                        <div class="list-group"></div>
                    </div>

                    <div class="card-footer dn">
                        <div class="row">
                            <div id="active-count" class="col-3 pt-2"></div>
                            <div class="col-1"><button type="button" onclick="request('list', 'all');" class="btn">All</button></div>
                            <div class="col-2"><button type="button" class="btn" onclick="request('list', 'active');">Active</button></div>
                            <div class="col-2"><button type="button" class="btn" onclick="request('list', 'completed');">Completed</button></div>
                            <div style="display: none;" id="completed-count" class="col-4 text-end"><button type="button" class="btn" onclick="request('delete', 'completed');">Clear Completed</button></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col"></div>
        </div>
    </main>

    <script type="text/javascript" src="public/js/jquery-3.5.1.min.js"></script>
    <script type="text/javascript" src="public/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="public/js/script.js"></script>
</body>

</html>