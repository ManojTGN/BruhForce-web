<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<?php
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
if(!isset($_SESSION['AccountChoice'])){$_SESSION['AccountChoice'] = -1;}

$childrenPage = -1;
$seniorPage = -1;
?>

<?php
if(isset($_POST["chooseAccount"])){
    if(isset($_POST["AccountChoice"])){ 
        $_SESSION['AccountChoice'] = $_POST["AccountChoice"]; 
    }
}

if(isset($_POST["childrenBreakfast"])){$childrenPage = 0;}
if(isset($_POST["childrenLunch"])){$childrenPage = 1;}
if(isset($_POST["childrenDinner"])){$childrenPage = 2;}

if(isset($_POST["seniorBreakfast"])){$seniorPage = 0;}
if(isset($_POST["seniorLunch"])){$seniorPage = 1;}
if(isset($_POST["seniorDinner"])){$seniorPage = 2;}
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
        <div class="container-fluid">
        <?php if($_SESSION['AccountChoice'] == 0){?>

            <div class="modal fade" id="ChildrenOrder" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ChildrenOrderLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ChildrenOrderLabel">Confirm Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3 id="childrenOrderName1">Loading...</h3>
                    <div class="row">
                        <div class="col-4">
                            <img src="" id="childrenOrderImage" height="150" width="150" />
                        </div>
                        <div class="col-8">
                            <div class="input-group mb-3">
                                <span class="input-group-text">Dish</span>
                                <input id="childrenOrderName2" type="text" class="form-control" name="childrenOrderName" value="Loading..." disabled>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Price</span>
                                <input id="childrenOrderPrice" type="text" class="form-control" name="childrenOrderPrice" value="Loading..." disabled>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text">Quantity</span>
                                <input type="number" class="form-control" min="1" max="8" placeholder="1">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Back</button>
                    <button type="button" class="btn btn-primary">CONFIRM ORDER</button>
                </div>
                </div>
            </div>
            </div>
            <?php if($childrenPage == 0){?>
                <div class="header" style="text-align:center;font-size:50px;" ><h><b>BREAKFAST</b></h></div>
                <br><br>
                <div class="align" style="text-align:center;">  
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="190" id="Idliimg" src="https://assets.cntraveller.in/photos/627a4112cbc04ca509426501/4:3/w_2932,h_2199,c_limit/Vegetarian%20South%20Indian%20breakfast%20thali%20-%20Idli%20vada%20sambar%20chutney%20-%20Image%20ID%202H3783R%20(RF).jpg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">IDLI</h5>
                                <a onclick="changeChildrenOrderTo('Idli','10');" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" HEIGHT="190" id="Dosaimg" src="https://recipes.timesofindia.com/thumb/63841432.cms?width=1200&height=900" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">DOSA</h5>
                                <a onclick="changeChildrenOrderTo('Dosa','10');" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="190" id="Pongalimg" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTqTs6KzJOCF0mn1dCgMemd8etambeExI8pBA&usqp=CA">
                            <div class="card-body">
                                <h5 class="card-title">PONGAL</h5>
                                <a onclick="changeChildrenOrderTo('Pongal','10');" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" HEIGHT="190" id="Pooriimg" src="data:image/jpeg;base64,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" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">POORI</h5>
                                <a onclick="changeChildrenOrderTo('Poori','10');" href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" HEIGHT="190" id="BreadOmeletteimg" src="https://food.fnr.sndimg.com/content/dam/images/food/fullset/2020/02/10/0/FNK_One-Pan-Egg-Cheese-Omelet-Sandwich_H1_s4x3.jpg.rend.hgtvcom.616.462.suffix/1581344859765.jpeg" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">BREAD OMELETTE</h5>
                                <a onclick="changeChildrenOrderTo('BreadOmelette','10');"href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" id="Milkshakeimg" src="data:image/jpeg;base64,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" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">MILKSHAKE</h5>
                                <a onclick="changeChildrenOrderTo('Milkshake','10');"href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="190" id="BreadCheeseToastimg" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTv5m3iDtoUs6Zd7926EHhj78NyUtE8vCXBnH5lhcAKIya2BBlAkFvSgzRct1Ylc1zO8xM&usqp=CAU" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">BREAD CHEESE TOAST</h5>
                                <a onclick="changeChildrenOrderTo('BreadCheeseToast','10');"href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                    <label>
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="190" id="BreadButterJamimg" src="https://www.oetker.in/Recipe/Recipes/oetker.in/in-en/peanut-butter/image-thumb__52670__RecipeDetailsLightBox/grilled-peanut-butter-jam-sandwich.jpg">
                            <div class="card-body">
                                <h5 class="card-title">BREAD BUTTER JAM</h5>
                                <a onclick="changeChildrenOrderTo('BreadButterJam','10');"href="#" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ChildrenOrder">ORDER</a>
                            </div>
                        </div>
                    </label>
                </div>
            <?php }else if($childrenPage == 1){?>
                (in dev) (<code>0001</code>)
            <?php }else if($childrenPage == 2){?>
                (in dev) (<code>0002</code>)
            <?php }else {?>
                <div class="header" style="text-align:center;font-size:50px;" > <h><b>CHILDREN MENU</b></h> </div><br><br>

                <div class="align" style="text-align:center;">  
                    <label onclick="document.getElementById('childrenBreakfast').click();">
                        <div class="card" style="width: 18rem;margin-right:20px;">
                            <img class="card-img-top" src="https://img.freepik.com/premium-vector/delicious-tasty-breakfast-cartoon_24640-53952.jpg?w=900" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">BREAKFAST</h5>
                                <form method="POST">
                                <button class="btn btn-primary" name="childrenBreakfast" id="childrenBreakfast" class="btn btn-primary">Enter</button>
                                </form>
                            </div>
                        </div>
                    </label>
                    <label onclick="document.getElementById('childrenLunch').click();">
                        <div class="card" style="width: 18rem;margin-right:20px;">
                            <img class="card-img-top" height="190" src="https://i.pinimg.com/originals/5b/4d/f0/5b4df0fa087cdfc1cce0cb74c36d964a.gif" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">LUNCH</h5>
                                <form method="POST">
                                <button class="btn btn-primary" name="childrenLunch" id="childrenLunch" class="btn btn-primary">Enter</button>
                                </form>
                            </div>
                        </div>
                    </label>
                    <label onclick="document.getElementById('childrenDinner').click();">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" height="190" src="https://content.tinytap.it/A3D9D5C3-A630-4383-9CAC-06568C7FC2B9/coverImage.png?ver=1" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">DINNER</h5>
                                <form method="POST">
                                <button class="btn btn-primary" name="childrenDinner" id="childrenDinner" class="btn btn-primary">Enter</button>
                                </form>
                            </div>
                        </div>
                    </label>
                </div>
            <?php }?>
        <?php }else if($_SESSION['AccountChoice'] == 1){?>
            (in dev) (<code>0010</code>)
            (in dev) (<code>0011</code>)
            (in dev) (<code>0012</code>)
        <?php }else if($_SESSION['AccountChoice'] == 2){?>
            <?php if($seniorPage == 0){?>
                
            <?php }else if($seniorPage == 1){?>
                (in dev) (<code>0021</code>)
            <?php }else if($seniorPage == 2){?>
                (in dev) (<code>0022</code>)
            <?php }else {?>
            <div class="header" style="text-align:center;font-size:50px;" > <h><b>SENIOR CITIZEN MENU</b></h> </div><br><br>
            <div class="align" style="text-align:center;">  
                <label onclick="document.getElementById('seniorBreakfast').click();">
                    <div class="card" style="width: 18rem;margin-right:20px;">
                        <img class="card-img-top" src="https://sukhis.com/app/uploads/2019/09/Indian-Breakfast.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">BREAKFAST</h5>
                            <form method="POST">
                                <button class="btn btn-primary" name="seniorBreakfast" id="seniorBreakfast" class="btn btn-primary">Enter</button>
                            </form>
                        </div>
                    </div>
                </label>
                <label onclick="document.getElementById('seniorLunch').click();">
                    <div class="card" style="width: 18rem;margin-right:20px;">
                        <img class="card-img-top" src="https://st2.depositphotos.com/1354142/7950/i/950/depositphotos_79501056-stock-photo-south-indian-meals-served-on.jpg" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">LUNCH</h5>
                            <form method="POST">
                                <button class="btn btn-primary" name="seniorLunch" id="seniorLunch" class="btn btn-primary">Enter</button>
                            </form>
                        </div>
                    </div>
                </label>
                <label onclick="document.getElementById('seniorDinner').click();">
                    <div class="card" style="width: 18rem;">
                        <img class="card-img-top" height="190" src="https://c.ndtvimg.com/2021-05/tj7sdqj8_parotta_625x300_14_May_21.jpg?im=FeatureCrop,algorithm=dnn,width=620,height=350" alt="Card image cap">
                        <div class="card-body">
                            <h5 class="card-title">DINNER</h5>
                            <form method="POST">
                                <button class="btn btn-primary" name="seniorDinner" id="seniorDinner" class="btn btn-primary">Enter</button>
                            </form>
                        </div>
                    </div>
                </label>
            </div>
            <?php }?>
        <?php }?>
        </div>
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
                                    <div class="card-body"> <p class="card-text text-center" ><input class="form-check-input" value="0" type="radio" name="AccountChoice" id="childrenAccount"> <b>Children</b></p> </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card" onclick="document.getElementById('adultAccount').checked = true;">
                                    <i class="fa-solid fa-person text-center" style="font-size:200px;"></i>  
                                    <div class="card-body"> <p class="card-text text-center"><input class="form-check-input" value="1" type="radio" name="AccountChoice" id="adultAccount"> <b>Adult</b></p> </div>
                                </div>
                            </div>

                            <div class="col">
                                <div class="card" onclick="document.getElementById('seniorAccount').checked = true;">
                                    <i class="fa-solid fa-person-cane text-center" style="font-size:200px;"></i>
                                    <div class="card-body"> <p class="card-text text-center"><input class="form-check-input" value="2" type="radio" name="AccountChoice" id="seniorAccount"> <b>Senior Citizen</b></p> </div>
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
        
        <script>
            function changeChildrenOrderTo(name,price,imgURL){
                document.getElementById("childrenOrderName1").innerHTML=name;
                document.getElementById("childrenOrderName2").value=name;
                document.getElementById("childrenOrderPrice").value=price;
                document.getElementById("childrenOrderImage").src =document.getElementById(name+"img").src;
            }
        </script>

        <?php if($_SESSION['AccountChoice'] == -1){?>
        <script>$(document).ready(function(){ $("#Chooseprofile").modal('show'); });</script>
        <?php }?>
    </body>
</html>