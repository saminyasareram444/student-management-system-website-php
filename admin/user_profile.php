
<h1 class="text-primary"><i class="fas fa-user px-2"></i>User Profile <small class="text-dark">My Profile</small></h1>  
<ol class="breadcrumb">
    <li ><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</a></li>
    <li class="active px-2"><i class="fas fa-user px-1"></i>My Profile</li>
</ol>

<?php
$session_user=$_SESSION['user_login'];
$user_data= mysqli_query($db, "SELECT * FROM `users` WHERE `username` = '$session_user';");
$user_row= mysqli_fetch_assoc($user_data);

?>


<div class="row">
    <div class="col-sm-6">
        <table class="table table-bordered">
            <tr>
                <td>User ID</td>
                <td><?php echo $user_row['id'];?></td>
            </tr>
            <tr>
                <td>Name</td>
                <td><?php echo ucwords($user_row['name']);?></td>
            </tr>
            <tr>
                <td>Username</td>
                <td><?php echo $user_row['username'];?></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><?php echo $user_row['email'];?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td><?php echo ucwords($user_row['status']);?></td>
            </tr>
            <tr>
                <td>Signup Date</td>
                <td><?php echo $user_row['datetime'];?></td>
            </tr>


        </table>
    </div>
    <div class="col-sm-6">
         <br><br>
        <a href="">
            <img class="img-thumbnail" src="images/<?php echo $user_row['photo'];?>" alt="alt"/>
        </a>
         
         <?php
         if(isset($_POST['upload']))
         {
            $photo = explode('.', $_FILES['photo']['name']);
            $photo = end($photo);
            $photo_name = $session_user.'.'.$photo;
            
            $upload = mysqli_query($db, "UPDATE `users` SET `photo`='$photo_name' WHERE `username`='$session_user'");
            if($upload)
            {
                move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$photo_name);
            }

         }
         ?>
         <form action="" enctype="multipart/form-data" method="POST">
            <label class="text-dark" for="photo">Profile Picture</label><br>
            <input type="file" name="photo" required="" id="photo"><br><br>
            <input type="submit" name="upload" value="Upload" class="btn btn-sm btn-info" id="upload">
        </form>
    </div>
</div>