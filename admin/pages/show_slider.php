<?php

$selectQuery = "SELECT tbl_users.*,GROUP_CONCAT(tbl_user_privilege.privilege_name SEPARATOR ',') as pri_name FROM tbl_users
JOIN tbl_manage_privilege ON tbl_manage_privilege.user_id=tbl_users.id
JOIN tbl_user_privilege ON tbl_manage_privilege.privilege_id=tbl_user_privilege.id
GROUP BY tbl_manage_privilege.user_id";
$usersData = mysqli_query($connection, $selectQuery);


if (isset($_POST['active'])) {
    $criteria = $_POST['criteria'];
    $status = 0;
    $statusUpdate = "UPDATE tbl_users SET status='$status' WHERE id='$criteria'";
    $prepare = mysqli_query($connection, $statusUpdate);
    if ($prepare == true) {
        $_SESSION['success'] = 'status was updated';
        redirect_to('admin/show_users');
    }

}

if (isset($_POST['inactive'])) {
    $criteria = $_POST['criteria'];
    $status = 1;
    $statusUpdate = "UPDATE tbl_users SET status='$status' WHERE id='$criteria'";
    $prepare = mysqli_query($connection, $statusUpdate);
    if ($prepare == true) {
        $_SESSION['success'] = 'status was updated';
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
                        <table class="table table-hover">
                            <tr>
                                <th>S.n</th>
                                <th>Name</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Privilege</th>
                                <th>Status</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            <?php foreach ($usersData as $key => $user): ?>
                                <tr>
                                    <td><?= ++$key ?></td>
                                    <td><?= $user['name'] ?></td>
                                    <td><?= $user['username'] ?></td>
                                    <td><?= $user['email'] ?></td>
                                    <td><?= $user['pri_name'] ?></td>
                                    <td>
                                        <form action="" method="post">
                                            <input type="hidden" name="criteria" value="<?= $user['id'] ?>">
                                            <?php if ($user['status'] == 1) : ?>
                                                <button name="active" class="btn btn-success btn-xs">
                                                    <i class="fa fa-check"></i>
                                                </button>
                                            <?php else: ?>
                                                <button name="inactive" class="btn btn-warning btn-xs">
                                                    <i class="fa fa-times"></i>

                                                </button>

                                            <?php endif; ?>
                                        </form>

                                    </td>
                                    <td><img src="<?= base_url('public/images/users/' . $user['image']) ?>"
                                             alt="image not found" width="30"></td>
                                    <td><?= $user['created_at'] ?></td>
                                    <td>
                                        <a href="<?= admin_url('edit_user?criteria=' . $user['id']) ?>"
                                           class="btn btn-primary btn-xs">
                                            <i class="fa fa-edit"></i> Edit</a>
                                        <a href="<?= admin_url('delete_user?criteria=' . $user['id']) ?>"
                                           class="btn btn-danger btn-xs">
                                            <i class="fa fa-trash"></i> Delete</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </table>


                    </div>

                </div>
            </div>
        </div>
    </section>
</div>






