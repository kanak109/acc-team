<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}

$id = $_GET['id'];

$selectquery = "select * from ivr where id=$id";

$query4 = mysqli_query($conn, $selectquery);

$result = mysqli_fetch_assoc($query4);

if (isset($_POST['submit'])) {

    ////// eikhane post er vitor form er name ta hobe.
    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    $date = mysqli_real_escape_string($conn, $_POST['cdate']);
    $req = mysqli_real_escape_string($conn, $_POST['reqby']);

    // UPDATE QUERY
    $updatequery = "UPDATE ivr SET `id`=$id, userid='$uid', username='$username', cdate='$date', req_by = '$req' where id=$id";



    $query = mysqli_query($conn, $updatequery);

    if ($query) {

        echo "<script>
                        alert('Updated Successfully!');
                        window.location.href='display_ivr.php';
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
            <h1 class="text-center text-white">Update Operation in IVR</h1>
        </div>


        <form action="" method="POST">


            <div class="mb-3 mt-4">
                <label>User ID:</label>
                <input type="text" class="form-control" placeholder="Enter User ID" name="uid" value="<?php echo $result['userid']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>User Name:</label>
                <input type="text" class="form-control" placeholder="Enter username" name="uname" value="<?php echo $result['username']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Created Date:</label>
                <input type="date" class="form-control" placeholder="Date" name="cdate" value="<?php echo $result['cdate']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Requested By:</label>
                <input type="text" class="form-control" placeholder="Enter requester's name" name="reqby" value="<?php echo $result['req_by']; ?>" autocomplete="off">
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_ivr.php">Go Back to Table</a>
            </div>
        </form>

    </div>

</body>

</html>