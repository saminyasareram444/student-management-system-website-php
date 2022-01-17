<?php
require_once 'dbcon.php';
session_start();
if (isset($_SESSION['user_login'])) {

    header('location:index.php');
}
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `users` WHERE `username` = '$username';";

    $username_check = mysqli_query($db, $query);

    if (mysqli_num_rows($username_check) > 0) {
        $row = mysqli_fetch_assoc($username_check);

        //print_r($row);
        if ($row['password'] == md5($password) || $row['password'] == $password) {
            if ($row['status'] == 'active') {
                $_SESSION['user_login'] = $username;
                if (!empty($_POST['remember'])) {
                    setcookie('username', $username, time() + 1200);
                    setcookie('password', $password, time() + 1200);
                } else {
                    setcookie('username', $username, 6);
                    setcookie('password', $password, 6);
                }
                header('location:index.php');
            } else {
                $inactive_status = "ID has not been activated yet.";
            }
        } else {
            $wrong_password = "The Password is Wrong!";
        }
    } else {
        $username_error = "Username Not Found";
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
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <title>Student Management System</title>
    </head>
    <body>
        <div class="container animate__animated animate__shakeX">
            <br />
            <h1 class="text-center">Student Management System</h1>
            <br />
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <h2 class="text-center">Admin Login Form</h2>
                    <form action="login.php" method="post">
                        <div>
                            <input type="text" placeholder="username" name="username" required="" class="form-control" value="<?php
if (isset($username)) {
    echo $username;
}
elseif (isset ($_COOKIE['username'])) {
    echo $_COOKIE['username'];
}
?>">

                        </div>
                        <div>
                            <input type="password" placeholder="password" name="password" required="" class="form-control" value="<?php
if (isset($password)) {
    echo $password;
}
elseif (isset ($_COOKIE['password'])) {
    echo $_COOKIE['password'];
}
?>">

                        </div>
                        <br />
                        <div>
                            <input type="submit" value="Login" name="login" class="btn-info pull-right" >

                        </div>
                        <input type="checkbox" name="remember" checked="">&nbsp;Remember me<br>
                        <a href="../">Back</a>
                    </form>
                </div>
            </div>
            <?php
            if (isset($username_error)) {
                echo '<div class="alert alert-danger col-sm-4 offset-sm-4">' . $username_error . '</div>';
            }
            ?>
            <?php
            if (isset($wrong_password)) {
                echo '<div class="alert alert-danger col-sm-4 offset-sm-4">' . $wrong_password . '</div>';
            }
            ?>
<?php
if (isset($inactive_status)) {
    echo '<div class="alert alert-danger col-sm-4 offset-sm-4">' . $inactive_status . '</div>';
}
?>

        </div>

    </body>
</html>