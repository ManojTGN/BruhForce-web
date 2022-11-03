<div class="container-fluid" style="background-color:white;">
    <br> 
    <div class="row">
        <div class="col-8"></div>
        <div class="col-4">
            <div class="btn-group">
                <button style="background:#393E46;color:white;"type="button" class="btn btn-outline <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="index.php"){?>active<?php }?>"><i class="fa-solid fa-user"></i> <?php echo $username;?></button>
                <button style="background:#393E46;color:white;"type="button" class="btn btn-outline dropdown-toggle dropdown-toggle-split <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="index.php"){?>active<?php }?>" data-bs-toggle="dropdown" aria-expanded="false">
                    <span style="color:#393E46;" class="visually-hidden">Toggle Dropdown</span>
                </button>
                <ul style="background:#393E46;" class="dropdown-menu">
                    <li><a  style="color:white;" class="dropdown-item" href="index.php">Home</a></li>
                    <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="index.php"){?>
                    <li><a  style="color:white;" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#Chooseprofile">Change UserType</a></li>
                    <?php }?>
                    <li><hr class="dropdown-divider"></li>
                    <li><a  style="color:white;" class="dropdown-item" href="sign-out.php">Sign Out</a></li>
                </ul>
            </div>
            <a href="settings.php"><button style="background:#393E46;" type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="settings.php"){?>active<?php }?>"><i class="fa-solid fa-gears"></i> Settings</button></a>
            <a href="cart.php"><button style="background:#393E46;" type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="cart.php"){?>active<?php }?>"><i class="fa-solid fa-cart-shopping"></i> Cart</button></a>
            <a href="order.php"><button style="background:#393E46;" type="button" class="btn btn-outline-secondary <?php if(basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING'])=="order.php"){?>active<?php }?>"><i class="fa-solid fa-truck-fast"></i> Order</button></a>
        </div>
    </div>
    <hr>
</div>