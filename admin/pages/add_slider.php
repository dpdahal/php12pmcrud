<?php


if (!empty($_POST) && !empty($_FILES) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $tile = $_POST['title'];
    $description = $_POST['description'];

    $ext = pathinfo($_FILES['upload']['name'], PATHINFO_EXTENSION);
    $imageName = md5(microtime()) . '.' . $ext;
    $error = $_FILES['upload']['error'];
    $tmpName = $_FILES['upload']['tmp_name'];
    $uploadPath = root_path('public/images/slider');

    if (!file_exists($uploadPath)) {
        mkdir($uploadPath);
    }

    if (move_uploaded_file($tmpName, $uploadPath . '/' . $imageName)) {
        $image = $imageName;
    }

    $insertQuery = "INSERT INTO 
        tbl_slider(title,image,description)VALUES('$tile','$image','$description')";
    $result = mysqli_query($connection, $insertQuery);
    $lastInsertId = mysqli_insert_id($connection);
    $_SESSION['success'] = 'data was successfully inserted ';
    redirect_to('admin/show_slider');


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
                        <form method="post" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="title">Title</label>
                                <textarea  name="title" id="title" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="image">Image</label>
                                <input type="file" name="upload" id="image" class="btn btn-default">

                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="editor1"></textarea>

                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-plus"></i> Add Record
                                </button>
                            </div>
                        </form>


                    </div>

                </div>
            </div>
        </div>
    </section>
</div>






