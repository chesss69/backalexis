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
    function getUser($corp,$conn){
        $id= $corp->id;
        $q = mysqli_query ($conn, "SELECT * FROM cliente where id=".$id.";");
        $rows = array();
        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        print json_encode($rows[0]);
    }
    function getAllUser($corp,$conn){
        $q = mysqli_query ($conn, "SELECT * FROM cliente;");
        $rows = array();
        while($r = mysqli_fetch_assoc($q)) {
            $rows[] = $r;
        }
        print json_encode($rows);
    }
    function newUser($corp,$conn){
        $nombre=$corp->nombre;
        $celular=$corp->celular;
        $direccion=$corp->direccion;
        $ciudad=$corp->ciudad;
        $saldodeuda=$corp->saldodeuda;
        if(!mysqli_query($conn, "INSERT INTO cliente (nombre,celular,direccion,ciudad,saldodeuda) values ('$nombre','$celular','$direccion',$ciudad,$saldodeuda);")){
            print json_encode(json_decode('{"code":"1","msg":"ERROR"}'));
        }else{
            print json_encode(json_decode('{"code":"0","msg":"Exito"}'));
        }
    }
    function editUser($corp,$conn){
        $nombre=$corp->nombre;
        $celular=$corp->celular;
        $direccion=$corp->direccion;
        $ciudad=$corp->ciudad;
        $cliente=$corp->cliente;
        if(!mysqli_query($conn, "UPDATE cliente set nombre='$nombre', celular='$celular', direccion = '$direccion', ciudad = $ciudad where id=$cliente;")){
            print json_encode(json_decode('{"code":"1","msg":"ERROR"}'));
        }else{
            print json_encode(json_decode('{"code":"0","msg":"Exito"}'));
        }
    }
    function cargarPago($corp,$conn){
        $cliente= $corp->cliente;
        $monto= $corp->monto;
        $fecha = $corp->fecha;
        $descripcion= $corp->descripcion;
        if(!mysqli_query($conn, "INSERT INTO regpago (cliente,monto,fecha,descripcion) values ($cliente,$monto,'$fecha','$descripcion');")){
            print json_encode(json_decode('{"code":"1","msg":"ERROR"}'));
        }else{
            print json_encode(json_decode('{"code":"0","msg":"Exito"}'));
        }
        
    }
    function cargarDeuda($corp,$conn){
        $cliente= $corp->cliente;
        $monto= $corp->monto;
        $fecha = $corp->fecha;
        $descripcion= $corp->descripcion;
        if(!mysqli_query($conn, "INSERT INTO regdeuda (cliente,monto,fecha,descripcion) values ($cliente,$monto,'$fecha','$descripcion');")){
            print json_encode(json_decode('{"code":"1","msg":"ERROR"}'));
        }else{
            print json_encode(json_decode('{"code":"0","msg":"Exito"}'));
        }
        
    }
    switch ($tipo){
        case 1: getUser($corp,$conn);break;
        case 2: getAllUser($corp,$conn); break;
        case 3: cargarPago($corp,$conn);break;
        case 4: cargarDeuda($corp, $conn);break;
        case 5: newUser($corp,$conn);break;
        case 6: editUser($corp,$conn);break;
    }
    mysqli_close();
?>