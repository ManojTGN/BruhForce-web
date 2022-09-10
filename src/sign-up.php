<?php  
include("connection.php");
?>

<?php
if(isset($_POST["createUser"])){
    $userid = mysqli_fetch_array(mysqli_query($con,"SELECT MAX(`S NO`) from user;"))[0] + 1;
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    mysqli_query($con,"INSERT INTO `user`(`USER ID`, `USERNAME`, `PASSWORD`, `EMAIL`, `PHONE NUMBER`) VALUES ($userid,'$username','$password','$email',$phone)")or die(mysqli_error($con));

    $_SESSION['userid']=$userid;
    $_SESSION['username']=$username;
    $_SESSION['email']=$email;
    $_SESSION['phonenumber']=$phone;
    $_SESSION['signed-in'] = true;

    header("Location: index.php");
}
?>

<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    </head>
    <body>

        <div class="container-fluid">           
            <form method="POST">
            <div class="card mx-auto" style="width: 30%;margin-top:10%;">
                <div class="card-body">
                <h5 class="card-title">Sign Up</h5><br>
                <form method="POST">
                <div class="input-group flex-nowrap" style="width: 300px;">
                    <span class="input-group-text" id="addon-wrapping">Username</span>
                    <input type="text" name="username" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="addon-wrapping" required>
                </div>
                <br>
                <div class="input-group flex-nowrap" style="width: 300px;">
                    <span class="input-group-text" id="addon-wrapping">phone no</span>
                    <input type="number" name="phone" class="form-control" placeholder="phone no" aria-label="phone no" aria-describedby="addon-wrapping" required>
                </div>
                <br>
                <div class="input-group flex-nowrap" style="width: 300px;">
                    <span class="input-group-text" id="addon-wrapping">Email ID</span>
                    <input type="email" name="email"class="form-control" placeholder="Email" aria-label="mail" aria-describedby="addon-wrapping" required>
                </div>
                <br>
                <div class="input-group flex-nowrap" style="width: 300px;">
                    <span class="input-group-text" id="addon-wrapping" >password</span>
                    <input type="password" name="password" class="form-control" placeholder="password" aria-label="password" aria-describedby="addon-wrapping" required>
                </div>
                <br>
                <br>
                <div style="text-align: left;" style="width: 200px;">
                    <button type="submit" name="createUser" class="btn btn-primary">Sign up</button>
                    <a href="sign-in.php"><button type="button" class="btn btn-link">Sign In</button></a>
                </div>
                </form>    
            
            </form>   
        </div> 
    </body>
</html>