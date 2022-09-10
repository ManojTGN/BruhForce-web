<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<?php
$userid = $_SESSION['userid'];
$username = $_SESSION['username'];
$query = mysqli_query($con,"select `USER_ID` from `order` where `USER_ID`=$userid;")or die(mysqli_error($con));
$OrderCount = mysqli_num_rows($query);
?>

<?php
if(isset($_POST["removeOrder"])){
    $orderid = $_POST["orderid"];
    $cartid = mysqli_fetch_array(mysqli_query($con,"SELECT `CART_ID` FROM `ORDER` WHERE `ORDER_ID`=$orderid AND `USER_ID`=$userid;"))[0];
    mysqli_query($con,"DELETE FROM `cart` WHERE `CART_ID`=$cartid AND `USER ID`=$userid AND `ORDERED`=1;")or die(mysqli_error($con));
    mysqli_query($con,"DELETE FROM `order` WHERE `ORDER_ID`=$orderid AND `USER_ID`=$userid;")or die(mysqli_error($con));
    header("Location: order.php");
}

if(isset($_POST["cancelDelivery"])){
    $orderid = $_POST["orderid"];
    $cartid = mysqli_fetch_array(mysqli_query($con,"SELECT `CART_ID` FROM `ORDER` WHERE `ORDER_ID`=$orderid AND `USER_ID`=$userid;"))[0];
    mysqli_query($con,"DELETE FROM `cart` WHERE `CART_ID`=$cartid AND `USER ID`=$userid AND `ORDERED`=1;")or die(mysqli_error($con));
    mysqli_query($con,"DELETE FROM `order` WHERE `ORDER_ID`=$orderid AND `USER_ID`=$userid;")or die(mysqli_error($con));
   
    header("Location: order.php");
}

if(isset($_POST["makeDelivered"])){
    $orderid = $_POST["orderid"];
    mysqli_query($con,"UPDATE `order` SET `NOW`=0, `TRACK`=2 WHERE`USER_ID`=$userid AND `ORDER_ID`=$orderid;");
    header("Location: order.php");
}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
    </head>
    <body style="background:#00ADB5">
        <?php include("header.php");?>
        <div class="container-fluid">
            
            <div class="card mx-auto" style="width:50%;margin-top:20px;background:#393E46;">
                <div class="card-body">
                    <h5 style="color:white;" class="card-title">Your Orders</h5><hr>
                    <?php if($OrderCount <= 0){?>
                        <h3 class="text-center text-muted"><i class="fa-solid fa-truck-fast" style="font-size:50px;"></i></h3>
                        <h3 class="text-muted text-center">You Haven't Ordered Anything yet</h3>
                    <?php 
                    }else{
                    $orderBoxIndex = 0;
                    $Orderquery = mysqli_query($con,"select * from `order` where `USER_ID`='$userid'")or die(mysqli_error($con));
                    while($order=mysqli_fetch_array($Orderquery)){
                        $orderBoxIndex++;
                        $orderid = $order["ORDER_ID"];
                        $track = $order["TRACK"];
                        $now = $order["NOW"];

                        if($track == 0){$track = 0 + $now;}
                        else if($track == 1){$track = 50 + $now;}
                        else if($track == 2){$track = 100;}
                        else{$track = 0;}
                    ?>
                    <div class="card">
                        <div class="card-header" <?php if($track >= 100){?>style="color:00ADB5;"<?php }?>> <b><?php if($track >= 100){?><i class="fa-solid fa-circle-check"></i><?php }?> Order <span style="background:<?php if($track >= 100){?>#00ADB5<?php }else{?>#393E46<?php }?>;" class="badge"><?php echo $orderBoxIndex;?></span></b></div>
                        <div class="card-body">
                        <div class="accordion" >
                            <div class="accordion-item">
                                <h2 class="accordion-header collapse" id="trackOrder<?php echo $orderBoxIndex;?>">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#trackOrder<?php echo $orderBoxIndex;?>" aria-expanded="true" aria-controls="trackOrder<?php echo $orderBoxIndex;?>">Track Order</button>
                                </h2>
                                <div id="trackOrder<?php echo $orderBoxIndex;?>" class="accordion-collapse collapse show" aria-labelledby="trackOrder<?php echo $orderBoxIndex;?>">
                                <div class="accordion-body">
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped" role="progressbar" aria-label="Default striped example" style="width: <?php echo $track;?>%;background-color:#00ADB5;" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col text-start" <?php if($track > 0){?>style="color:00ADB5;"<?php }?>><b><?php if($track > 0){?><i class="fa-solid fa-circle-check"></i><?php }?>Order</b></div>
                                        <div class="col text-center"<?php if($track >= 50){?>style="color:00ADB5;"<?php }?>><b><?php if($track >= 50){?><i class="fa-solid fa-circle-check"></i><?php }?>Restaurant</b></div>
                                        <div class="col text-end"  <?php if($track >= 100){?>style="color:00ADB5;"<?php }?>><b><?php if($track >= 100){?><i class="fa-solid fa-circle-check"></i><?php }?>Delivered</b></div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header<?php echo $orderBoxIndex;?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo<?php echo $orderBoxIndex;?>" aria-expanded="false" aria-controls="collapseTwo<?php echo $orderBoxIndex;?>">Order</button>
                                </h2>
                                <div id="collapseTwo<?php echo $orderBoxIndex;?>" class="accordion-collapse collapse" aria-labelledby="allDishes">
                                <div class="accordion-body">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Dish</th>
                                            <th scope="col">Quantity</th>
                                            <th scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $index = 1;
                                                $totalprice = 0;
                                                $cartid = $order["CART_ID"];
                                                $query = mysqli_query($con,"SELECT * FROM `cart` WHERE `USER ID`='$userid' AND `ORDERED`=1 AND `CART_ID`=$cartid")or die(mysqli_error($con));
                                                while($cart=mysqli_fetch_array($query)){
                                                    $dishid = $cart["DISH_ID"];
                                                    $dishquantity = $cart["QUANTITY"];
                                                    $dishprice = $cart["PRICE"] * $dishquantity;
                                                    $dishname = mysqli_fetch_array(mysqli_query($con,"select `DISH_NAME` from dishes WHERE `DISH_ID`=$dishid"))[0];
                                                    $totalprice += $dishprice;
                                            ?>
                                            <tr>
                                            <th scope="row"><?php echo $index;$index++;?></th>
                                            <td><?php echo $dishname;?></td>
                                            <td><?php echo "x".$dishquantity;?></td>
                                            <td><?php echo $dishprice;?></td>
                                            </tr>
                                            <?php }?>
                                            <tr>
                                            <th scope="row"></th>
                                            <td></td>
                                            <td style="text-end"><b>Total</b></td>
                                            <td><b><?php echo $totalprice;?></b></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    </div>
                                </div>
                                </div>
                            </div><br>
                            <?php 
                                if($track != 100){
                            ?>
                            <form method="POST">
                                <button style="background:#00ADB5;border-color:#00ADB5" class="btn" type="submit" name="cancelDelivery">Cancel Order</button>
                                <button style="color:00ADB5" class="btn btn-link" type="submit" name="makeDelivered">Delivered (beta)</button>
                                <input name="orderid" value="<?php echo $orderid;?>" style="visibility:hidden;"/>
                            </form>
                            <?php }else{?>
                            <form method="POST">
                                <button style="background:#00ADB5;border-color:#00ADB5" class="btn" type="submit" name="removeOrder">Done</button>
                                <input name="orderid" value="<?php echo $orderid;?>" style="visibility:hidden;"/>
                            </form>
                            <?php }?>
                        </div>
                    </div><br>
                    <?php }}?>
                </div>
            </div>

        </div>
    </body>
</html>