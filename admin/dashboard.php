
<h1 class="text-primary"><i class="fas fa-tachometer-alt px-2"></i>Dashboard <small class="text-gray">Statistics Overview</small></h1>  
<ol class="breadcrumb">
    <li class="text-gray active"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</li>
</ol>
<?php 
$count_student= mysqli_query($db, "SELECT * FROM `student_info`;");
$count_user= mysqli_query($db, "SELECT * FROM `users`;");

$total_student= mysqli_num_rows($count_student);
$total_user= mysqli_num_rows($count_user);

?>
<div class="row">
    <div class="col-sm-4">
        <div class="card">
            <div class="card card-header text-white bg-primary">
                <div class="row">
                    <div class="col-sm-3"><i class="fas fa-users fa-5x"></i></div>
                    <div class="col-sm-9">
                        <div class="pull-right" style="font-size: 45px"><?php echo $total_student;?></div>
                        <div class="clearfix"></div>
                        <div class="pull-right">All students</div>
                    </div>
                </div>
            </div>
            <a href="index.php?page=all_student">
                <div class="card-footer">
                    <span>All students</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-sm-4">
        <div class="card">
            <div class="card card-header text-white bg-primary">
                <div class="row">
                    <div class="col-sm-3"><i class="fas fa-users fa-5x"></i></div>
                    <div class="col-sm-9">
                        <div class="pull-right" style="font-size: 45px"> <?php echo $total_user;?></div>
                        <div class="clearfix"></div>
                        <div class="pull-right">All Users</div>
                    </div>
                </div>
            </div>
            <a href="index.php?page=all_user">
                <div class="card-footer">
                    <span>All Users</span>
                    <span class="pull-right"><i class="fas fa-arrow-circle-right"></i></span>
                    <div class="clearfix"></div>
                </div>
            </a>
        </div>
    </div>

</div>
<hr>
<h3>New Students</h3>
<div class="table-responsive">
    <table id="data" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Dept</th>
                <th>Roll</th>
                <th>CGPA</th>
                <th>City</th>
                <th>Contact</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db_info = mysqli_query($db, "SELECT * FROM `student_info`");
            while ($row = mysqli_fetch_assoc($db_info)) {
                ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo ucwords($row['name']); ?></td>
                    <td><?php echo strtoupper($row['dept']); ?></td>
                    <td><?php echo $row['roll']; ?></td>
                    <td><?php echo $row['cgpa']; ?></td>
                    <td><?php echo strtoupper($row['address']); ?></td>
                    <td><?php echo $row['contact']; ?></td>
                    <td><img style="width: 128px; height: 100px;" src="student_image/<?php echo $row['photo']; ?>" alt="alt"/></td>


                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
