<head>
    <style>
        .card-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
}

.card {
    margin: 1rem;
}
    </style>
</head>
<?php include('../includes/db.php');
include('../includes/header.php');
?>

<div class="container">
    <div class="row-mt-5">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand ms-3" href="#">Navbar</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="mx-auto"></div>
                <div class="navbar-nav">
                    <a class="nav-link active me-3 btn btn-outline-primary btn-rounded text-wrap" style="color:white ;" aria-current="page" href="#"><h4>Home</h4></a>
                    <a class="nav-link me-3" href="../admin/addproduct.php"><h4> Add Product</h4></a>
                    <a class="nav-link me-3" href="../admin/customerDetails.php"><h4> Customer Details</h4></a>
                    <a class="nav-link me-3" href="../admin/orders.php"><h4> Orders</h4></a>
                </div>
            </div>
        </div>
    </nav>
    <h2 class="text-center mt-3">Reports</h2>
    <div class="col-lg-4 bg-white m-auto mt-5">
    <form action="" method="POST">
    <h2 class="text-center mb-5">Enter Begin and End Date</h2>
        <div class="input-group mb-3 d-flex justify-content-between">
            <div class="input-group-text">
                <input type="date" name="begindate">
            </div>
            <div class="input-group-text">
                <input type="date" name="enddate">
            </div>
        </div>
        <div class="container d-grid">
            <input type="submit" class="btn btn-success mb-3" name="show_reports">
        </div>
        
    </form>
    </div>
    <?php
    if(isset($_POST['show_reports'])){
        $begindate = $_POST['begindate'];
        $enddate = $_POST['enddate'];
        $total = 0;

        if($begindate > $enddate){
            echo "<script type = 'text/javascript'>alert('Your begin date is after your end date. Please try again.')</script>";
            exit();
        }else{
        ?>
         <h1 class="text-center"> Reports From <?php echo "$begindate"?> and <?php echo "$enddate" ?></h1>
        <?php
        
        $query = "SELECT * FROM orderdb WHERE Orderdate BETWEEN '$begindate' AND '$enddate';";
        $select_date = mysqli_query($conn,$query);

        if(mysqli_num_rows($select_date) > 0){
            while($row = mysqli_fetch_assoc($select_date)){
                $orderid = $row['OrderID'];
                $srcode = $row['SR_Code'];

                $customer_query = "SELECT firstname, lastname, dept, prog_sec, cnum FROM student_record WHERE SR_Code = '$srcode'";
                $view_customer = mysqli_query($conn, $customer_query);

                if(mysqli_num_rows($view_customer) > 0){
                    while($customer_row = mysqli_fetch_assoc($view_customer)){
                        $firstname = $customer_row['firstname'];
                        $lastname = $customer_row['lastname'];
                        $dept = $customer_row['dept'];
                        $progsec = $customer_row['prog_sec'];
                        $cnum = $customer_row['cnum'];
                
                        echo '<div class="container">
                                <div class="row">
                                    <h3 class="font-monospace">
                                        Customer: ' . $firstname . ' ' . $lastname . '
                                    </h3>';

                        // Code for displaying the products
                        $query2 = "SELECT * FROM orderitems WHERE OrderID = '$orderid';";
                        $select_products = mysqli_query($conn, $query2);

                        if(mysqli_num_rows($select_products) > 0){
                            while($product_row = mysqli_fetch_assoc($select_products)){
                                $productid = $product_row['ProductID'];
                                $quantity = $product_row['Quantity'];
                                $totalprice = $product_row['TotalPrice'];
                                $total += $totalprice;
                                
                                $product_query = "SELECT * FROM productdb WHERE ProductID = '$productid';";
                                $view_product = mysqli_query($conn, $product_query);


                                    while($product_data = mysqli_fetch_assoc($view_product)){
                                        $productname = $product_data['ProductName'];
                                        $image = $product_data['image'];
                                        


                                        echo '
                                        <div class ="card-container">
                                            <div class="card my-3 col-4 border border-dark p-3" style="width: 18rem;">
                                                <img src="../uploadedimg/' . $image . '" class="card-img-top" alt="...">
                                                <div class="card-body">
                                                <h5 class="card-title">' . $productname . '</h5>
                                                <p class="card-text">Quantity: ' . $quantity . '</p>
                                                <h3 class = "text-center"> Total '. $totalprice .'</h3>
                                            </div>
                                        </div>
                                        ';
                                        echo $total;
                                    }
                                
                            }
                        }

                        echo '
                        </div>
                        </div>
                        ';
                        
                    }
                }
            }
        }
    }
}
?>
    </div>
</div>
