<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}

$id = $_GET['id'];

$selectquery = "select * from kurve_dashboard where id=$id";

$query4 = mysqli_query($conn, $selectquery);

$result = mysqli_fetch_assoc($query4);

if (isset($_POST['submit'])) {

    ////// eikhane post er vitor form er name ta hobe.
    $uname = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $aid = mysqli_real_escape_string($conn, $_POST['aid']);
    $kdname = mysqli_real_escape_string($conn, $_POST['kdname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);


    // UPDATE QUERY
    $updatequery = "UPDATE kurve_dashboard SET `id`=$id,`uname`='$uname',`email`='$email',`avayaid`='$aid',`username`='$kdname',`pass`='$password',`remarks`='$remarks' where id=$id";



    $query = mysqli_query($conn, $updatequery);

    if ($query) {

        echo "<script>
                        alert('Updated Successfully!');
                        window.location.href='display_kurve.php';
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
            <h1 class="text-center text-white">Update Operation in Kurve Dashboard</h1>
        </div>


        <form action="" method="POST">


            <div class="mb-3 mt-4">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="name" value="<?php echo $result['uname']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Enter email" name="email" value="<?php echo $result['email']; ?>" autocomplete="off" required>
            </div>

            <!-- this field is unique field -->
            <div class="mb-3">
                <label>Avaya ID:</label>
                <input type="number" class="form-control" placeholder="Enter User ID" name="aid" value="<?php echo $result['avayaid']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>KURVE Dashboard-User name:</label>
                <input type="text" class="form-control" placeholder="Enter Avaya ID" name="kdname" value="<?php echo $result['username']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="text" class="form-control" placeholder="Enter Password" name="password" value="<?php echo $result['pass']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Remarks:</label>
                <input type="text" class="form-control" placeholder="Enter Remarks" name="remarks" value="<?php echo $result['remarks']; ?>" autocomplete="off" required>
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_kurve.php">Go Back to Table</a>
            </div>
        </form>

    </div>

</body>

</html>