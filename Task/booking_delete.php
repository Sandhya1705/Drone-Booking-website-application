<?php
if(isset($_GET["Booking_id"]))
{
    $Booking_id=$_GET["Booking_id"];

    $servername="localhost";
    $username="root";
    $password="";
    $database="booking";

    //Create connection
    $connection = new mysqli($servername,$username,$password,$database);

    $sql="DELETE FROM clients WHERE Booking_id=$Booking_id";
    $connection->query($sql);

}
header("location: /Task/booking_index.php");
        exit;
?>