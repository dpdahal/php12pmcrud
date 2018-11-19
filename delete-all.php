<?php
require_once "connection.php";

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $criteria = $_POST['criteria'];
    $numberOfData = count($criteria);
    $x = 0;
    foreach ($criteria as $cri) {
        $query = "DELETE FROM tbl_students WHERE id='$cri'";
        $result = mysqli_query($connection, $query);
        if ($result == true) {
            $x++;
        }
    }

    if ($numberOfData == $x) {
        $_SESSION['success'] = "data was removed";
        header('Location:index.php');
        exit();
    } else {
        $_SESSION['error'] = 'There was a problem';
        header("Location:index.php");

    }


} else {
    $_SESSION['error'] = 'invalid access';
    header('Location:index.php');
    exit();

}