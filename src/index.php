<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<?php
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
?>

<?php
$choosedAccount = -1;
if(isset($_POST["chooseAccount"])){
    $choosedAccount = 0;
    if(!isset($_POST["AccountChoice"])) $choosedAccount = -1;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    </head>
    <body>
        <?php include("header.php");?>
        <div class="modal fade" id="Chooseprofile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ChooseprofileLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="ChooseprofileLabel">Select Your Profile </h5>
                    </div>

                    <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col">
                                <div class="card" onclick="document.getElementById('childrenAccount').checked = true;">
                                    <i class="fa-solid fa-baby text-center" style="font-size:200px;"></i>
                                    <div class="card-body"> <p class="card-text text-center" ><input class="form-check-input" type="radio" name="AccountChoice" id="childrenAccount"> <b>Children</b></p> </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card" onclick="document.getElementById('adultAccount').checked = true;">
                                    <i class="fa-solid fa-person text-center" style="font-size:200px;"></i>  
                                    <div class="card-body"> <p class="card-text text-center"><input class="form-check-input" type="radio" name="AccountChoice" id="adultAccount"> <b>Adult</b></p> </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card" onclick="document.getElementById('seniorAccount').checked = true;">
                                    <i class="fa-solid fa-person-cane text-center" style="font-size:200px;"></i>
                                    <div class="card-body"> <p class="card-text text-center"><input class="form-check-input" type="radio" name="AccountChoice" id="seniorAccount"> <b>Senior Citizen</b></p> </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <h6 class="card-subtitle mb-2 text-muted"> <i class="fa-solid fa-circle-info"></i> Select A Profile And Submit </h6>
                        <button type="submit" class="btn btn-primary" name="chooseAccount" data-bs-dismiss="modal">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <?php if($choosedAccount == -1){?>
        <script>$(document).ready(function(){ $("#Chooseprofile").modal('show'); });</script>
        <?php }?>
    </body>
</html>