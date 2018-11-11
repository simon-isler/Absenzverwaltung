<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Simon Isler">

    <title>Absenzverwaltung</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.9.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
            integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
            crossorigin="anonymous"></script>

    <!-- Datepicker-->
    <script src="js/datepicker/bootstrap-datepicker.min.js"></script>
    <script src="js/datepicker/bootstrap-datepicker.de.min.js" charset="UTF-8"></script>
    <link id="bsdp-css" href="css/datepicker/bootstrap-datepicker3.min.css" rel="stylesheet">
</head>

<body>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Absenzverwaltung</a>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    <h2 class="mt-5">Absenzverwaltung</h2>
    <p class="lead">Datum:</p>

    <div class="input-append date">
        <input type="text" class="datepicker" name="date"><span class="add-on"><i class="icon-th"></i></span>
    </div>
    <br>
    <?php $data = simplexml_load_file("data/students.xml"); ?>

    <form action="absenzen.php" method="post">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Anwesenheit</th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <th scope="row">1</th>
            <td><?php echo $data->student[0]->vorname ." ". $data->student[0]->nachname;?></td>
            <td>
                <div class="form-group">
                    <select class="form-control" id="stud1" name="select1">
                        <option>Anwesend</option>
                        <option>Abwesend</option>
                        <option>Verspätet</option>
                    </select>
                </div>
            </td>
        </tr>
        <tr>
            <th scope="row">2</th>
            <td><?php echo $data->student[1]->vorname ." ". $data->student[1]->nachname;?></td>
            <td>
                <div class="form-group">
                    <select class="form-control" id="stud2" name="select2">
                        <option>Anwesend</option>
                        <option>Abwesend</option>
                        <option>Verspätet</option>
                    </select>
                </div>
            </td>
        </tr>
        </tbody>
    </table>
    <input type="submit" class="btn btn-success" style="float: right;" name="save" value="Speichern">
</main>

<footer class="footer">
    <div class="container">
        <span class="text-muted" style="float: left;">Absenzverwaltung</span>
        <span class="text-muted" style="float: right;">© Simon Isler, 2018</span>
    </div>
</footer>

<!-- Bootstrap core JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>

<!-- Datepicker -->
<script src="js/datepicker/ownDatepicker.js"></script>
</body>
</html>

