<?php

require_once "connection.php";

if (!empty($_GET['criteria'])) {
    if ((int)$_GET['criteria']) {
        $criteria = $_GET['criteria'];
        $query="DELETE FROM tbl_students WHERE id=".$criteria;
        $result=mysqli_query($connection,$query);
        if($result==true){
            $_SESSION['success'] = 'data was successfully deleted';
            header('Location:index.php');
            exit();

        }else{
            $_SESSION['error'] = 'there was a problems';
            header('Location:index.php');
            exit();
        }

    } else {
        $_SESSION['error'] = 'invalid criteria';
        header('Location:index.php');
        exit();
    }


} else {
    $_SESSION['error'] = 'invalid access';
    header('Location:index.php');
    exit();
}