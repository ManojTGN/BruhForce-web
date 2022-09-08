<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<?php
$userid = $_SESSION['userid'];
$query = mysqli_query($con,"select `USER ID` from cart where `USER ID`='$userid' AND `ORDERED`=false")or die(mysqli_error($con));
$CartCount = mysqli_num_rows($query);
?>

<?php
if(isset($_POST["decreaseQuantity"])){
    $dishid = $_POST["dishid"];
    $cartid = $_POST["cartid"];
    $newQuantity = $_POST["quantity"];

    if($newQuantity > 1){
        $newQuantity -= 1;
        mysqli_query($con,"UPDATE cart SET `QUANTITY`=$newQuantity WHERE `DISH_ID`=$dishid AND `CART_ID`=$cartid AND `USER ID`=$userid;");
    } 

    header("Location: cart.php");
}

if(isset($_POST["increaseQuantity"])){
    $dishid = $_POST["dishid"];
    $cartid = $_POST["cartid"];
    $newQuantity = $_POST["quantity"]+1;

    mysqli_query($con,"UPDATE cart SET `QUANTITY`=$newQuantity WHERE `DISH_ID`=$dishid AND `CART_ID`=$cartid AND `USER ID`=$userid;");
    header("Location: cart.php");
}

if(isset($_POST["removeItem"])){
    $dishid = $_POST["dishid"];
    $cartid = $_POST["cartid"];
    print_r($cartid);
    mysqli_query($con,"DELETE FROM `cart` WHERE `DISH_ID`=$dishid AND `CART_ID`=$cartid AND `USER ID`=$userid;");
    header("Location: cart.php");
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <div class="container-fluid">

        <div class="card mx-auto" style="width:50%;margin-top:20px;">
            <div class="card-body">
                <h5 class="card-title">Your Cart</h5><hr>
                <div class="row">
                    <div class="col-8">
                        <?php 
                            if($CartCount <= 0){
                        ?>
                        <br><br>
                        <div class="mx-auto" style="width:50%;">
                            <i class="fa-solid fa-cart-shopping text-muted" style="font-size:70px;"></i><br><br>
                            <h6 class="card-subtitle mb-2 text-muted">Your Cart Is Empty</h6>
                        </div>
                        <?php 
                            }else{
                            $query = mysqli_query($con,"select * from cart where `USER ID`='$userid' AND `ORDERED`=false")or die(mysqli_error($con));
                            while($cart=mysqli_fetch_array($query)){
                                $dish_id = $cart['DISH_ID'];
                                $rest_id = $cart['REST_ID'];

                                $dish_price = $cart['PRICE'];
                                $dish_quantity = $cart['QUANTITY'];
                                $dish_name = mysqli_fetch_array(mysqli_query($con,"select `DISH_NAME` from dishes WHERE `DISH_ID`=$dish_id"))[0];
                                $rest_name = mysqli_fetch_array(mysqli_query($con,"select `REST_NAME` from restaurant WHERE `REST_ID`=$rest_id"))[0];
                        ?><br>
                        <div class="card w-100">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="fa-solid fa-utensils" style="margin-top:20px;font-size:100px;"></i>
                                    </div>
                                    <div class="col-8">
                                        <form method="POST">
                                        <div style="position:absolute;visibility:hidden;">
                                            <input name="dishid" value="<?php echo $dish_id;?>">
                                            <input name="cartid" value="<?php echo $cart['CART_ID'];?>">
                                            <input name="quantity" value="<?php echo $dish_quantity;?>">
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <b>Dish:</b><br>
                                                <b>Restaurant:</b><br>
                                                <b>Price:</b><br>
                                                <b>Quantity:</b>
                                            </div>
                                            <div class="col">
                                                <?php echo $dish_name;?><br>
                                                <?php echo $rest_name;?><br>
                                                <?php echo $dish_price;?><br>
                                                <ul class="pagination pagination-sm">
                                                    <li class="page-item"><button class="page-link" name="decreaseQuantity">-</button></li>
                                                    <li class="page-item"><a class="page-link"><?php echo $dish_quantity;?></a></li>
                                                    <li class="page-item"><button class="page-link" name="increaseQuantity">+</button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <button class="btn btn-link" name="removeItem">Remove This Item</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php }}?>
                        <br><br><br>
                    </div>
                    <div class="col-4">
                        <br><br><br>
                        <div class="row">
                            <div class="col-8">
                                <?php
                                    $total_price = 0;
                                    $query = mysqli_query($con,"select * from cart where `USER ID`='$userid' AND `ORDERED`=false")or die(mysqli_error($con));
                                    while($cart=mysqli_fetch_array($query)){
                                        $dish_id = $cart['DISH_ID'];
                                        $dish_quantity = $cart['QUANTITY'];
                                        $dish_name = mysqli_fetch_array(mysqli_query($con,"select `DISH_NAME` from dishes WHERE `DISH_ID`=$dish_id"))[0];
                                ?>
                                <div class="row">
                                    <div class="col"><h6 class="card-subtitle mb-2"><?php echo $dish_name;?></h6></div>
                                    <div class="col"><h6 class="card-subtitle mb-2"><?php echo "x".$dish_quantity;?></h6></div>
                                </div>
                                <?php }?>
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <?php
                                    $query = mysqli_query($con,"select * from cart where `USER ID`='$userid' AND `ORDERED`=false")or die(mysqli_error($con));
                                    while($cart=mysqli_fetch_array($query)){
                                        $dish_price = $cart['PRICE'];
                                        $dish_quantity = $cart['QUANTITY'];
                                        $total_price += $dish_price * $dish_quantity;
                                ?>
                                <h6 class="card-subtitle mb-2"><?php echo $dish_price*$dish_quantity;?></h6>
                                <?php }?>
                            </div>
                        </div><br>
                        <div style="width:100%;border:1px solid black;border-style:dashed;"></div><br>
                        <div class="row">
                            <div class="col-8">
                                <h6 class="card-subtitle mb-2">Total:</h6>
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <h6 class="card-subtitle mb-2"><?php echo $total_price;?></h6>
                            </div>
                        </div><br>
                        
                        <button class="btn btn-primary w-100">Proceed</button>
                    </div>
                </div>
                
            </div>
        </div>
            
        </div>

    </body>
</html>