<?php

include '../includes/db.php';
include '../includes/header.php';

$success = 0;
$user = 0;
$invalid = 0;

if (isset($_POST['submit'])) {
    $srcode = $_POST['srcode'];
    $pass = $_POST['pass'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $email = $_POST['email'];
    $dept = $_POST['dept'];
    $progsec = $_POST['progsec'];
    $cnum = $_POST['cnum'];
    $cpass = $_POST['cpass'];

    $query = "SELECT * FROM student_record WHERE SR_Code='$srcode'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $num = mysqli_num_rows($result);
        if($num>0)
        {
            $user=1;
        }
        elseif(empty($srcode)) {
            header('Location:../student/register.php?error=SR-Code is Required');
            exit();
        } elseif (empty($pass)) {
            header('Location:../student/register.php?error=Password is Required');
            exit();
        }
        elseif (empty($fname)) {
            header('Location:../student/register.php?error=First Name is Required');
            exit();
        }
        elseif (empty($lname)) {
            header('Location:../student/register.php?error=Last Name is Required');
            exit();
        }
        elseif (empty($email)) {
            header('Location:../student/register.php?error=Email is Required');
            exit();
        }
        elseif (empty($dept)) {
            header('Location:../student/register.php?error=Department is Required');
            exit();
        }
        elseif (empty($progsec)) {
            header('Location:../student/register.php?error=Program and Section is Required');
            exit();
        }
        elseif (empty($cnum)) {
            header('Location:../student/register.php?error=Contact Number is Required');
            exit();
        }
        else{
            if($pass === $cpass){
            $query = "INSERT INTO student_record(SR_Code,pass,firstname,lastname,email,dept,prog_sec,cnum) VALUES('{$srcode}','{$pass}','{$fname}','{$lname}','{$email}','{$dept}','{$progsec}','{$cnum}')";
            $result = mysqli_query($conn,$query);
            if($result){
                $success = 1;
                header("Location:../student/loginstudent.php");
            }else{
                $invalid = 1;
            }
            }
        }
    }
}


if($user){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    This<strong>SR-Code</strong> is already exist! Please Try another SR-Code
    <button type='button' class= 'close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
if($success){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    Congratulations, your account has been successfully created
    <button type='button' class= 'close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
if($invalid){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    This<strong>SR-Code</strong> is already exist! Please Try another SR-Code
    <button type='button' class= 'close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span>
    </button>
    </div>";
}
?>


<body class="bg-light">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-4 bg-white m-auto border border-danger-subtle mt-5">
                <h2 class="text-center pt-3">Register Now</h2>
                <?php if (isset($_GET['error'])) { ?>
            <p class="text-center bg-danger-subtle p-4 mt-3 error"><?php echo $_GET['error']; ?></p>
        <?php } ?>
                <form action="" method="post">
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" placeholder="SR-Code" name="srcode">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" placeholder="First Name" name="fname">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-person-fill"></i></span>
                        <input type="text" class="form-control" placeholder="Last Name" name="lname">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                        <input type="email" class="form-control" placeholder="Email Address" name="email">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                        <input type="text" class="form-control" placeholder="Department" name="dept">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-building"></i></span>
                        <input type="text" class="form-control" placeholder="Program and Section" name="progsec">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-phone"></i></span>
                        <input type="text" class="form-control" placeholder="Contact Number" name="cnum">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Password" name="pass">
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                        <input type="password" class="form-control" placeholder="Confirm Password" name="cpass">
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-success" name="submit">Register Now</button>
                        <p class="text-center">
                            Already Have an Account? <a href="../student/login.php">Login Here</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>