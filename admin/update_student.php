
<h1 class="text-primary"><i class="fas fa-pencil-ruler px-2"></i>Update Student</h1>  
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</a></li>
    <li class="px-1"><a href="index.php?page=all_student"><i class="fas fa-users px-1"></i>All Students</a></li>
    <li class="active px-1"><i class="fas fa-pencil-ruler px-1"></i>Update Student</li>
</ol>
<?php 
$id= base64_decode($_GET['id']);
$db_data= mysqli_query($db, "SELECT * FROM `student_info` WHERE `id`='$id';");

$db_row= mysqli_fetch_assoc($db_data);

if(isset($_POST['update_student']))
{
    $name=$_POST['name'];
    $roll=$_POST['roll'];
    $dept=$_POST['dept'];
    $year=$_POST['year'];
    $cgpa=$_POST['cgpa'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    
    
    $query = "UPDATE `student_info` SET `name`='$name',`roll`='$roll',`dept`='$dept',`year`='$year',`cgpa`='$cgpa',`contact`='$contact',`address`='$address' WHERE `id`='$id';";
    $result=mysqli_query($db, $query);
    //print_r($result);
    if($result)
    {
        header('location:index.php?page=all_student');
    }
}
?>
<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Student Name" id="name" class="form-control" required="" value="<?php echo $db_row['name'];?>"/>
            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" placeholder="Student Roll" id="roll" class="form-control" pattern="[0-9]{7}" required=""value="<?php echo $db_row['roll'];?>"/>
            </div>
            <div class="form-group">
                <label for="dept">Department</label>
                <select id="dept" class="form-control" name="dept" required="">
                    <option value="">Select</option>
                    <option <?php echo $db_row['dept']=='cse' ? 'selected=""':'';?> value="cse">Computer Science & Engineering</option>
                    <option <?php echo $db_row['dept']=='eee' ? 'selected=""':'';?> value="eee">Electrical & Electronic Engineering</option>
                    <option <?php echo $db_row['dept']=='me' ? 'selected=""':'';?> value="me">Mechanical Engineering</option>
                    <option <?php echo $db_row['dept']=='ce' ? 'selected=""':'';?> value="ce">Civil Engineering</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <select id="year" class="form-control" name="year" required="">
                    <option value="">Select</option>
                    <option <?php echo $db_row['year']=='1st' ? 'selected=""':'';?> value="1st">First</option>
                    <option <?php echo $db_row['year']=='2nd' ? 'selected=""':'';?> value="2nd">Second</option>
                    <option <?php echo $db_row['year']=='3rd' ? 'selected=""':'';?> value="3rd">Third</option>
                    <option <?php echo $db_row['year']=='4th' ? 'selected=""':'';?> value="4th">Fourth</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cgpa">CGPA</label>
                <input type="number" step="0.01" name="cgpa" placeholder="Grade" id="cgpa" class="form-control" value="<?php echo $db_row['cgpa'];?>"/>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" placeholder="01*********" id="contact" class="form-control" pattern="01[0-9]{9}" required="" value="<?php echo $db_row['contact'];?>"/>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" placeholder="City Name" id="address" class="form-control" required="" value="<?php echo $db_row['address'];?>"/>
            </div>

            
            <div class="form-group">
                <input type="submit" value="Update Student" name="update_student" class="btn btn-primary pull-right" />
            </div>
        </form>
    </div>
</div>