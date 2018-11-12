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
<?php
// Fehler ausschalten
error_reporting(0);

// Students
$data = simplexml_load_file("data/students.xml");

//Datenbankdatei erzeugen
$db = new SQLite3("data/sq3.db");

/* Tabelle mit Primärschlüssel erzeugen */
$db->exec("CREATE TABLE IF NOT EXISTS TAbsenzen (id integer PRIMARY KEY AUTOINCREMENT, datum, vorname, nachname, status);");

// Datensatz eintragen
$sqlstr = "INSERT INTO TAbsenzen (id, datum, vorname, nachname, status) VALUES ";
?>
<header>
    <!-- Fixed navbar -->
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <a class="navbar-brand" href="#">Absenzverwaltung</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Hinzufügen<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="view.php">Ansehen</a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    <h2 class="mt-5">Absenz hinzufügen</h2>
    <p class="lead">Datum:</p>

    <form action="index.php" method="post">
    <div class="input-append date">
        <input type="text" class="datepicker" name="date"><span class="add-on"><i class="icon-th"></i></span>
    </div>
    <br>
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
        <br>
    <input type="submit" class="btn btn-success" style="float: right;" name="save" value="Speichern">
    </form>
        <?php
        if (isset($_POST['save'])) {
            // Input
            $datum = $_POST['date'];
            $vorname1 = $data->student[0]->vorname;
            $vorname2 = $data->student[1]->vorname;
            $nachname1 = $data->student[0]->nachname;
            $nachname2 = $data->student[1]->nachname;
            $status1 = $_POST['select1'];
            $status2 = $_POST['select2'];

            // Ausführung
            $db->query($sqlstr . "(null, '$datum', '$vorname1', '$nachname1', '$status1')");
            $db->query($sqlstr . "(null, '$datum', '$vorname2', '$nachname2', '$status2')");

            // Ausgabe
            echo "<p class=\lead\ style='float: right; margin-right: 5%;'>Absenz wurde hinzugefügt!</p>";
        }
        ?>
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
<?php
/* Verbindung zur Datenbankdatei wieder lösen */
$db->close();
?>