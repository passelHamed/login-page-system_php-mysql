<?php

require "header.php";

?>

<?php

require "connection.php";


$fullName   = "";
$userName   = "";
$email      = "";
$pass       = "";
$created    = "";


if ($_SERVER['REQUEST_METHOD'] === "POST"){

    $fullName   = $_POST['fullName'];
    $userName   = $_POST['userName'];
    $email      = $_POST['mail'];
    $pass       = $_POST['pass'];
    $created    = date('Y/m/d h.i.s');


    if (!empty($fullName) && !empty($userName) && !empty($email) && !empty($pass) && empty($fullNameErr) && empty($userNameErr) && empty($emailErr) && empty($passErr)){

            $sql = "INSERT INTO users(fullname,username,email,password,created) values(:fullname,:username,:email,:password,:created)";
            $mysql = $db->prepare($sql);
            $mysql->execute(['fullname' => $fullName , 'username' => $userName , 'email' => $email , 'password' => $pass , 'created' => $created]);

    }
}


?>



<?php

    $fullNameErr = $userNameErr = $emailErr = $passErr = "";

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (empty($_POST['fullName'])){
            $fullNameErr = "FullName Required";
        }else {
            $fullName = $_POST['fullName'];
            if (!preg_match("/^[a-zA-Z-' ]*$/" , $fullName)){
                $fullNameErr = "Valid FullName";
            }
        }

        if (empty($_POST['userName'])){
            $userNameErr = "UserName Is Required";
        }else {
            $userName = $_POST['userName'];
            if (!preg_match("/^[a-zA-Z-' ]*$/", $userName)){
                $userNameErr = "Valid userName";
            }
        }

        if (empty($_POST['mail'])){
            $emailErr = "Email Is Required";
        }else {
            $email = $_POST['mail'];
            if (!filter_var($email,FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9!#$&_*?^{}~-]+(\.[a-zA-Z0-9!#$&_*?^{}~-]+)*@([a-z0-9]([a-z0-9]*)\.)+[a-zA-Z]+$/", $email)){
                $emailErr = "Invalid Email Format";
            }
        }

        if (empty($_POST['pass'])){
            $passErr = "Password Is Required";
        }else {
            $pass = $_POST['pass'];
            if (!preg_match('/(?=.*[a-z])(?=.*[A-Z])(?=.*[!?])[a-zA-Z0-9!?]{8,}/', $pass)){
                $passErr = "valid password";
            }
        }
        
    }



?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>sign up</title>
    <link rel="stylesheet" href="main1.css">
    <style>
        .error{
            color: #ff0000;
        }
    </style>
</head>
<body>
    

        <?php  if (!empty($fullName) && !empty($userName) && !empty($email) && !empty($pass) && empty($fullNameErr) && empty($userNameErr) && empty($emailErr) && empty($passErr)) : ?>
            <center>
                <div class="alert alert-success alert-dismissible fade show w-50">
                    <strong>Success!</strong> Your account has been created successfully.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </center>
        <?php  elseif (empty($fullName) && empty($userName) && empty($email) && empty($pass) && !empty($fullNameErr) && !empty($userNameErr) && !empty($emailErr) && !empty($passErr)) : ?>
            <center>
                <div class="alert alert-danger alert-dismissible fade show w-50">
                    <strong>Error!</strong> A problem has been occurred while submitting your data.
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            </center>
        <?php endif; ?>


<div class="container mt-3" style="max-width: 600px">
    <div class="section">
        <h2>Sign Up</h2>
        <form method="POST">
            <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="fullName">Full Name</label><br>
                <input id="fullName" name="fullName" class="form-control input" placeholder="Your Full Name" value="<?php echo $fullName ?>" type="text">
                <span class="error">*<?php echo $fullNameErr ?></span>
            </div>
            <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="UserName">User Name</label><br>
                <input id="UserName" name="userName" class="form-control input" placeholder="Your User Name" value="<?php echo $userName ?>" type="text" >
                <span class="error">*<?php echo $userNameErr ?></span>
            </div>
            <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="email">Email</label><br>
                <input id="email" name="mail" class="form-control input" placeholder="Your Email" value="<?php echo $email ?>" type="email" >
                <span class="error">*<?php echo $emailErr ?></span>
            </div>
            <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="password">Password</label><br>
                <input id="password" name="pass" class="form-control input" placeholder="Password" value="<?php echo $pass ?>" type="password" >
                <span class="error">*<?php echo $passErr ?></span>
            </div>

            <button class="btn btn-primary mt-2">Sign Up</button>
        </form>
    </div>
</div>




</body>
</html>


