<?php
require_once "connection.php";

if (!empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    if(empty($name)){
        $_SESSION['error'] = 'name field is required';
        header("Location:index.php");
        exit();
    }
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['password_confirmation']);
    if ($password != $cpassword) {
        $_SESSION['error'] = 'password not match';
        header("Location:index.php");
        exit();
    }
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $language = isset($_POST['lang']) ? implode(',', $_POST['lang']) : '';
    $country = $_POST['country'];

    $query = "INSERT INTO tbl_students(name,email,password,gender,language,country)
            VALUES('$name','$email','$password','$gender','$language','$country') ";
    $result = mysqli_query($connection, $query);
    if ($result == true) {
        $_SESSION['success'] = 'data was successfully inserted';
        header("Location:index.php");
        exit();

    } else {
        $_SESSION['error'] = 'there was a problem';
        header("Location:index.php");
        exit();
    }


} else {
    $_SESSION['error'] = 'invalid access';
    header("Location:index.php");
    exit();
}