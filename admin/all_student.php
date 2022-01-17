<h1 class="text-primary"><i class="fas fa-user px-2"></i>All Students</h1>  
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</a></li>
    <li class="active px-2"><i class="fas fa-users px-1"></i>All Students</li>
</ol>

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
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db_info = mysqli_query($db, "SELECT * FROM `student_info`;");
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
                    <td><a href="index.php?page=update_student&id=<?php echo base64_encode($row['id']); ?>"><i class="fas fa-pencil-alt"></i> Edit</a> &nbsp;
                        <a href="delete_student.php?id=<?php echo base64_encode($row['id']); ?>"><i class="fas fa-trash"></i> Delete</a></td>

                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>