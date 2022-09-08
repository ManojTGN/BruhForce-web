<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
    </head>

    <body>

        <div class="container-fluid">

        <div class="card mx-auto" style="width:50%;">
            <div class="card-body">
                <h5 class="card-title">Your Cart</h5>
                <div class="row">
                    <div class="col-8"><br><br>
                        <div class="mx-auto" style="width:50%;">
                            <i class="fa-solid fa-cart-shopping text-muted" style="font-size:70px;"></i><br><br>
                            <h6 class="card-subtitle mb-2 text-muted">Your Cart Is Empty</h6>
                        </div>
                        
                        <br><br><br>
                    </div>
                    <div class="col-4">
                        <br><br><br>
                        <div style="width:100%;border:1px solid black;border-style:dashed;"></div><br>
                        <div class="row">
                            <div class="col-8">
                                <h6 class="card-subtitle mb-2">Total:</h6>
                            </div>
                            <div class="col-4" style="text-align:right;">
                                <h6 class="card-subtitle mb-2">0.00</h6>
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