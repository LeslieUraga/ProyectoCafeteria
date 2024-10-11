<?php
// Verifica si la sesión ya está iniciada antes de llamar a session_start()
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (isset($_SESSION['session_email'])) {
    //echo 'Session existe de '.$_SESSION['session_email'];
    $email = $_SESSION['session_email'];
    
    // Asegúrate de que la conexión PDO ($pdo) esté correctamente inicializada antes de esta línea.
    $sql = "SELECT * FROM empleados WHERE correo_electronico = :email";
    $query = $pdo->prepare($sql);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    
    $query->execute();
    
    $usuarios = $query->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($usuarios as $usuario) {
        $nombres_sesion = $usuario['nombre'] . ' ' . $usuario['apellido_paterno'] . ' ' . $usuario['apellido_materno'];
        $foto = $usuario['foto']; 
        $rfc = $usuario['rfc']       ;
    }
} else {
    //echo 'No existe';
    header('Location: ' . $URL . '/login/login.php');
    exit(); // Asegúrate de usar exit después del header para evitar continuar la ejecución.
}
?>
