<?php
    // $host="mysql_container";
    $servername = "db";
    $username= "user";
    $password="123456";
    $database="atshop_db";

    // $conn=mysqli_connect($host, $username, $password, $database,3306);
    $conn=mysqli_connect( $servername, $username, $password, $database,3306);
    mysqli_set_charset($conn,'utf8');
    //check database
    if(!$conn)
    {
        die("Connection Faild ". mysqli_connect_errno());
        echo "Something Wrong";
    }
?>