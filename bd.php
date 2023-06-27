
<?php

//utilización de PDO


//datos para la conexion
$pdo=NULL;  
$host = 'localhost';
$user = 'root'; 
$password = '';
$bd = 'tutoriales';


//---------------------------------------------------------------------------
//conexion a la base de datos

function conecar(){
    try {

        global $host, $bd, $user, $password, $pdo;

        $pdo = new PDO("mysql:host=$host;dbname=$bd", $user, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
               
    } catch (PDOException $th) {
        print "error con la conexion ";
        print "$th";
        die();
    }
}

//desconexion a la base de datos 

function desconexion(){
    global $pdo;
    $pdo = null;

}



//-----------------------------------------------------------------------------------


//metodos HTTP
//metodo get es obtener informacion 
function metodoGet($query){
    try {

        conecar();
        global $pdo;
        $sentencia = $pdo->prepare($query);
        $sentencia->setFetchMode(PDO::FETCH_ASSOC);
        $sentencia->execute();
        desconexion();
        return $sentencia;
         
    } catch (Exception $th) {
       die("Error: $th");
    }

}


//metodo post es enviar informacion

function metodoPost($query, $queryAutoIncrement){
    try {

        conecar();
        global $pdo;
        $sentencia = $pdo->prepare($query);
        $sentencia->execute();
        $idAutoIncrement = metodoGet($queryAutoIncrement)->fetch(PDO::FETCH_ASSOC);
        $resultado = array_merge($idAutoIncrement, $_POST);
        $sentencia -> closeCursor();    
        desconexion();
        return $resultado;
         
    } catch (Exception $th) {
       die("Error: $th");
    }

}
//metodo put es actualizar informacion 
function metodoPut($query){
    try {

        conecar();
        global $pdo;
        $sentencia = $pdo->prepare($query);
        $sentencia->execute();
        $resultado = array_merge($_GET, $_POST);
        $sentencia -> closeCursor();    
        desconexion();
        return $resultado;
         
    } catch (Exception $th) {
       die("Error: $th");
    }


}

//metodo delete para borrar informacion

function metodoDelete($query){
    try {

        conecar();
        global $pdo;
        $sentencia = $pdo->prepare($query);
        $sentencia->execute();
        $sentencia -> closeCursor();    
        desconexion();
        return $_GET['id'];
         
    } catch (Exception $th) {
       die("Error: $th");
    }




}

?>