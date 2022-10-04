<?php 
    // starting session
    session_start();
    
    //$conn = mysqli_connect("localhost", "root", "", "Employee");
    
    $host = "localhost";
    $username = "root";
    $password = "";
    
    try 
    {
        $conn = new PDO("mysql:host=$host;dbname=employee", $username, $password);
        
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch(PDOException $e) 
    {
        echo "Connnection Failed " .$e->getMessage();
    }
?>



