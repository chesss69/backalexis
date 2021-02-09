<?php     
    require_once("cors.php");
    require_once("conexion.php");
    $conn = conectar();
    $q = mysqli_query ($conn, "SELECT * FROM ciudad;");
    $rows = array();
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }
    mysqli_close();
    print json_encode($rows);

?>