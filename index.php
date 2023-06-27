<?php
include ('bd.php');

//me permite realizar peticiones de cualquier URL
header('Access-Control-Allow-Origin: *');



//Metodo Get de API
 
if($_SERVER['REQUEST_METHOD']=='GET'){
    if(isset($_GET['id'])){
        $query = "select * from frameworks where id=".$_GET['id'];
        $resultado = metodoGet($query);
        echo json_encode($resultado->fetch(PDO::FETCH_ASSOC)); 
    }else{
        $query = "select * from frameworks";
        $resultado = metodoGet($query);
        echo json_encode($resultado->fetchALL());

    }
    header("HTTP/1.1 200 OK");
    exit();
}


//Metodo Post de API
if($_POST['METHOD']=='POST'){
    unset($_POST['METHOD']);

    $nombre = $_POST['nombre'];
    $lanzamiento = $_POST['lanzamiento'];
    $desarrollador = $_POST['desarrollador'];

    
    $query = "insert into frameworks(nombre, lanzamiento, desarrollador) values ('$nombre', $lanzamiento, '$desarrollador')";

    $queryAutoIncrement = "select MAX(id) as id from frameworks";

    $resultado = metodoPost($query, $queryAutoIncrement);

    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");

    exit();
}


//metodo Put de API

if($_POST['METHOD']=='PUT'){
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $nombre = $_POST['nombre'];
    $lanzamiento = $_POST['lanzamiento'];
    $desarrollador = $_POST['desarrollador'];

    $query = "update frameworks set nombre='$nombre', lanzamiento=$lanzamiento, desarrollador='$desarrollador' where id=$id";
    $resultado = metodoPut($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");

    exit();
}



//metodo delete de API

if($_POST['METHOD']=='DELETE'){
    
    unset($_POST['METHOD']);
    $id = $_GET['id'];
    $query = "delete from frameworks where id=$id";
    $resultado = metodoDelete($query);
    echo json_encode($resultado);
    header("HTTP/1.1 200 OK");
    exit();
}

header("HTTP/1.1 4000 Bad Request");





?>