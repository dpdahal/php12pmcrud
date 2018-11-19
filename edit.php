<?php

require_once "connection.php";

if (!empty($_GET['criteria'])) {
    if ((int)$_GET['criteria']) {
        $criteria = $_GET['criteria'];
        $query = "SELECT * FROM tbl_students WHERE id=" . $criteria;
        $result = mysqli_query($connection, $query);
        $userData = mysqli_fetch_assoc($result);
        $language = explode(',', $userData['language']);

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

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CRUD</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">

            <h1><i class="glyphicon glyphicon-edit"></i> Update Info</h1>
            <!-- ========error message=======-->
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>

            <form action="update.php" method="post">
                <input type="hidden" name="criteria" value="<?= $userData['id'] ?>">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?= $userData['name'] ?>" id="name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $userData['email'] ?>" id="email" class="form-control">
                </div>


                <div class="form-group">
                    <label for="gender">Gender</label>
                    <input type="radio" name="gender" <?= $userData['gender'] == 'male' ? 'checked' : '' ?> id="name"
                           value="male"> Male
                    <input type="radio" name="gender" <?= $userData['gender'] == 'female' ? 'checked' : '' ?> id="name"
                           value="female"> Female
                </div>
                <div class="form-group">
                    <label for="lang">Language</label>
                    <input type="checkbox" name="lang[]" <?= in_array('nepali', $language) ? 'checked' : '' ?> id="lang"
                           value="nepali"> Nepali
                    <input type="checkbox" name="lang[]" <?= in_array('english', $language) ? 'checked' : '' ?>
                           id="lang" value="english"> English
                    <input type="checkbox" name="lang[]" <?= in_array('chinese', $language) ? 'checked' : '' ?>
                           id="lang" value="chinese"> Chinese

                </div>
                <div class="form-group">
                    <label for="country">Country</label>
                    <select name="country" id="country" class="form-control">
                        <option disabled selected>--select--</option>
                        <option <?= $userData['country'] == 'nepal' ? 'selected' : '' ?> value="nepal">Nepal</option>
                        <option <?= $userData['country'] == 'china' ? 'selected' : '' ?> value="china">China</option>
                        <option <?= $userData['country'] == 'us' ? 'selected' : '' ?>value="us">US</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary">
                        <i class="glyphicon glyphicon-pencil"></i> Edit
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>


<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/custom.js"></script>
</body>
</html>
