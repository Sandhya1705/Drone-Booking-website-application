<?php

$servername="localhost";
$username="root";
$password="";
$database="booking";

//Create connection
$connection = new mysqli($servername,$username,$password,$database);


$Location = "";
$drone_shot_id = "";
$created_time = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='POST'){
    $Location = $_POST["Location"];
    $drone_shot_id = $_POST["drone_shot_id"];
    $created_time = $_POST["created_time"];
    

    do {
        if(empty($Location) || empty($drone_shot_id) || empty($created_time)){
            $errorMessage = "All the fields are required";
            break;
        }

        //add new client to database
        $sql="INSERT INTO clients (Location,drone_shot_id,created_time)".
        "VALUES ('$Location','$drone_shot_id','$created_time')";
        
        $result=$connection->query($sql);

        if(!$result){
            $errorMessage="Invalid query: ".$connection->error;
            break;
        }

        $Location = "";
        $drone_shot_id = "";
        $created_time = "";

        $successMessage = "Client added correctly";

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
    <title>Booking</title>
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