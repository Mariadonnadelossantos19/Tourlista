<?php
    session_start();
    error_reporting(E_ERROR | E_PARSE);
    if($_SESSION['id']=="") header("Location:../signin");
    if($_SESSION['level']>2 || $_SESSION['level']== '1' ){
        header("Location:index-ae.php");
    }else{
        header("Location:index-ta.php");
    }
?>