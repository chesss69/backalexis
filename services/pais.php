<?php
    require_once("cors.php");
    require_once("conexion.php");
    $conn = conectar();
    $q = mysqli_query ($conn, "SELECT * FROM pais;");
    $rows = array();
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }
    print json_encode($rows);
?>