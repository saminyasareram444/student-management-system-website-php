<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

        <title>Student Management System</title>
        <link rel="icon" type="image/x-icon" href="favicon.ico">

    </head>
    <body style="background-image: url('bg.png') ; ">
        <div class="container">
            <br>
            <a class="btn btn-primary pull-right" href="admin/login.php"> Login </a><br><br>
            <h1 class="text-center">Welcome to Student Management System</h1><br>

            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <form action="" method="post">
                        <table class="table table-bordered bg-light">
                            <tr>
                                <td class="text-center" colspan="2"><label>Student Information</label></td>
                            </tr>

                            <tr>
                                <td><label for="choose">Choose Year</label></td>

                                <td>
                                    <select class="form-control" id= "choose" name="choose" >
                                        <option value="" selected="" disabled="">Select</option>
                                        <option value="1st">First</option>
                                        <option value="2nd">Second</option>
                                        <option value="3rd">Third</option>
                                        <option value="4th">Fourth</option>
                                    </select>
                                </td>
                            </tr> 

                            <tr>
                                <td><label for="choosed">Choose Dept</label></td>

                                <td>
                                    <select class="form-control" id= "choosed" name="choosed">
                                        <option value="" selected="" disabled="">Select</option>
                                        <option value="cse">CSE</option>
                                        <option value="eee">EEE</option>
                                        <option value="me">ME</option>
                                        <option value="ce">CE</option>
                                    </select>
                                </td>
                            </tr> 

                            <tr>
                                <td><label for="roll">Roll</label></td>
                                <td><input class="form-control" type="text" name="roll" pattern="[0-9]{7}" placeholder="Enter 7 digit roll"/></td>
                            </tr>

                            <tr>
                                <td class="text-center" colspan="2"><input type="submit" value="Submit Info" name="show_info"></td>
                            </tr>



                        </table>
                    </form>
                </div>
            </div>
            
            <br><br>
            <?php
            require_once './admin/dbcon.php';
            
            if(isset($_POST['show_info']))
            {
                
                
                $choose=$_POST['choose'];
                $choosed=$_POST['choosed'];
                $roll=$_POST['roll'];
                $result= mysqli_query($db, "SELECT * FROM `student_info` WHERE `year` = '$choose' AND `roll` = '$roll' AND `dept` = '$choosed';");
                //print_r($result);

                if(mysqli_num_rows($result)==1)
                {
                    $row= mysqli_fetch_assoc($result);
                    
                   ?>
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    <table class="table table-bordered bg-light">
                        
                        <tr>
                            <td rowspan="5">
                                <img class="img-thumbnail" src="admin/student_image/<?php echo $row['photo'];?>" style="height: 200px" alt="alt"/>
                            </td>
                            
                        </tr>
                        <tr>
                            <td>Name</td>
                            <td><?php echo $row['name'];?></td>
                        </tr>
                        <tr>
                            <td>Roll</td>
                            <td><?php echo $row['roll'];?></td>
                        </tr>
                        <tr>
                            <td>Year</td>
                            <td><?php echo $row['year'];?></td>
                        </tr>
                        <tr>
                            <td>CGPA</td>
                            <td><?php echo $row['cgpa'];?></td>
                        </tr>
                        
                    </table>
                </div>
            </div>
 <?php
                }
                else
                {
                    ?>
            <script type="text/javascript"> alert('Data not found');</script>
            <?php
                    
                }
                
                
            }
            ?>
            
            
        </div>


        
    </body>
</html>