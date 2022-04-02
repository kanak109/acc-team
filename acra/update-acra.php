<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}

$id = $_GET['id'];

$selectquery = "select * from acra where id=$id";

$query4 = mysqli_query($conn, $selectquery);

$result = mysqli_fetch_assoc($query4);

if (isset($_POST['submit'])) {
    ////// eikhane post er vitor form er name ta hobe.
    $aid = mysqli_real_escape_string($conn, $_POST['aid']);
    $email_dom = mysqli_real_escape_string($conn, $_POST['email_dom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dialer = mysqli_real_escape_string($conn, $_POST['dialer']);

    // UPDATE QUERY
    $updatequery = "UPDATE acra set id=$id, aid='$aid', email_dom='$email_dom', email='$email', dialer='$dialer' where id=$id";



    $query = mysqli_query($conn, $updatequery);

    if ($query) {

        echo "<script>
                        alert('Updated Successfully!');
                        window.location.href='display-acra.php';
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
            <h1 class="text-center text-white">Update Operation</h1>
        </div>


        <form action="" method="POST">

            <div class="mb-3 mt-4">
                <label>UID:</label>
                <input type="text" class="form-control" placeholder="Enter UID" name="aid" value="<?php echo $result['aid']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email with Domain:</label>
                <input type="text" class="form-control" placeholder="Email with Domain" name="email_dom" value="<?php echo $result['email_dom']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Email" name="email" value="<?php echo $result['email']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Dialer:</label>
                <select name="dialer" required>
                    <option selected disabled>--Select UID--</option>
                    <option <?php
                            if ($result["dialer"] == 'Avaya') {
                                echo "selected";
                            }

                            ?>>Avaya</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display-acra.php">Go Back to Table</a>
            </div>
        </form>

    </div>

</body>

</html>