<?php
require_once "connection.php";

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $language = isset($_POST['lang']) ? implode(',', $_POST['lang']) : '';
    $country = $_POST['country'];
    $criteria = $_POST['criteria'];

    $query = "UPDATE tbl_students 
              SET name='$name',email='$email',gender='$gender',
              language='$language',country='$country' WHERE id='$criteria'";
    $result = mysqli_query($connection, $query);
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully updated';
        header("Location:index.php");
        exit();

    } else {
        $_SESSION['error'] = 'there was a problem';
        header("Location:edit.php");
        exit();
    }


} else {
    $_SESSION['error'] = 'invalid access';
    header("Location:index.php");
    exit();
}