<?php
$servername="localhost";
$username="root";
$password="";
$database="booking";

//Create connection
$connection = new mysqli($servername,$username,$password,$database);

$Booking_id="";
$Location = "";
$drone_shot_id = "";
$created_time = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='GET'){
    //GET method:Show the data of client

    if(!isset($_GET["Booking_id"])){
        header("location: /Task/booking_index.php");
        exit;
    }

    $Booking_id=$_GET["Booking_id"];

    //read the row of the selected client from database table
    $sql="SELECT * FROM BOOKING WHERE Booking_id=$Booking_id";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();

    if(!$row){
        header("location: /Task/booking_index.php");
        exit;
    }

    $Location=$row["Location"];
    $drone_shot_id=$row["drone_shot_id"];
    $created_time=$row["created_time"];

}
else{
    //POST method:Update the data of client

    $Booking_id=$_POST["Booking_id"];
    $Location=$_POST["Location"];
    $drone_shot_id=$_POST["drone_shot_id"];
    $created_time=$_POST["created_time"];

    do {
        if( empty($Booking_id) || empty($Location) || empty($drone_shot_id) || empty($created_time)){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE BOOKING ".
                "SET Location='$Location',drone_shot_id='$drone_shot_id',created_time='$created_time'".
                "WHERE Booking_id=$Booking_id" ;

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage="Invalid query: ".$connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

        header("location: /Task/booking_index.php");
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
    <title>BOOKING</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>New Booking</h2>
    
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
            <input type="hidden" name="Booking_id" value="<?php echo $Booking_id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Location</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="Location" value="<?php echo $Location; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">drone_shot_id</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="drone_shot_id" value="<?php echo $drone_shot_id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">created_time</label>
                <div class = "col-sm-6">
                    <input type="text" class="form-control" name="created_time" value="<?php echo $created_time; ?>">
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
                    <a class="btn btn-outline-primary" href="/Task/booking_index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>