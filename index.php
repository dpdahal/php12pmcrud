<?php
require_once "connection.php";

$query = "SELECT * FROM tbl_students  ORDER BY id DESC LIMIT 7 ";
$result = mysqli_query($connection, $query);
$numberOfData = mysqli_num_rows($result);

if (isset($_GET['search'])) {
    $data = $_GET['search'];
    $query = "SELECT * FROM tbl_students WHERE
              name LIKE '%$data%' || 
              email LIKE '%$data%' || 
              gender LIKE '%$data%' || 
              language LIKE '%$data%' || 
              country LIKE '%$data%' ";
    $result = mysqli_query($connection, $query);


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
    <link rel="stylesheet" href="bootstrap/css/custom.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <h1><i class="glyphicon glyphicon-user"></i> Student Record</h1>
            <!-- ========error message=======-->
            <?php if (isset($_SESSION['error'])) : ?>
                <div class="alert alert-danger">
                    <?php
                    echo $_SESSION['error'];
                    unset($_SESSION['error']);
                    ?>
                </div>
            <?php endif; ?>
            <!--=======success===-->
            <?php if (isset($_SESSION['success'])) : ?>
                <div class="alert alert-success">
                    <?php
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                    ?>
                </div>
            <?php endif; ?>

            <hr>


            <div class="col-md-4">
                <form action="insert.php" method="post">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" id="email" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Password Confirm</label>
                        <input type="password" name="password_confirmation" id="password_confirmation"
                               class="form-control">
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <input type="radio" name="gender" id="name" value="male"> Male
                        <input type="radio" name="gender" id="name" value="female"> Female
                    </div>
                    <div class="form-group">
                        <label for="lang">Language</label>
                        <input type="checkbox" name="lang[]" id="lang" value="nepali"> Nepali
                        <input type="checkbox" name="lang[]" id="lang" value="english"> English
                        <input type="checkbox" name="lang[]" id="lang" value="chinese"> Chinese

                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control">
                            <option disabled selected>--select--</option>
                            <option value="nepal">Nepal</option>
                            <option value="china">China</option>
                            <option value="us">US</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            <i class="glyphicon glyphicon-plus"></i> Add Record
                        </button>
                    </div>


                </form>

            </div>
            <div class="col-md-8">
                <div class="row">
                    <form action="" method="get">
                        <div class="col-md-6">
                            <input type="text" required="required" name="search" class="form-control">

                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-primary">
                                <i class="glyphicon glyphicon-search"></i> Search
                            </button>
                        </div>
                    </form>
                </div>

                <form action="delete-all.php" method="post">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>
                                <?php if ($numberOfData > 1): ?>
                                    <input type="checkbox" id="select-all">
                                <?php endif; ?>
                            </th>
                            <th>S.n</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Language</th>
                            <th>Country</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($result as $key => $students) : ?>
                            <tr>
                                <td>
                                    <?php if ($numberOfData > 1): ?>
                                        <input type="checkbox" class="my-class" name="criteria[]"
                                               value="<?= $students['id'] ?>">
                                    <?php endif; ?>
                                </td>
                                <td><?= ++$key; ?></td>
                                <td><?= ucfirst($students['name']); ?></td>
                                <td><?= $students['email']; ?></td>
                                <td><?= $students['gender']; ?></td>
                                <td><?= $students['language']; ?></td>
                                <td><?= $students['country']; ?></td>
                                <td>
                                    <a href="edit.php?criteria=<?= $students['id'] ?>" class="btn btn-primary btn-xs ">
                                        <i class="glyphicon glyphicon-edit"></i> E</a>
                                    <a href="delete.php?criteria=<?= $students['id'] ?>"
                                       onclick="return confirm('are you sure delete')" class="btn btn-danger btn-xs">
                                        <i class="glyphicon glyphicon-trash"></i> D</a>
                                </td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>

                    </table>
                    <button class="btn btn-danger btn-sm" id="delete-all"
                            onclick="return confirm('are you sure delete all data')">Delete all
                    </button>
                </form>

            </div>

        </div>
    </div>
</div>

<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.js"></script>
<script src="bootstrap/js/custom.js"></script>
</body>
</html>