<?php

$selectQuery = "SELECT * FROM tbl_user_privilege ORDER BY id DESC ";
$privilegeData = mysqli_query($connection, $selectQuery);


if (isset($_POST['add-privilege']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $privilegeName = $_POST['privilege_name'];

    $createDate = date('Y-m-d h:i:s');
    $updateDate = date('Y-m-d h:i:s');
    $query = "INSERT INTO tbl_user_privilege
              (privilege_name,created_at,updated_at)
              VALUE ('$privilegeName','$createDate','$updateDate')";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        $_SESSION['success'] = 'privilege was inserted';
        redirect_to('admin/manage_user_privilege');
    }

}

if (isset($_POST['delete-privilege']) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $criteria = $_POST['criteria'];
    $deleteQuery = "DELETE FROM tbl_user_privilege WHERE id='$criteria'";
    $queryPrepare = mysqli_query($connection, $deleteQuery);
    if ($queryPrepare == true) {
        $_SESSION['success'] = 'privilege was inserted';
        redirect_to('manage_user_privilege');
    } else {
        $_SESSION['error'] = "There was a problems";
        redirect_to('admin/manage_user_privilege');
    }


}

if (isset($_POST['edit-privilege']) && !empty($_POST) && $_SERVER['REQUEST_METHOD'] == "POST") {
    $criteria = $_POST['criteria'];
    $selectQry = "SELECT * FROM tbl_user_privilege WHERE id='$criteria'";
    $singleData = mysqli_query($connection, $selectQry);
    $getPrivilegeData = mysqli_fetch_assoc($singleData);


}

if (isset($_POST['edit-privilege-action']) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $criteria = $_POST['criteria'];
    $privilegeName = $_POST['privilege_name'];

    $updateDate = date('Y-m-d h:i:s');
    $query = "UPDATE tbl_user_privilege SET
              privilege_name='$privilegeName',
              updated_at='$updateDate' WHERE id='$criteria'";
    $result = mysqli_query($connection, $query);

    if ($result == true) {
        $_SESSION['success'] = 'privilege was successfully updated';
        redirect_to('admin/manage_user_privilege');
    }

}




?>


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <?php if (isset($_POST['edit-privilege'])) : ?>
        <section class="content container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title"><?= $title ?></h3>
                        </div>
                        <div class="box-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form action="" method="post">
                                        <div class="row">
                                            <input type="hidden" name="criteria" value="<?= $getPrivilegeData['id'] ?>">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="privilege_name">Privilege Name</label>
                                                    <input type="text" name="privilege_name"
                                                           value="<?= $getPrivilegeData['privilege_name'] ?>"
                                                           placeholder="privilege name"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button name="edit-privilege-action" class="btn btn-primary"
                                                            style="margin-top: 24px;">
                                                        <i class="fa fa-edit"></i> Edit Privilege
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php else: ?>

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
                            <div class="row">
                                <div class="col-md-12">
                                    <div> <?= messages() ?></div>
                                    <form action="" method="post">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="privilege_name">Privilege Name</label>
                                                    <input type="text" name="privilege_name"
                                                           placeholder="privilege name"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <button name="add-privilege" class="btn btn-primary"
                                                            style="margin-top: 24px;">
                                                        <i class="fa fa-plus"></i> Add Record
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-md-12">
                                    <table class="table table-hover">
                                        <tr>
                                            <th>S.n</th>
                                            <th>Privilege Name</th>
                                            <th>Created At</th>
                                            <th>Action</th>
                                        </tr>
                                        <?php foreach ($privilegeData as $key => $privilege) : ?>
                                            <tr>
                                                <td><?= ++$key ?></td>
                                                <td><?= $privilege['privilege_name'] ?></td>
                                                <td><?= $privilege['created_at'] ?></td>
                                                <td>
                                                    <form action="" method="post">
                                                        <input type="hidden" name="criteria"
                                                               value="<?= $privilege['id'] ?>">
                                                        <button name="edit-privilege" class="btn btn-primary btn-sm">
                                                            Edit
                                                        </button>
                                                        <button name="delete-privilege" class="btn btn-danger btn-sm">
                                                            Delete
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    <?php endif; ?>
</div>






