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
    $query="SELECT * FROM `user` WHERE `EMAIL`='$email' and `PASSWORD`='$password'";
    $qry=mysqli_query($con,$query)or die(mysqli_error($con));

    //Checking If The Result Is More Than 0
    if(mysqli_num_rows($qry)>0){ 
        
        if($row=mysqli_fetch_array($qry)){
            $_SESSION['userid']=$row['USER ID'];
            $_SESSION['username']=$row['USERNAME'];
            $_SESSION['email']=$row['EMAIL'];
            $_SESSION['phonenumber']=$row['PHONE NUMBER'];
            $_SESSION['signed-in'] = true;
            header("Location: index.php");
        }
    
    }

    //Setting The Failed Alert To 1b.
    $alert_wrong = true;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body style="background:#00ADB5">

        <div style="background:#00ADB5"class="container-fluid">           
            <form method="POST">
            <div class="card mx-auto" style="width: 30%;margin-top:15%;background:#393E46;">
                <div class="card-body">
                <h5 style="color:white;"class="card-title">Sign In</h5><br>
                    <div class="input-group flex-nowrap">
                        <span style="background:#393E46;color:white;"class="input-group-text" id="addon-wrapping">Username</span>
                        <input name="email" value="medhunraj1307@gmail.com" type="text" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping">
                    </div>
                    <br>
                    <div class="input-group flex-nowrap">
                        <span style="background:#393E46;color:white;"class="input-group-text" id="addon-wrapping">password</span>
                        <input name="password" value="123456" type="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="addon-wrapping">
                    </div>
                    <br>
                    <br>
                    <div style="text-align: left;">
                        <button style="background:#00ADB5;border-color:#00ADB5" type="submit" name="login" class="btn btn-primary" >Sign in</button>
                        <a href="sign-up.php"><button style="color:#00ADB5;"type="button" class="btn btn-link">Sign up</button></a>
                    </div>
                </div>
            </div>
            
            </form>   
        </div> 
    </body>
</html>