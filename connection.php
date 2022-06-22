<?php




try{

    $db =  new PDO("mysql:host=localhost;dbname=task1" , "root" , "" );

}catch (PDOException $e){
    die ($e->getMessage());
}



