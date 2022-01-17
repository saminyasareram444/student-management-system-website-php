
<h1 class="text-primary"><i class="fas fa-user-plus px-2"></i>Add Student</h1>  
<ol class="breadcrumb">
    <li><a href="index.php?page=dashboard"><i class="fas fa-tachometer-alt px-1"></i>Dashboard</a></li>
    <li class="active px-2"><i class="fas fa-user-plus px-1"></i>Add New Student</li>
</ol>

<?php
if(isset($_POST['add_student']))
{
    $name=$_POST['name'];
    $roll=$_POST['roll'];
    $dept=$_POST['dept'];
    $year=$_POST['year'];
    $cgpa=$_POST['cgpa'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];
    $photo= explode('.', $_FILES['photo']['name']);
    
    $photo_ext = end($photo);
    
    $photo_name = $roll.'.'.$photo_ext;
    
    $query = "INSERT INTO `student_info`( `name`, `roll`, `dept`, `year`, `cgpa`, `contact`, `address`, `photo`) VALUES ('$name','$roll','$dept','$year','$cgpa','$contact','$address','$photo_name');";
    
    $result=mysqli_query($db, $query);
    //print_r($result);
    if($result){
        $success="Data Successfully Inserted";
        move_uploaded_file($_FILES['photo']['tmp_name'], 'student_image/'.$photo_name);
    }
    else
    {
        //print_r($_POST);
        //print_r($_FILES);
        $error= "Warning! Insert All Data Carefully.";
    }
}
?>
<div class="row">
   <?php if(isset($success)){ echo '<p class="alert alert-success col-sm-6">'.$success.'</p>'; }?>
   <?php if(isset($error)){ echo '<p class="alert alert-danger col-sm-6">'.$error.'</p>'; }?>
</div>

<div class="row">
    <div class="col-sm-6">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="name">Student Name</label>
                <input type="text" name="name" placeholder="Student Name" id="name" class="form-control" required=""/>
            </div>
            <div class="form-group">
                <label for="roll">Student Roll</label>
                <input type="text" name="roll" placeholder="Student Roll" id="roll" class="form-control" pattern="[0-9]{7}" required=""/>
            </div>
            <div class="form-group">
                <label for="dept">Department</label>
                <select id="dept" class="form-control" name="dept" required="">
                    <option value="">Select</option>
                    <option value="cse">Computer Science & Engineering</option>
                    <option value="eee">Electrical & Electronic Engineering</option>
                    <option value="me">Mechanical Engineering</option>
                    <option value="ce">Civil Engineering</option>
                </select>
            </div>
            <div class="form-group">
                <label for="year">Year</label>
                <select id="year" class="form-control" name="year" required="">
                    <option value="">Select</option>
                    <option value="1st">First</option>
                    <option value="2nd">Second</option>
                    <option value="3rd">Third</option>
                    <option value="4th">Fourth</option>
                </select>
            </div>
            <div class="form-group">
                <label for="cgpa">CGPA</label>
                <input type="number" step="0.01" name="cgpa" placeholder="Grade" id="cgpa" class="form-control"/>
            </div>
            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" name="contact" placeholder="01*********" id="contact" class="form-control" pattern="01[0-9]{9}" required=""/>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" name="address" placeholder="City Name" id="address" class="form-control" required=""/>
            </div>

            <div class="form-group">
                <label for="photo">Add Photo</label>
                <input type="file" name="photo" id="photo"/>
            </div>
            <div class="form-group">
                <input type="submit" value="Add Student" name="add_student" class="btn btn-primary pull-right" />
            </div>
        </form>
    </div>
</div>