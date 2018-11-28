<?php


if (!empty($_GET['criteria']) && $_SERVER['REQUEST_METHOD'] == "GET") {
    $criteria = $_GET['criteria'];

    $selectQuery = "SELECT * FROM tbl_users WHERE id='$criteria'";
    $prepareQuery = mysqli_query($connection, $selectQuery);
    $userData = mysqli_fetch_assoc($prepareQuery);

}

if (isset($_POST['update_user']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $name = $_POST['name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $criteria = $_POST['criteria'];
    $updateDate = date('Y-m-d h:i:s');

    // upload file
    if (!empty($_FILES['upload']['name'])) {
        $selectQuery = "SELECT * FROM tbl_users WHERE id='$criteria'";
        $prepareQuery = mysqli_query($connection, $selectQuery);
        $findData = mysqli_fetch_assoc($prepareQuery);
        $fileName = $findData['image'];
        $filePath = root_path('public/images/users/' . $fileName);
        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }
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
        $updateQuery = "UPDATE tbl_users SET 
          name='$name',username='$username',email='$email',image='$image',
          updated_at='$updateDate' WHERE id='$criteria'";
        $result = mysqli_query($connection, $updateQuery);
        if ($result == true) {
            $_SESSION['success'] = 'data was successfully updated';
            redirect_to('admin/show_users');
        }


    } else {
        $updateQuery = "UPDATE tbl_users SET 
          name='$name',username='$username',email='$email',updated_at='$updateDate'
           WHERE id='$criteria'";
        $result = mysqli_query($connection, $updateQuery);
        if ($result == true) {
            $_SESSION['success'] = 'data was successfully updated';
            redirect_to('admin/show_users');
        }

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
                                <input type="hidden" name="criteria" value="<?= $userData['id'] ?>">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name" value="<?= $userData['name'] ?>" class="form-control"
                                           id="name"
                                           placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" name="username" value="<?= $userData['username'] ?>"
                                           class="form-control" id="username"
                                           placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="text" name="email" value="<?= $userData['email'] ?>"
                                           class="form-control" id="email"
                                           placeholder="Enter email">
                                </div>

                                <div class="form-group">
                                    <label for="change_image">Profile Picture</label>
                                    <input type="file" name="upload" id="change_image" class="btn btn-default">

                                </div>
                                <div class="form-group">
                                    <button name="update_user" type="submit" class="btn btn-primary">
                                        <i class="fa fa-plus"></i> Edit User
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-4">
                            <img src="<?= base_url('public/images/users/' . $userData['image']) ?>" id="target_image"
                                 style="margin-top: 23px;" class="img-responsive thumbnail" alt="image not select">
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </section>
</div>






