<?php
if(isset($_GET["Id"]))
{
    $Id=$_GET["Id"];

    $servername="localhost";
    $username="root";
    $password="";
    $database="webapp";

    //Create connection
    $connection = new mysqli($servername,$username,$password,$database);

    $sql="DELETE FROM clients WHERE Id=$Id";
    $connection->query($sql);

}
header("location: /Task/index.php");
        exit;
?>