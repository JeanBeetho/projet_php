<?php 
    session_start();
    session_destroy();
    // //$_SESSION[] = array;
    // echo '<script type="text/javascript">alert("Voulez-vous se deconnecter");</script>';
    die('<META HTTP-equiv="refresh" content=0;URL=../index.php>');
?>