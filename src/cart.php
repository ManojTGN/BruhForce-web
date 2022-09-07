<?php  
include("connection.php");
if(!isset($_SESSION['signed-in'])){header("Location: sign-in.php");}
?>

<html>
    <head>
        <script src="https://kit.fontawesome.com/08c3f952c9.js" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
        <link href="css/cart.css" rel="stylesheet"/>
    </head>

    <body>

        <div class="container-fluid"> <br>

            <div class="row">
                <div class="col">
                    <nav style="font-size: 30px;" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                          <li class="breadcrumb-item">
                            <button type="button" class="btn btn btn-lg" > Username </button>
                          </li>
                          <li class="breadcrumb-item active" aria-current="page">
                            <h2 style="margin-top:5px;">Your Cart</h2>
                          </li>
                        </ol>
                    </nav>
                </div>
            </div>

            <div class="row" style="height:87%">
                <div class="col-8">
                    <div class="card h-100">
                        <div class="card-body">
                            <div class="row h-100">
                                <div class="col"></div><div class="col">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <h3 style="color:#393E46;">Your Cart Is Empty!</h3>
                                </div><div class="col"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <div style="height:90%"></div>
                            <div class="dash"></div><br>
                            <div class="d-grid gap-2 col-6 mx-auto">
                                <button type="button" class="btn btn-lg buy-btn">Proceed To Buy</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </body>
</html>