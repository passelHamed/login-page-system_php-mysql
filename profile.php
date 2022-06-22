<?php
session_start();

require "header.php";

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    

    <?php  if (isset($_SESSION['email']) && isset($_SESSION['password'])) : ?>
    <div class="home">
        <h4>Welcome To Your Page</h4>
    
        <p>Welcome : <?php echo $_SESSION['username'] ?></p> 
        <p>Your ID : <?php echo$_SESSION["id"] ?></p> 
        <p>Your EMAIL : <?php echo $_SESSION['email'] ?></p> 


        <a class="btn btn-primary" href="logout.php" role="button">log out</a>
        </div>
        <?php else : ?>
        <div class="home">
            <h1>You Must Login . . . </h1>
        </div>
        <?php endif; ?>

</body>
</html>



