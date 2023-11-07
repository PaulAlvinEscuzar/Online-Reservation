<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="row-mt-5">
    <h1 class="text-center mt-5">Online Reservation</h1>
        <div class="d-flex justify-content-between align-items-center">
            <div class="container">
            <img src="../img/bsu_logo.png" width="400px" class="me-auto" alt="">
            </div>

            <div class="container bg-light border-top border-danger">
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
                <a href="../selection/selection.php"class="btn btn-warning">Back</a>
                <p class="mt-3"><a class="link-opacity-100" href="../student/register.php">Register</a></p>
            </div>
        </div>
        </form>
            </div>
        </div>
    </div>
</div>