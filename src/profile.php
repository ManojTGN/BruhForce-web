<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<?php
$userid = $_SESSION['userid'];
$query = mysqli_query($con,"select `USER ID` from address where `USER ID`='$userid'")or die(mysqli_error($con));
$addressCount = mysqli_num_rows($query);
?>

<?php

if(isset($_POST['changeUsername'])){
    $username = $_POST["username"];
    $username_pattern = "/^[A-Za-z][A-Za-z0-9_]{4,20}$/";

    if(preg_match($username_pattern, $username)){
        mysqli_query($con,"UPDATE `user` SET `username`='$username' WHERE `USER ID`=$userid") or die(mysqli_error($con));
        $_SESSION['username'] = $username;
    }

    header("Location: profile.php");
}

if(isset($_POST['changeEmail'])){
    $email = $_POST["email"];
    $email_pattern = "/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";

    if(preg_match($email_pattern, $email)){
        mysqli_query($con,"UPDATE `user` SET `email`='$email' WHERE `USER ID`=$userid") or die(mysqli_error($con));
        $_SESSION['email'] = $email;
    }

    header("Location: profile.php");
}

if(isset($_POST['addAddress'])){
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $region = $_POST["region"];
    $postal = $_POST["postal"];

    if($addressCount < 5){
        mysqli_query($con,"INSERT INTO `address`(`USER ID`, `ADDRESS 1`, `ADDRESS 2`, `CITY`, `REGION`, `POSTAL`) VALUES ('$userid','$address1','$address2','$city','$region','$postal')")or die(mysqli_error($con));
    }

    header("Location: profile.php");
}

if(isset($_POST['editAddress'])){
    $addressid = $_POST["addressid"];
    $address1 = $_POST["address1"];
    $address2 = $_POST["address2"];
    $city = $_POST["city"];
    $region = $_POST["region"];
    $postal = $_POST["postal"];
    mysqli_query($con,"UPDATE `address` SET `ADDRESS 1` = '$address1', `ADDRESS 2` = '$address2', `CITY` = '$city', `REGION` = '$region', `POSTAL`=$postal WHERE `S NO`=$addressid;");

    header("Location: profile.php");
}

if(isset($_POST['deleteAddress'])){
    $addressid = $_POST["addressid"];
    mysqli_query($con,"DELETE FROM `address` WHERE `USER ID`=$userid AND `S NO`=$addressid;");
    
    header("Location: profile.php");
}

if(isset($_POST['changePassword'])){
    $password = $_POST["currentPassword"];
    $confirmPassword = $_POST["confirmedPassword"];
    $newPassword = $_POST["newPassword"];
    
    $query = mysqli_query($con,"select `PASSWORD` from `user` where `USER ID`='$userid'")or die(mysqli_error($con));
    $currentPassword = mysqli_fetch_array($query)['PASSWORD'];

    if(($confirmPassword == $newPassword) && $password==$currentPassword){
        mysqli_query($con,"UPDATE `user` SET `PASSWORD` = '$newPassword' WHERE `USER ID`=$userid");
    }
    header("Location: profile.php");
}

if(isset($_POST["deleteAccount"])){
    $password = $_POST["password"];
    $query = mysqli_query($con,"select `PASSWORD` from `user` where `USER ID`='$userid'")or die(mysqli_error($con));
    $currentPassword = mysqli_fetch_array($query)['PASSWORD'];

    if($password == $currentPassword){
        mysqli_query($con,"DELETE FROM `user` WHERE `USER ID`=$userid;");
        mysqli_query($con,"DELETE FROM `address` WHERE `USER ID`=$userid;");
        
        header("Location: sign-out.php");
    }
    header("Location: profile.php");
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container-fluid h-100 square-box d-flex justify-content-center align-items-center">

                <div class="card w-50 mx-auto">
                    <div class="card-body">
                        <h3 class="card-title"><i class="fa-solid fa-gear"></i> Settings</h3><hr>
                        <div class="card-body">
                            <div class="d-flex align-items-start">
                                <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                    <button class="nav-link active" id="v-pills-general-tab" data-bs-toggle="pill" data-bs-target="#v-pills-general" type="button" role="tab" aria-controls="v-pills-general" aria-selected="true">General</button>
                                    <button class="nav-link" id="v-pills-password-tab" data-bs-toggle="pill" data-bs-target="#v-pills-password" type="button" role="tab" aria-controls="v-pills-password" aria-selected="false">Password & Security</button>
                                    <button class="nav-link" id="v-pills-payments-tab" data-bs-toggle="pill" data-bs-target="#v-pills-payments" type="button" role="tab" aria-controls="v-pills-payments" aria-selected="false">Payment & Transactions</button>
                                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
                                </div>
                                <div class="tab-content" id="v-pills-tabContent">
                                    <div class="tab-pane fade show active" id="v-pills-general" role="tabpanel" aria-labelledby="v-pills-general-tab" tabindex="0">
                                        <h4>GENERAL SETTINGS</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">Manage the account details you've shared with BruhForce including your name, contact info and more</h6><br>
                                        <h4>ACCOUNT INFO</h4>
                                        <h6 class="card-subtitle mb-2 text-muted"><span style="color:black;">ID:</span> <?php echo $_SESSION['userid'];?></h6><br>
                                        
                                            <div class="row">
                                                <div class="col">
                                                <form method="POST">
                                                    <div class="row">
                                                        <div class="col-9">
                                                            <input class="form-control" name="username" type="text" placeholder="Username" value="<?php echo $_SESSION['username']?>" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <button type="submit" name="changeUsername" class="btn btn-primary h-100 w-100"><i class="fa-solid fa-pen"></i></button>
                                                        </div>
                                                    </div>
                                                </form>
                                                </div>

                                                <div class="col">
                                                    <form method="POST">
                                                    <div class="row">
                                                    
                                                        <div class="col-9">
                                                            <input class="form-control" name="email" type="text" placeholder="Email" value="<?php echo $_SESSION['email']?>" required>
                                                        </div>
                                                        <div class="col-3">
                                                            <button type="submit" name="changeEmail" class="btn btn-primary h-100 w-100"><i class="fa-solid fa-pen"></i></button>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div><hr>
                                        <h4>ADDRESS</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">You Can Have Upto Maximum Of 5 Addresses</h6><br>
                                        <ol class="list-group <?php if($addressCount > 0){?>list-group-numbered<?php }?>">
                                            <?php 
                                                if($addressCount <= 0){
                                            ?>
                                            <li class="list-group-item d-flex justify-content-between align-items-start">
                                                <div class="ms-2 me-auto">
                                                <div class="fw-bold">You Haven't Added Your Address Yet!</div>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddress">
                                                Add Now
                                                </button>
                                                </div>
                                                <span class="badge bg-warning rounded-pill">!</span>
                                            </li>
                                            <?php 
                                                }else{
                                                    $index = 1;
                                                    $query = mysqli_query($con,"select * from address where `USER ID`='$userid'")or die(mysqli_error($con));
                                                    while($address=mysqli_fetch_array($query)){
                                            ?>
                                                <div class="modal fade" id="editAddress<?php echo $index;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editAddress<?php echo $index;?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editAddress<?php echo $index;?>Label">Edit Address</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <input name="addressid" value="<?php echo $address['S NO'];?>" style="visibility:hidden;"/>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text" name="address1" value="<?php echo $address['ADDRESS 1']?>" placeholder="Address Line 1" required>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="address2" value="<?php echo $address['ADDRESS 2']?>" placeholder="Address Line 2" required>
                                                                    </div>
                                                                </div><br>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text" name="city" value="<?php echo $address['CITY']?>" placeholder="City" required>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="region" value="<?php echo $address['REGION']?>" placeholder="Region" required>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="postal" value="<?php echo $address['POSTAL']?>" placeholder="Postal Code" required>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                <button type="submit" class="btn btn-primary" name="editAddress">Edit</button>
                                                            </div>
                                                        </form> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal fade" id="deleteAddress<?php echo $index;?>" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteAddress<?php echo $index;?>Label" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="deleteAddress<?php echo $index;?>Label">Delete Address</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <h6 class="card-subtitle mb-2 text-muted">Are You Sure You Want To Delete This Address?</h6><input name="addressid" value="<?php echo $address['S NO'];?>" style="visibility:hidden;"/>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text" name="address1" value="<?php echo $address['ADDRESS 1']?>" placeholder="Address Line 1" disabled>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="address2" value="<?php echo $address['ADDRESS 2']?>" placeholder="Address Line 2" disabled>
                                                                    </div>
                                                                </div><br>
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input class="form-control" type="text" name="city" value="<?php echo $address['CITY']?>" placeholder="City" disabled>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="region" value="<?php echo $address['REGION']?>" placeholder="Region" disabled>
                                                                    </div>
                                                                    <div class="col">
                                                                    <input class="form-control" type="text" name="postal" value="<?php echo $address['POSTAL']?>" placeholder="Postal Code" disabled>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                                <button type="submit" class="btn btn-danger" name="deleteAddress">Delete</button>
                                                            </div>
                                                        </form> 
                                                        </div>
                                                    </div>
                                                </div>
                                                <li class="list-group-item d-flex justify-content-between align-items-start">
                                                    <div class="col-8">
                                                        <div class="ms-2 me-auto">
                                                        <div class="fw-bold">Address <?php echo $index;?></div>
                                                        <?php echo $address['ADDRESS 1']?><br>
                                                        <?php echo $address['ADDRESS 2']?><br>
                                                        <?php echo $address['CITY']?> <?php echo $address['REGION']?> (<?php echo $address['POSTAL']?>)
                                                        </div>
                                                    </div>
                                                    <div class="col-4">
                                                        <button type="submit" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editAddress<?php echo $index;?>">Edit </button><p></p>
                                                        <button type="submit" class="btn btn-danger w-100"  data-bs-toggle="modal" data-bs-target="#deleteAddress<?php echo $index;?>">Delete </button>
                                                    </div>
                                                </li>
                                            <?php $index++;}}?>
                                        </ol><br>
                                        <?php if($addressCount >=1){?>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addAddress" <?php if($addressCount ==5){echo ' data-bs-toggle="tooltip" data-bs-placement="right" data-bs-title="Maximum Address Reached [5]" disabled';}?>>
                                            Add New Address
                                        </button>
                                        <?php }?>
                                        <div class="modal fade" id="addAddress" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addAddressLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addAddressLabel">Add Your Address</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form method="POST">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input class="form-control" type="text" name="address1" placeholder="Address Line 1" required>
                                                            </div>
                                                            <div class="col">
                                                            <input class="form-control" type="text" name="address2" placeholder="Address Line 2" required>
                                                            </div>
                                                        </div><br>
                                                        <div class="row">
                                                            <div class="col">
                                                                <input class="form-control" type="text" name="city" placeholder="City" required>
                                                            </div>
                                                            <div class="col">
                                                            <input class="form-control" type="text" name="region" placeholder="Region" required>
                                                            </div>
                                                            <div class="col">
                                                            <input class="form-control" type="text" name="postal" placeholder="Postal Code" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                        <button type="submit" name="addAddress" class="btn btn-primary">Add</button>
                                                    </div>
                                                </form> 
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <h4>DELETE ACCOUNT</h4>
                                        <div class="row">
                                            <div class="col-7">
                                                <h6 class="card-subtitle mb-2 text-muted">Click <code>REQUEST ACCOUNT DELETE</code> to start the process of permanently deleting your BruhForce account including all personal information, purchases.</h6>
                                            </div>
                                            <div class="col-5">
                                            <form method="POST">
                                                <button type="button" class="btn btn-danger w-100" data-bs-toggle="modal" data-bs-target="#deleteAccount">REQUEST DELETE ACCOUNT</button>
                                            </form>
                                            </div>
                                        </div>
                                        <div class="modal fade" id="deleteAccount" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="deleteAccountLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <form method="POST">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteAccountLabel">Delete Account</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <h6 class="card-subtitle mb-2 text-muted">Are You Sure You Want To Delete The Account?</h6><br>
                                                Please Type Your Password To Permenantly Delete Your Account!.
                                                <input class="form-control" type="password" name="password" placeholder="Password" required>
                                            </div>
                                            <div class="modal-footer">
                                                
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                <button type="submit" class="btn btn-danger" name="deleteAccount">DELETE MY ACCOUNT</button>
                                                
                                            </div>
                                            </div>
                                            </form>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-password" role="tabpanel" aria-labelledby="v-pills-password-tab" tabindex="0">
                                    <h4>CHANGE YOUR PASSWORD</h4>
                                    <h6 class="card-subtitle mb-2 text-muted">For your security, we highly recommend that you choose a unique password that you don't use for any other online account.</h6><br><br>    
                                    <form method="POST">
                                    <div class="row">
                                        <div class="col">
                                            <h6 class="card-subtitle mb-2 text-muted"><b style="color:black;">CURRENT PASSWORD</b> required*</h6>
                                            <input type="password" placeholder="current password" name="currentPassword" class="form-control" required><br><br>

                                            <h6 class="card-subtitle mb-2 text-muted"><b style="color:black;">NEW PASSWORD</b> required*</h6>
                                            <input type="password" placeholder="new password" name="newPassword" class="form-control" required><br><br>

                                            <h6 class="card-subtitle mb-2 text-muted"><b style="color:black;">RETYPE NEW PASSWORD</b> required*</h6>
                                            <input type="password" placeholder="retype new password" name="confirmedPassword" class="form-control" required><br><br>
                                        </div>
                                        <div class="col">
                                        <h6 class="card-subtitle mb-2 text-muted"><b style="color:black;">YOUR PASSWORD</b></h6>
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted">Your password must have 7+ characters</h6></li>
                                            <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted">Your password must have at least 1 number</h6></li>
                                            <li class="list-group-item"><h6 class="card-subtitle mb-2 text-muted">Your password must contain no space(s)</h6></li>
                                        </ul>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary" name="changePassword">Save Changes</button>
                                    </form><br><hr>
                                    <h4>SIGNOUT EVERYWHERE</h4>
                                    <div class="row">
                                        <div class="col"><h6 class="card-subtitle mb-2 text-muted">Sign out everywhere else your BruhForce account is being used, including all other browsers, phones, or any other devices</h6></div>
                                        <div class="col"><button type="submit" class="btn btn-primary">Sign Out Other Session</button></div>
                                    </div>
                                    </div>
                                    <div class="tab-pane fade" id="v-pills-payments" role="tabpanel" aria-labelledby="v-pills-payments-tab" tabindex="0">
                                        <h4>PAYMENT MANAGEMENT</h4>
                                        <h6 class="card-subtitle mb-2 text-muted">View your payment activity and the current balance of your BruhForce account.</h6><br>
                                        <h6 class="card-subtitle mb-2 text-muted"><b style="color:black;">YOUR PAYMENT METHODS</b></h6>
                                        <h6 class="card-subtitle mb-2 text-muted">Add or manage payment methods associated with your BruhForce Account.</h6>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addPayment">
                                        Add Payment Method
                                        </button>
                                        <hr>
                                        <h4>TRANSACTIONS</h4>
                                        <div class="modal fade" id="addPayment" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addPaymentLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="addPaymentLabel">Add Payment</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="accordion accordion-flush" id="accordionFlushExample">
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingOne" onclick="document.getElementById('firstRadio').checked = true;">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                                                                    <input class="form-check-input me-1" type="radio" name="paymentRadio" id="firstRadio"><label class="form-check-label" for="firstRadio">Credit Card</label> 
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <h6 class="card-subtitle mb-2 text-muted">Card Details</h6>
                                                                <input type="text" placeholder="Card Number" class="form-control" required><br>
                                                                <div class="row">
                                                                    <div class="col"><input type="text" placeholder="Expiration" class="form-control" required></div>
                                                                    <div class="col"><input type="password" placeholder="CVV" class="form-control" required></div>
                                                                </div><br>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingTwo" onclick="document.getElementById('secondRadio').checked = true;">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                                                                    <input class="form-check-input me-1" type="radio" name="paymentRadio" id="secondRadio"><label class="form-check-label" for="secondRadio">Paypal</label> 
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <h6 class="card-subtitle mb-2 text-muted">You will be directed to PayPal to authorize your payment method, then you will be returned to BruhForce to complete this purchase.</h6>
                                                                <button type="submit" class="btn btn-primary">Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="flush-headingThree" onclick="document.getElementById('threeRadio').checked = true;">
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                                                                    <input class="form-check-input me-1" type="radio" name="paymentRadio" id="threeRadio"><label class="form-check-label" for="threeRadio">UPI</label> 
                                                                </button>
                                                            </h2>
                                                            <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                                            <div class="accordion-body">
                                                                <input type="text" placeholder="UPI ID" class="form-control" required><br>
                                                                <button type="submit" class="btn btn-primary">Verify</button> <button type="submit" class="btn btn-primary" disabled>Save</button>
                                                            </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Dismiss</button>
                                                </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

        </div>
    </body>
</html>