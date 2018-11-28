<?php

$selectQuery = "SELECT * FROM tbl_user_privilege ORDER BY id DESC ";
$privilegeData = mysqli_query($connection, $selectQuery);


if (!empty($_POST) && !empty($_FILES) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['confirm_password']);
    if ($password != $cpassword) {
        $_SESSION['error'] = 'password not match';
        redirect_to('admin/add-user');

    }
    $privilegeId = $_POST['privilege'];

    $createDate = date('Y-m-d h:i:s');
    $updateDate = date('Y-m-d h:i:s');

    // upload file

    $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
    $imageName = md5(microtime()) . '.' . $ext;
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $uploadPath = root_path('public/images/users');

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }

    if (move_uploaded_file($tmpName, $uploadPath . '/' . $imageName)) {
        $image = $imageName;
    }

    $insertQuery = "INSERT INTO 
        tbl_users(name,username,email,password,image,created_at,updated_at)
        VALUES('$name','$username','$email','$password','$image','$createDate','$updateDate')";
    $result = mysqli_query($connection, $insertQuery);
    $lastInsertId = mysqli_insert_id($connection);

    if ($lastInsertId) {
        foreach ($privilegeId as $id) {
            $query = "INSERT INTO tbl_manage_privilege(user_id,privilege_id)
          VALUES('$lastInsertId','$id')";
            $res = mysqli_query($connection, $query);

        }

        $_SESSION['success'] = 'data was successfully inserted ';
        redirect_to('admin/show_users');


    }


}


?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?= messages(); ?>
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title"><?= $title ?></h3>
                    </div>
                    <div class="box-body">
                        <div> <?= messages() ?></div>
                        <div class="col-md-8">
                            <form method="post" action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" class="form-control" id="name"
                                           placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" class="form-control" id="username"
                                           placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" class="form-control" id="email"
                                           placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="privilege">Privilege</label>
                                    <select name="privilege[]" id="privilege" multiple class="form-control">
                                        <?php foreach ($privilegeData as $privilege): ?>
                                            <option value="<?= $privilege['id'] ?>"><?= $privilege['privilege_name'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control"
                                                   id="password"
                                                   placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Password Confirm</label>
                                            <input type="password" name="confirm_password" class="form-control"
                                                   id="confirm_password"
                                                   placeholder="confirm password">
                                        </div>
                                    </div>
                                </div>


                                <div class="form-group">
                                    <label for="change_image">Profile Picture</label>
                                    <input type="file" name="upload" id="change_image" class="btn btn-default">

                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Add Record
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <img src="<?= base_url('public/images/icons/not-found.png') ?>" id="target_image"
                                 style="margin-top: 23px;" class="img-responsive thumbnail" alt="image not select">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>






