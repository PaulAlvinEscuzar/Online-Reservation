<?php
include('../includes/db.php');
include('../includes/header.php');

if(isset($_POST['update_product'])){
    $id = $_POST['up_quan_id'];
    $up_quan = $_POST['up_quan'];

    $query = "UPDATE shopcart SET Quantity = '$up_quan' WHERE CartID = '$id'";
    $update_quan = mysqli_query($conn,$query);

    if($update_quan){
        header("Location:../student/shopcart.php");
    }
}
?>

<div class="container">
    <div class="row-mt-5">
    <!--nav bar-->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="mx-auto"></div>
                <div class="navbar-nav">
                    <a class="nav-link me-3" href="../student/home.php"><h4><i class="bi bi-house-door-fill"></i></h4></a>
                    <a class="nav-link me-3" href="#"><h4><i class="bi bi-geo-alt-fill"></i></h4></a>
                    <a class="nav-link me-3" href="#"><h4><i class="bi bi-envelope-fill"></i></h4></a>
                    <a class="nav-link me-3" href="#"><h4><i class="bi bi-people-fill"></i></h4></a>
                    <div class="container">
                    <a type="button" aria-current="page" class="me-3 btn btn-outline-success btn-rounded w-100 active"  href="../student/cart.php"><h4><i class="bi bi-cart-fill"></i></h4></a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!--end of nav bar-->
    <h3 class="text-center p-3"> Shopping Cart</h3>
    <!--Table Start-->

    <table class="table table-striped table-bordered table-hover mt-5">
        <thead class="table-dark">
            <tr>
                <th scope="col">Product Image</th>
                <th scope="col">Product Name</th>
                <th scope="col">Price</th>
                <th scope="col" colspan="2">Quantity</th>
                <th scope="col">Cost</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM shopcart";
            $display = mysqli_query($conn,$query);
            $total = 0;

            if(mysqli_num_rows($display)>0){
                while($row = mysqli_fetch_assoc($display)){
                    $pimage = $row['image'];
            ?>
                    <tr>
                        <td><img src="../uploadedimg/<?php echo "$pimage";?>" height="108px"></td>
                        <td><?php echo $row['ProductName']?></td>
                        <td><?php echo $row['Price']?></td>
                        <td>
                            <form action="" method="POST">
                                    <input type="hidden" value="<?php echo $row['CartID']?>" name="up_quan_id">
                                <div class="input-group mb-3">
                                    <input type="number" min="1" value="<?php echo $row['Quantity']?>" name="up_quan" class="text-center p-1">
                                </div>
                                <td>
                                <div class="container d-grid">
                                    <input type="submit" value = "Update" class="btn btn-success mb-3" name="update_product">
                                </div>
                                </td>
                            </form>
                        </td>
                        <td>&#8369;<?php echo $subtotal =  $row['Price'] * $row['Quantity']?>.00</td>
                        <td class="text-center">
                            <a href="" class='btn btn-success'>Delete</a>
                        </td>
                    </tr>
            <?php
            $total += $subtotal;
                };
            };
            ?>
            <tr>
                <td colspan="5" class="pt-3 pb-3"><h3 class="text-center text-monospace">Total:</h3></td>
                <td><h3 class="text-center text-monospace">&#8369;<?php echo $total?>.00</h3></td>
                <td class="text-center">
                            <a href="" class='btn btn-outline-danger mt-2' name="done_shop">Done Shopping</a>
                        </td>
            </tr>
        </tbody>
    </table>
    </div>
</div>