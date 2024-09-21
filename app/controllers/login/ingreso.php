<?php
//Se recibe los parametros del login /login/login.php
include("../../config.php");

$correo_electronico = $_POST['correo_electronico'];
$password = $_POST['password'];

$contador = 0;

$sql_ingreso = "SELECT * FROM empleados WHERE correo_electronico = '$correo_electronico' AND passwd = '$password'";

$query = $pdo->prepare($sql_ingreso);

$query->execute();

$usuarios = $query->fetchAll(PDO::FETCH_ASSOC);

foreach($usuarios as $usuario){
    $contador +=1;
    $correo = $usuario['correo_electronico'];
    $nombres = $usuario['nombre'];
    header('Location: '.$URL.'/login');
}

if($contador == 0){
    //echo "Datos incorrectos, intentelo de nuevo";
    session_start();
    $_SESSION['mensaje']= "Credenciales incorrectas, intentalo de nuevo!";
    header('Location: '.$URL.'/login/login.php');
}else{
    //echo "Bienvenido";
    session_start();
    $_SESSION['session_email']= $correo_electronico;
    $_SESSION['mensaje'] = "Usted accedio como: ";
    header('Location:'.$URL.'/index.php');
}


