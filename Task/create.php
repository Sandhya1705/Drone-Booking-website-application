<?php

$servername="localhost";
$username="root";
$password="";
$database="webapp";

//Create connection
$connection = new mysqli($servername,$username,$password,$database);

$Name = "";
$Email = "";
$Phone = "";
$Address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Address = $_POST["Address"];

    do {
        if(empty($Name) || empty($Email) || empty($Phone) || empty($Address)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add new client to database
        $sql="INSERT INTO clients (Name,Email,Phone,Address)".
        "VALUES ('$Name','$Email','$Phone','$Address')";
        
        $result =$connection->query($sql);

        if(!$result){
            $errorMessage="Invalid query: ".$connection->error;
            break;
        }

        $Name = "";
        $Email = "";
        $Phone = "";
        $Address = "";

        $successMessage = "Client added correctly";

        header("location: /Task/index.php");
        exit;


    } while (false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WEBAPP</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>New Client</h2>
    
        <?php
        if(!empty($errorMessage)){
            echo"
            <div class='alert-warning alert-dismissible fade show' role='alert>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="Name" value="<?php echo $Name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="Email" value="<?php echo $Email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="Phone" value="<?php echo $Phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="Address" value="<?php echo $Address; ?>">
                </div>
            </div>

            <?php
                if(!empty($successMessage)){
                    echo"
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                                <strong>$successMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='close'></button>
                            </div>
                        </div>
                    </div>
                    ";
                }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class = "col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/Task/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>

    <div class="container my-6">
        <h2>Booking Details</h2>
        <a class="btn btn-primary" href="/booking/create.php" role="button">New Booking</a>
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
                        <a class='btn btn-primary btn-sm' href='/booking/edit.php?id=$row[Booking_id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/booking/delete.php?id=$row[Booking_id]'>Delete</a>
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