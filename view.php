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
$db->exec("CREATE TABLE IF NOT EXISTS TAbsenzen (id integer PRIMARY KEY AUTOINCREMENT = 1, datum, vorname, nachname, status);");

// Löschen
$sqldel = "DELETE FROM TAbsenzen WHERE id = ";
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
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Hinzufügen<span class="sr-only"></span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="view.php">Ansehen<span class="sr-only">(current)</span></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

<!-- Begin page content -->
<main role="main" class="container">
    <h2 class="mt-5">Anwesenheit ansehen</h2>
    <table class="table table-sm table-hover table-striped">
        <thead>
        <tr>
            <th scope="col">Datum</th>
            <th scope="col">Vorname</th>
            <th scope="col">Nachname</th>
            <th scope="col">Status</th>
            <th scope="col">Löschen?</th>
        </tr>
        </thead>
        <tbody>
        <?php
        // Globale Variable
        $id = "";

        // SQL-Query um Datensatz zu löschen
        $res = $db->query("SELECT * FROM TAbsenzen");

        /* Abfrageergebnis ausgeben */
        while ($dsatz = $res->fetchArray(SQLITE3_ASSOC)) {
            // ID speichern
            $id = $dsatz['id'];

            // Tabelle
            echo "<tr>
            <td >".$dsatz["datum"]."</td>
            <td>".$dsatz["vorname"]."</td>
            <td>".$dsatz["nachname"]."</td>
            <td>".$dsatz["status"]."</td>
            <td><form action=\"view.php\" method=\"post\">
                    <input type=\"submit\" class=\"btn btn-danger btn-sm\" name='del' value='Löschen'>
            </form></td>
        </tr>";
        }

        // Löschen
        if (isset($_POST['del'])) {
            // Datensatz löschen
            $db->query($sqldel . $id);

            // Seite neuladen
            $page = $_SERVER['PHP_SELF'];
            $sec = "0";
            header("Refresh: $sec; url=$page");
        }
        ?>
        </tbody>
    </table>
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