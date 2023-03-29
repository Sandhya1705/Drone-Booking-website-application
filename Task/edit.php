<?php
$servername="localhost";
$username="root";
$password="";
$database="webapp";

//Create connection
$connection = new mysqli($servername,$username,$password,$database);

$Id="";
$Name = "";
$Email = "";
$Phone = "";
$Address = "";

$errorMessage = "";
$successMessage = "";

if($_SERVER['REQUEST_METHOD']=='GET'){
    //GET method:Show the data of client

    if(!isset($_GET["Id"])){
        header("location: /Task/index.php");
        exit;
    }

    $Id=$_GET["Id"];

    //read the row of the selected client from database table
    $sql="SELECT * FROM clients WHERE Id=$Id";
    $result=$connection->query($sql);
    $row=$result->fetch_assoc();

    if(!$row){
        header("location: /Task/index.php");
        exit;
    }

    $Name=$row["Name"];
    $Email=$row["Email"];
    $Phone=$row["Phone"];
    $Address=$row["Address"];
}
else{
    //POST method:Update the data of client

    $Id = $_POST["Id"];
    $Name = $_POST["Name"];
    $Email = $_POST["Email"];
    $Phone = $_POST["Phone"];
    $Address = $_POST["Address"];

    do {
        if( empty($Id) || empty($Name) || empty($Email) || empty($Phone) || empty($Address)){
            $errorMessage = "All the fields are required";
            break;
        }

        $sql = "UPDATE clients ".
                "SET Name='$Name',Email='$Email',Phone='$Phone',Address='$Address'".
                "WHERE Id=$Id" ;

        $result = $connection->query($sql);

        if(!$result){
            $errorMessage="Invalid query: ".$connection->error;
            break;
        }

        $successMessage = "Client updated correctly";

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
            <input type="hidden" name="Id" value="<?php echo $Id; ?>">
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
</body>
</html>