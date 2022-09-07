<?php  
include("connection.php");

//To Alert If The Entered Data Is Wrong
$alert_wrong = false;

//Login Post Method
if(isset($_POST['login'])){

    //Getting The Email And Password
    $email=$_POST["email"];
    $password=$_POST["password"];
    
    //Getting The Data From The Database
    $query="SELECT * FROM `register` WHERE `email`='$email' and `password`='$password'";
    $qry=mysqli_query($con,$query)or die(mysqli_error($con));

    //Checking If The Result Is More Than 0
    if(mysqli_num_rows($qry)>0){ 
        
        if($row=mysqli_fetch_array($qry)){
            $_SESSION['userid']=$row['id'];
            $_SESSION['email']=$row['email'];
            $_SESSION['name']=$row['name'];
            $_SESSION['image']=$row['profile'];
            $_SESSION['gid']=$row['gadgetsid'];
            $_SESSION['address']=$row['address'];
            $_SESSION['signed-in'] = true;
            header("Location: dashboard.php");
        }
    
    }

    //Setting The Failed Alert To 1b.
    $alert_wrong = true;

}   

?>

<html>
    <head>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>
        <div style="background-color: #393E46;height:100%;"class="container-fluid">
            
        </div>
        <div class="container-fluid" style="position:absolute;top:0;left:0;">               
            <div class="row">
                <div class="col-4"></div>
                <div class="col-8">
                    <div class="container text-center">
                        <div class="row">
                          <div class="col">
                            
                           
                          </div>
                          <div class="col">
                            <div class="d-flex align-items-end flex-column mb-3" style="height: 200px;">
                                <div class="mt-autop-2" style="background-color: 393E46;">
                                    <div class="w-50 p-3" style="height: 250px;"></div>
                                    <form>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping" style="background-color: 00ADB5;">Username</span>
                                        <input type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                                    </div>
                                    <br>
                                    <div class="input-group flex-nowrap">
                                        <span class="input-group-text" id="addon-wrapping" style="background-color: 00ADB5;">password</span>
                                        <input type="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="addon-wrapping">
                                    </div>
                                    <br>
                                    <br>
                                    <div style="text-align: left;">
                                        <button type="submit" class="btn btn-primary" style="margin-right: 20px; background-color:00ADB5; border-color:00ADB5;color: black;">Sign in</button>
                                        <button type="submit" class="btn btn-primary" style= "background-color:00ADB5; border-color:00ADB5;color: black;">Sign up</button>
                                    </div>
                                    </form>    
                                </div>
                            </div>
                          </div>
                          <div class="col">
                            
                          </div>
                        </div>
                      </div>
                
            </div>
        </div>
    </body>
</html>