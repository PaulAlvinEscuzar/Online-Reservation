<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Shopping</title>
    <link rel="stylesheet" href="loginstyle.css">
</head>
<body>
    <header>
        <div class="logo-header">
            <img src="img/bsu_logo.png" alt="" style="margin-left: 20px;">
        </div>
        <h1>Batangas State University</h1>
        <div class="logo-header">
            <img src="img/cics_logo.jpg" alt="" style="padding-right:20px;margin-right: 20px;">
        </div>
    </header>
    <div class="container">
        <div class="logo">
            <img src="img/bsu_logo.png"alt="">
        </div>
        <div class="container-login">
            <h1 style="margin-bottom:5px;">Admin Login</h1>
            <form method="POST">
                <label for="username">Username:</label><br>
                <input type="text" name="username" id="username"><br>
                <label for="pass">Password:</label><br>
                <input type="text" name="pass" id="pass"><br>
                <a href="#">Register</a><br>
                <input type="submit" id="submit" name="submit" value="Login">
            </form>
        </div>

    </div>
</body>
</html>