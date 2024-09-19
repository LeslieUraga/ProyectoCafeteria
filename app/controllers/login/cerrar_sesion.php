<?php
include('../../config.php');

session_start();
if(isset($_SESSION['session_email'])){
    session_destroy();
    header('Location: '.$URL.'/');
}
?>