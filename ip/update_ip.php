<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}

$id = $_GET['id'];

$selectquery = "select * from ip_phone where id=$id";

$query4 = mysqli_query($conn, $selectquery);

$result = mysqli_fetch_assoc($query4);

if (isset($_POST['submit'])) {

    ////// eikhane post er vitor form er name ta hobe.
    $msisdn = mysqli_real_escape_string($conn, $_POST['msi']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $ipphone = mysqli_real_escape_string($conn, $_POST['ip']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);


    // UPDATE QUERY
    $updatequery = "UPDATE ip_phone SET id=$id, msisdn='$msisdn',statusfield='$status',ipphone='$ipphone',email='$email' where id=$id";

    $query = mysqli_query($conn, $updatequery);

    if ($query) {

        echo "<script>
                        alert('Updated Successfully!');
                        window.location.href='display_ip.php';
                    </script>";
    } else {

        echo "<script>
                        alert('Could not be Updated!');
                    </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update</title>

    <?php include '../links.php' ?>

</head>

<body>

    <div class="container my-2 d-flex justify-content-end">
        <button class="btn btn-danger">
            <a href="../logout.php" class="text-light">Logout</a>
        </button>
    </div>

    <div class="container col-lg-6 my-5">
        <div class="card-header bg-dark m-auto">
            <h1 class="text-center text-white">Update Operation in IP Phone</h1>
        </div>


        <form action="" method="POST">


            <div class="mb-3 mt-4">
                <label>MSISDN:</label>
                <input type="text" class="form-control" placeholder="Enter User ID" name="email" value="<?php echo $result['msisdn']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Status:</label>
                <select name="status" required>
                    <option selected disabled>--Select one--</option>
                    <option <?php
                            if ($result["statusfield"] == 'Active') {
                                echo "selected";
                            }
                            ?>>Active</option>
                    <option <?php
                            if ($result["statusfield"] == 'Inctive') {
                                echo "selected";
                            }
                            ?>>Inactive</option>
                </select>
            </div>
            <div class="mb-3 mt-4">
                <label>IP Phone no.:</label>
                <input type="text" class="form-control" placeholder="Enter IP Phone no" name="ip" value="<?php echo $result['ipphone']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3 mt-4">
                <label>Custodian Email:</label>
                <input type="text" class="form-control" placeholder="Enter Custodian Email" name="msi" value="<?php echo $result['email']; ?>" autocomplete="off" required>
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_ip.php">Go Back to Table</a>
            </div>
        </form>

    </div>

</body>

</html>