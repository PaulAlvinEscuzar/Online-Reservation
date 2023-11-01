<?php include '../includes/header.php'; ?>
<body>
    <div class="container bg-light pt-2 pb-2">
        <h1 class="text-center">Online Reservation</h1>
    </div>
    <div class="container-lg d-flex justify-content-center border-end border-start border-bottom">
        <div class="container " style="width:20px; margin-left: 20vh;">
        <img src="../img/bsu_logo.png" class="mt-5" alt="">
        </div>
        

        <div class=" me-5  w-50 mt-5 mb-5 bg-light border-top border-danger border-4">

        <form action="../student/login.php" method="post">
        <?php if (isset($_GET['error'])) { ?>
            <p class="text-center bg-danger-subtle p-4 mt-3 error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
        <div class="input-group mb-3 mt-5 ps-5 pe-5 ">
            <span class="input-group-text" id="basic-addon1">@</span>
            <input type="text" class="form-control" placeholder="SR-Code" aria-label="SR-Code" aria-describedby="basic-addon1" name="srcode">
        </div>
        <div class="input-group mb-3 ps-5 pe-5">
            <span class="input-group-text" id="basic-addon1" style="width:45px ;">P</span>
            <input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="basic-addon1" name="password">
            </div>
        <div class="container d-flex">
            <div class="container text-center mt-3 mb-3">
                <input type="submit" class="btn btn-primary me-3" value="Login">
                <a href="#"class="btn btn-warning">Back</a>
                <p class="mt-3"><a class="link-opacity-100" href="../student/register.php">Register</a></p>
            </div>
        </div>
        </form>
        </div>
       

    </div>
</body>
</html>