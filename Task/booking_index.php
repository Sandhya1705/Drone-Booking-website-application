<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5">
        <h2>Booking Details</h2>
        <a class="btn btn-primary" href="/Task/booking_create.php" role="button">New Booking</a>
        <br>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking_id</th>
                    <th>Location</th>
                    <th>drone_shot_id</th>
                    <th>created_time</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "booking";

                //Create connection
                $connection = new mysqli($servername,$username,$password,$database);

                //Check connection
                if($connection->connect_error){
                    die("Connection failed: ".$connection->connect_error);
                }

                //read all row from database table
                $sql = "SELECT * FROM clients";
                $result = $connection->query($sql);

                if(!$result){
                    die("Invalid query: ".$connection->error);
                }

                //read data of each row
                while($row = $result->fetch_assoc()){
                    echo "
                    <tr>
                    <td>$row[Booking_id]</td>
                    <td>$row[Location]</td>
                    <td>$row[drone_shot_id]</td>
                    <td>$row[created_time]</td>
                    <td>

                        <a class='btn btn-primary btn-sm' href='/Task/booking_edit.php?Booking_id=$row[Booking_id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/Task/booking_delete.php?Booking_id=$row[Booking_id]'>Delete</a>
                        </td>
                </tr>
                    ";
                }
                ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>