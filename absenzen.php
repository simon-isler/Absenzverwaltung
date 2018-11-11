<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 09.11.18
 * Time: 13:07
 */

include 'index.php';

if (isset($_POST['save'])) {
    // falls der Benutzer sqlite3 nicht hat
    if (!(extension_loaded("sqlite3"))) {
        echo "Sie benötigen die SQLite3-Bibliothek!";
    }

    // Input
    $datum = $_POST['date'];


    //Datenbankdatei erzeugen
    $db = new SQLite3("sq3.db");

    // Tabelle erzeugen
    $db->exec("CREATE TABLE IF NOT EXISTS TSchueler (stuDatum INTEGER PRIMARY  KEY,  stuVorname, stuNachname, stuStatus);");

    // Speichern
    $sqlstr = "INSERT INTO TSchueler (stuDatum, stuVorname, stuNachname, stuStatus) VALUES ";
    $db->query($sqlstr . "('')");

    // Verbindung zur Datenbankdatei wieder lösen
    $db->close();

}

