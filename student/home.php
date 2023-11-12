<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../student/homestyle.css?v=<?php echo time(); ?>">
    <script src="../student/homescript.js" defer></script>
    <style>
        .edit-form {
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1100;
            background:rgba(0,0,0,.8);
            padding: 2rem;
            display: none;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            width: 100%;
        }
    </style>
</head>
<body>
<?php
session_start();

if (isset($_SESSION['prog_sec'])) {
    ?>
<?php 
$already = 0;
include '../includes/header.php';
include '../includes/db.php';

if(isset($_POST['add_cart'])){
    $productID = $_POST['update_id'];
    $srcode = $_SESSION['SR_Code'];
    $quan = $_POST['quan'];
    
    $query = "SELECT * FROM shopcart WHERE ProductID = '$productID'";
    $select = mysqli_query($conn, $query);
    if(mysqli_num_rows($select)>0){
        header("Location: ../student/home.php?errormessage=The Product Added to Cart Successfully");
    }else{
        $query = "INSERT INTO shopcart(SR_Code,ProductID,Quantity) VALUES ('{$srcode}','{$productID}','{$quan}')";
        $add2cart = mysqli_query($conn, $query);
        header("Location: ../student/home.php?message=The Product Added to Cart Successfully");
    }
}
?>
<div class="container-xxl">
<?php if (isset($_GET['message'])) { ?>
            <p class="text-center bg-primary-subtle p-4 mt-3 error"><?php echo $_GET['message']; ?></p>
        <?php } ?>
        <?php if (isset($_GET['errormessage'])) { ?>
            <p class="text-center bg-danger-subtle p-4 mt-3 error"><?php echo $_GET['errormessage']; ?></p>
        <?php } ?>
    <div class="row-mt-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">Student Portal</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="mx-auto"></div>
                <div class="navbar-nav">
                    <a class="nav-link active me-3" aria-current="page" href="#"><h4><i class="bi bi-house-door-fill"></i></h4></a>
                    <a class="nav-link me-3" href="../student/trackorder.php"><h4><i class="bi bi-geo-alt-fill"></i></h4></a>
                    <a class="nav-link me-3" href="../student/contactus.php"><h4><i class="bi bi-envelope-fill"></i></h4></a>
                    <div class="container">
                    <a type="button" class="me-3 btn btn-outline-success btn-rounded w-100" href="../student/shopcart.php"><h4><i class="bi bi-cart-fill"></i></h4></a>
                    </div>
                    <a href="logout.php" class="btn btn-danger mb-3 mt-2 fw-bold">Logout</a>
                </div>
            </div>
        </div>
    </nav>

    <div class="h-100 d-inline-flex flex-column justify-content-center align-items-center mt-5">
        <div class="border-top border-5 border-danger p-5">
        <h1 class="ps-5 pe-5">Welcome <?php echo $_SESSION['firstname'],' ', $_SESSION['lastname']; ?></h1>
        <h1 class="ps-5 pe-5">SR-Code: <?php echo $_SESSION['SR_Code']; ?></h1>
        <h1 class="ps-5 pe-5">Department: <?php echo $_SESSION['dept']; ?></h1>
        <div class="justify-content-center text-center">
        </div>
        </div>
    </div>
    </div>

<div class="container-product">
<section class="products">
        <div class="product-container">
<?php
$query = "SELECT * FROM productdb";
$display = mysqli_query($conn, $query);

if(mysqli_num_rows($display) > 0){
    while($row = mysqli_fetch_assoc($display)){
    $pimage = $row['image'];    
?>
            <a href="../student/home.php?name=<?php echo $row['ProductID']?>" class="btn btn-light a-link">
            <div class="product-box" data-name="<?php echo $row['ProductID']?>">
                <img src="../uploadedimg/<?php echo "$pimage" ?>" alt="">
                <h3 name='productname'><?php echo $row['ProductName'];?></h3>
                <div class="price" name="price">&#8369;<?php echo $row['Price'];?>.00</div>
            </div>
            </a>

<?php
    };
};
?>
</div>
</section>
</div>
<section class="edit-form">
        <?php

        if(isset($_GET['name'])){
            $edit_id = $_GET['name'];
            $query = "SELECT * FROM productdb WHERE ProductID = '{$edit_id}'";
            $edit = mysqli_query($conn,$query);
            if(mysqli_num_rows($edit) > 0){
                while($row = mysqli_fetch_assoc($edit)){
                    $pimage = $row['image'];
        ?>
        <div class="col-lg-4 bg-white m-auto border border-danger-subtle mt-5 mb-5">
            <form action="" method="post">
                <div class="container-lg d-flex justify-content-center p-3 bg-light">
                <img src="../uploadedimg/<?php echo "$pimage"; ?>" height="200">
                </div>
                <input type="hidden" name="update_id" value="<?php echo $row['ProductID']; ?>">
                <div class="input-group mb-3 ps-3 pe-3">
                    <span class="input-group-text"><i class="bi bi-shop"></i></i></span>
                    <input type="text" readonly class="form-control" value="<?php echo $row['ProductName']?>" name="pname" SS>
                </div>
                <div class="input-group mb-3 ps-3 pe-3">
                    <span class="input-group-text">Price</span>
                    <input type="text" readonly min="0"  class="form-control" value="<?php echo $row['Price']?>" name="price" >
                </div>
                <div class="input-group mb-3 ps-3 pe-3">
                    <span class="input-group-text">Quantity</span>
                    <input type="number"  min="1" value="1" class="form-control"  name="quan" >
                </div>
                <input type="hidden" name="product_image" value="<?php echo "$pimage";?>">
                <div class="container d-grid">
                    <input type="submit" value = "Add to Cart" class="btn btn-success mb-3" name="add_cart">
                    <a href="#"class="btn btn-warning mb-2" id="close_edit">Cancel</a>
                </div>
            </form>
        </div>
        <?php
            };
        };echo "<script>document.querySelector('.edit-form').style.display = 'flex';</script>";
    };
        ?>
    </section>
    </div>
</body>
<?php
}else {
        header('Location:login.php');
        exit();
    }
?>
<script>
    document.querySelector('#close_edit').onclick = () =>{
        document.querySelector('.edit-form').style.display = 'none';
        window.location.href = 'home.php'
    }

    function scrollToEditForm(){
        var target = document.getElementById("edit-form");

        if(target){
            target.scrollIntoView({behavior:"smooth"});
        }
    }
</script>

</html>