<?php
/**
 * Created by PhpStorm.
 * User: simon
 * Date: 09.11.18
 * Time: 13:07
 */

// Daten speichern
if (isset($_GET['save'])) {
    // falls der Benutzer sqlite3 nicht hat
    if (!(extension_loaded("sqlite3"))) {
        echo "Sie benötigen die SQLite3-Bibliothek!";
    }

    // Datenbankdatei ausserhalb htdocs öffnen bzw. erzeugen
    $dbdir = '/develop/xampp/db';
    $db = new SQLite3("$dbdir/sq3.db");

    // Tabelle mit Primärschlüssel erzeugen
    $db->exec("CREATE TABLE TSchueler (stuDatum INTEGER PRIMARY  KEY, stuVorname, stuNachname, stuStatus);");

    // Drei Datensätze eintragen
    $sqlstr = "INSERT INTO TSchueler (stuDatum, stuVorname, stuNachname, stuStatus) VALUES ";
    $db->query($sqlstr . "('Maier', 'Hans', 6714, 3500, '1962-03-15')");

    // Verbindung zur Datenbankdatei wieder lösen
    $db->close();
}

