<?php
    require_once("cors.php");
    require_once("conexion.php");
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    try{
        $data = json_decode($json);
    }catch(Exception $e){
        echo $e->getMessage();
    }
    $tipo= $data->tipo;
    $corp= $data->corp;
    $conn = conectar();
    function getPago($corp,$conn){
        $id= $corp->cliente;
        $q = mysqli_query ($conn, "SELECT * FROM regpago where cliente=".$id.";");
        $rows = array();
        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        print json_encode($rows);
    }
    function getAllPago($corp){
        $q = mysqli_query ($conn, "SELECT * FROM regpago;");
        $rows = array();
        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        print json_encode($rows);
    }

    switch ($tipo){
        case 1: getPago($corp,$conn);break;
        case 2: getAllPago($corp); break;
    }
    mysqli_close();

?>