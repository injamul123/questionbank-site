<?php

session_start();
require_once './src/database.php';
if (isset($_POST['submit'])) {
    $error = '';
    if (strlen($_POST['username']) < 1) {
        $error = 'Please enter username';
    } else if (strlen($_POST['password']) < 1) {
        $error = 'Please enter password';
    } else {
        $username = $db->real_escape_string($_POST['username']);
        $password = $db->real_escape_string($_POST['password']);

        $sql = "SELECT username, password, role, name from users where username = '$username'";
        $res = $db->query($sql);
        if ($res->num_rows < 1) {
            $error = 'No user found';
        } else {
            $user = $res->fetch_object();
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = $user->username;
                $_SESSION['name'] = $user->name;
                $_SESSION['role'] = $user->role;
                header('Location: ./dashboard.php');
                exit();
            } else {
                $error = 'Wrong username or password';
            }
        }
    }
}

?>



<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./res/css/bootstrap4.css">

    <title>QuestionBank Management System</title>
</head>

<body >

    <div class="container-fluid">
        <div class="row">
            <div class="col col-lg-4 col-md-4 col-sm-12 col-xs-12 offset-lg-4" style="margin-top: 30vh">
                <div class="card">
                    <div class="card-body">
                        <?php if (isset($error) && strlen($error) > 1): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                        <?php endif?>

                        <?php if (isset($_SESSION['error']) && strlen($_SESSION['error']) > 1): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $_SESSION['error'];unset($_SESSION['error']) ?>
                        </div>
                        <?php endif?>

                        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Username</label>
                                <input type="text" name="username" class="form-control" id="exampleInputEmail1"
                                    aria-describedby="emailHelp" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                                    placeholder="Password">
                            </div>
                            <div class="row">

                                <div class="col col-xs-2">
                                    <button style="float:right" type="submit" name="submit"
                                        class="btn btn-primary">Login</button>
                                </div>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="./res/js/jquery.js"></script>
    <script src="./res/js/popper.js"></script>
    <script src="./res/js/bootstrap.min.js"></script>
</body>

</html