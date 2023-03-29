<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drone Booking App</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">

</head>
<body>
    <div class="container my-5">
        
        <a class="btn btn-primary" href="/Task/create.php" role="button">New Client</a>

        <a class="btn btn-primary" href="/Task/booking_index.php" role="button">Booking</a>
        <br>
        <h2>List of Clients</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Created</th>
                    
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "webapp";

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
                    <td>$row[Id]</td>
                    <td>$row[Name]</td>
                    <td>$row[Email]</td>
                    <td>$row[Phone]</td>
                    <td>$row[Address]</td>
                    <td>$row[Created]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/Task/edit.php?Id=$row[Id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/Task/delete.php?Id=$row[Id]'>Delete</a>
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