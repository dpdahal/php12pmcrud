<?php

if (!empty($_GET['criteria']) && $_SERVER['REQUEST_METHOD'] == "GET") {
    $criteria = $_GET['criteria'];

    $selectQuery = "SELECT * FROM tbl_users WHERE id='$criteria'";
    $prepareQuery = mysqli_query($connection, $selectQuery);
    $findData = mysqli_fetch_assoc($prepareQuery);
    $fileName = $findData['image'];
    $filePath = root_path('public/images/users/' . $fileName);
    if (file_exists($filePath) && is_file($filePath)) {
        unlink($filePath);
    }
    $deletePrivilege="DELETE FROM tbl_manage_privilege WHERE user_id='$criteria'";
    $result=mysqli_query($connection,$deletePrivilege);
    if($result==true){
        $deleteQuery = "DELETE FROM tbl_users WHERE id='$criteria'";
        $deletePrepare = mysqli_query($connection, $deleteQuery);
        if ($deletePrepare == true) {
            $_SESSION['success'] = 'data was successfully deleted';
            redirect_to('admin/show_users');
        } else {
            $_SESSION['error'] = 'there was a problem';
            redirect_to('admin/show_users');
        }
    }



}