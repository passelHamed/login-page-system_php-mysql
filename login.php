<?php
    session_start();
    require "header.php";
?>


<?php

require 'connection.php';

$email = $pass = "";



if ($_SERVER['REQUEST_METHOD'] == "POST"){


    $email  = $_POST['emailL'];
    $pass  = $_POST['passL'];

    $sql = "SELECT * FROM users WHERE email = :email AND password = :password  LIMIT 1";

    $mysql = $db->prepare($sql);

    $mysql->execute(array(":email" => $email , ":password" => $pass));

    $data = $mysql->fetchAll();


    $count = $mysql->rowCount();


    if ($count > 0){
        $_SESSION['email']      = $email;
        $_SESSION['password']   = $pass;
        $_SESSION['username']   = $data[0]['username'];
        $_SESSION['fullname']   = $data[0]['fullname'];
        $_SESSION['id']         = $data[0]['id'];
        header("location:profile.php");
    }else {
        $message = '<h6 style=color:red;font-weight:bold;>Username or password wrong please try agin</h6>';
    }


}





?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login In</title>
    <style>
        
        .error{
            color: #ff0000;
        }

    </style>
</head>
<body>


<div class="container mt-5" style="max-width: 400px">
    <div class="section is-small">
        <?php
            if (isset($message)){
            echo $message;
        }
        ?>
        <h2>Login</h2>
        <form method="POST">
        <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="email">Email</label><br>
                <input id="email" name="emailL" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" type="email">
            </div>
            <div class="field">
                <label class="mt-2 mb-2 fw-bold" for="password">Password</label><br>
                <input id="password" name="passL" class="form-control" placeholder="Password" value="<?php echo $pass; ?>" type="password">
            </div>

            <button class="btn btn-primary mt-3">Login</button>
        </form>
    </div>
</div>


</body>
</html>