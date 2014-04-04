<?php
    $id = $_POST['id'];

    $action = $_POST['action'];

    $con = mysqli_connect("localhost","root","root","movelsul_2014");

    if($action == 'checked') {
        mysqli_query($con, "UPDATE expositores SET enviado='1' WHERE id='$id' ");
    }
    if($action == 'unchecked') {
        mysqli_query($con, "UPDATE expositores SET enviado='0' WHERE id='$id' ");
    }

?>