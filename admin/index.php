<?php
session_start();

require_once 'dbcon.php';
if (!isset($_SESSION['user_login'])) {
    header('location:login.php');
}
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css">
        <link rel="stylesheet" type="text/css" href="../css/style.css" media="all"/>
        
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/1.11.3/js/dataTables.bootstrap5.min.js"></script>
        <script>
            jQuery(document).ready(function () {
                jQuery('#data').DataTable();
            });</script>


        <title>Student Management System</title>
    </head>
    <body>

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">
                <a class="navbar-brand " href="index.php"><h3>Student Management System</h3></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item px-4"><a href="index.php?page=dashboard" class="text-dark"><i class="fas fa-user px-1"></i>Welcome: <?php echo $_SESSION['user_login']; ?></a></li>
                        <li class="nav-item px-4"><a href="registration.php" class="text-dark"><i class="fas fa-user-plus px-1"></i>Add User</a></li>
                        <li class="nav-item px-4"><a href="index.php?page=user_profile" class="text-dark"><i class="fas fa-user px-1"></i>Profile</a></li>
                        <li class="nav-item px-4"><a href="logout.php" class="text-danger"><i class="fas fa-power-off px-1"></i>Logout</a></li>
                    </ul>

                </div>
            </div>
        </nav>

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-3">
                    <div class="list-group">
                        <a href="index.php?page=dashboard" class="list-group-item active"> <i class="fas fa-tachometer-alt px-2"></i>Dashboard</a>
                        <a href="index.php?page=add_student" class="list-group-item "> <i class="fas fa-user-plus px-2"></i>Add Student</a>
                        <a href="index.php?page=all_student" class="list-group-item "> <i class="fas fa-user-graduate px-2"></i>All Students</a>
                        <a href="index.php?page=all_user" class="list-group-item "> <i class="fas fa-users px-2"></i>All Users</a>

                    </div>

                </div>

                <div class="col-sm-9">
                    <div class="content">
                        <?php
                        //$page = $_GET['page'] . '.php';
                        //echo $_GET['page'];
                        if (isset($_GET['page'])) {
                            $page = $_GET['page'] . '.php';
                        } else {
                            $page = "dashboard.php";
                        }



                        if (file_exists($page)) {
                            require_once $page;
                        } else {
                            echo 'File Not Found';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>