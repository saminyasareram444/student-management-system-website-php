<h1 class="text-primary"><i class="fas fa-user px-2"></i>All Users</h1>  
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</a></li>
    <li class="active px-2"><i class="fas fa-users px-1"></i>All Users</li>
</ol>

<div class="table-responsive">
    <table id="data" class="table table-hover table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Username</th>
                <th>Photo</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $db_info = mysqli_query($db, "SELECT * FROM `users`");
            while ($row = mysqli_fetch_assoc($db_info)) {
                ?>

                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo ucwords($row['name']); ?></td>
                    <td><?php echo $row['email']; ?></td>
                    <td><?php echo ucwords($row['username']); ?></td>
                    <td><img style="width: 128px; height: 100px;" src="images/<?php echo $row['photo']; ?>" alt="alt"/></td>
                    
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>