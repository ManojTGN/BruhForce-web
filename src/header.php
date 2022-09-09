<div class="container-fluid">
    <br> 
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-primary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="index.php"){?>active<?php }?>"><i class="fa-solid fa-user"></i> <?php echo $username;?></button>
                <button type="button" class="btn btn-outline-primary dropdown-toggle dropdown-toggle-split <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="index.php"){?>active<?php }?>" data-bs-toggle="dropdown" aria-expanded="false">
                    <span class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="index.php">Home</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="sign-out.php">Sign Out</a></li>
                </ul>
            </div>
            <a href="settings.php"><button type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="settings.php"){?>active<?php }?>"><i class="fa-solid fa-gears"></i> Settings</button></a>
            <a href="cart.php"><button type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="cart.php"){?>active<?php }?>"><i class="fa-solid fa-cart-shopping"></i> Cart</button></a>
            <a href="order.php"><button type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="order.php"){?>active<?php }?>"><i class="fa-solid fa-truck-fast"></i> Order</button></a>
        </div>
    </div>
    <hr>
</div>