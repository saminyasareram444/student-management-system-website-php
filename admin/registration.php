<?php
require_once 'dbcon.php';
session_start();

if (!isset($_SESSION['user_login'])) {
    header('location:login.php');
}
if (isset($_POST['registration'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    $photo = explode('.', $_FILES['photo']['name']);
    $photo = end($photo);

    $photo_name = $username . '.' . $photo;

    $input_error = array();

    if (empty($name)) {
        $input_error['name'] = "The Name Field is required.";
    }

    if (empty($email)) {
        $input_error['email'] = "The Email Field is required.";
    }
    if (empty($username)) {
        $input_error['username'] = "The Username Field is required.";
    }
    if (empty($password)) {
        $input_error['password'] = "The Password Field is required.";
    }
    if (empty($cpassword)) {
        $input_error['cpassword'] = "The Confirm Password Field is required.";
    }

    //print_r(count($input_error));
    if (count($input_error) == 0) {
        $email_check = mysqli_query($db, "SELECT * FROM `users` WHERE `email` = '$email';");
        if (mysqli_num_rows($email_check) == 0) {
            $username_check = mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '$username';");
            if (mysqli_num_rows($username_check) == 0) {
                if (strlen($username) > 2) {
                    if (strlen($password) > 3) {
                        if ($password == $cpassword) {
                            $password = md5($password);
                            $query = "INSERT INTO `users`(`name`, `email`, `username`, `password`, `photo`, `status`) VALUES ('$name','$email','$username','$password','$photo_name','inactive');";
                            $result = mysqli_query($db, $query);
                            if ($result) {
                                $_SESSION['data_insert_success'] = "Data Successfully Inserted";

                                move_uploaded_file($_FILES['photo']['tmp_name'], 'images/' . $photo_name);
                                header('location:registration.php');
                            } else {
                                $_SESSION['data_insert_error'] = "Data Insert Error";
                            }
                        } else {
                            $password_error = "Both passwords did not match. Try again!";
                        }
                    } else {
                        $password_len = "Password must be at least 4 characters";
                    }
                } else {
                    $username_len = "Username must be at least 3 characters";
                }
            } else {
                $username_error = "This username already exists.";
            }
        } else {
            $email_error = "This email address already exists.";
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
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
        <link rel="stylesheet" type="text/css" href="../css/style.css" media="all"/>
        <title>Student Management System</title>
    </head>
    <body>
        <div class="container">
            <br />

            <div class="row">
                <div class="col-md-12 offset-md-4">
                    <h1 class="text-gray">User Registration Form</h1>
                    <?php
                    if (isset($_SESSION['data_insert_success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['data_insert_success'] . '</div>';
                    };
                    ?>
                    <?php
                    if (isset($_SESSION['data_insert_error'])) {
                        echo '<div class="alert alert-warning">' . $_SESSION['data_insert_error'] . '</div>';
                    }
                    ?>

                    <br>
                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal" >
                        <div class="form-group row">
                            <label for="name" class="control-label col-sm-1">Name</label>
                            <div class="col-sm-4">
                                <input id="name" class=" form-control" type="text" name="name" placeholder="Enter Your Name." value="<?php
                    if (isset($name)) {
                        echo $name;
                    }
                    ?>"/>


                            </div>
                            <label class="error">
<?php
if (isset($input_error['name'])) {
    echo $input_error['name'];
}
?>
                            </label>

                        </div>
                        <div class="form-group row">
                            <label for="email" class="control-label col-sm-1">Email</label>
                            <div class="col-sm-4">
                                <input id="email" class=" form-control" type="email" name="email" placeholder="Enter Your Email." value="<?php
if (isset($email)) {
    echo $email;
}
?>"/>


                            </div>
                            <label class="error">
                                <?php
                                if (isset($input_error['email'])) {
                                    echo $input_error['email'];
                                }
                                ?>
<?php
if (isset($email_error)) {
    echo $email_error;
}
?>

                            </label>                         
                        </div>
                        <div class="form-group row">
                            <label for="username" class="control-label col-sm-1">Username</label>
                            <div class="col-sm-4">
                                <input id="username" class=" form-control" type="text" name="username" placeholder="Enter Your Username." value="<?php
if (isset($username)) {
    echo $username;
}
?>"/>

                            </div>
                            <label class="error"><?php
                                if (isset($input_error['username'])) {
                                    echo $input_error['username'];
                                }
?> </label>
                            <label class="error"><?php
                                       if (isset($username_error)) {
                                           echo $username_error;
                                       }
                                       ?> </label> 
                            <label class="error"><?php
                                if (isset($username_len)) {
                                    echo $username_len;
                                }
                                ?> </label> 
                        </div>
                        <div class="form-group row">
                            <label for="password" class="control-label col-sm-1">Password</label>
                            <div class="col-sm-4">
                                <input id="password" class=" form-control" type="password" name="password" placeholder="Enter Password." value="<?php
                                if (isset($password)) {
                                    echo $password;
                                }
                                ?>"/>

                            </div>
                            <label class="error">
                                <?php
                                if (isset($input_error['password'])) {
                                    echo $input_error['password'];
                                }
                                ?>
                            </label>
                            <label class="error">
                                <?php
                                if (isset($password_len)) {
                                    echo $password_len;
                                }
                                ?>
                            </label>
                        </div>
                        <div class="form-group row">
                            <label for="cpassword" class="control-label col-sm-1">Confirm password</label>
                            <div class="col-sm-4">
                                <input id="cpassword" class=" form-control" type="password" name="cpassword" placeholder="Confirm your password." value="<?php
                                if (isset($cpassword)) {
                                    echo $cpassword;
                                }
                                ?>"/>

                            </div>
                            <label class="error">
<?php
if (isset($input_error['cpassword'])) {
    echo $input_error['cpassword'];
}
?>
                            </label>
                            <label class="error">
<?php
if (isset($password_error)) {
    echo $password_error;
}
?>
                            </label>                          
                        </div>
                        <div class="form-group row">
                            <label for="photo" class="control-label col-sm-1">Photo</label>
                            <div class="col-sm-4">
                                <input id="photo" type="file" name="photo" />
                            </div>

                        </div>
                        <br>
                        <div class="col-sm-4 offset-sm-2">
                            <input type="submit" value="Register" name="registration" class="btn btn-primary" >

                        </div>
                        <br><br>
                        <p>If you have an account? Then please <a href="login.php">Login</a></p>
                    </form>

                </div>
            </div>
        </div>

    </body>
</html>