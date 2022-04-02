<!-- /////////// PHP CODE FROM HERE //////////-->

<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}


if (isset($_POST['submit'])) {

    // ekhane FORM er name attribute POST er vitor boshbe.

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $username = mysqli_real_escape_string($conn, $_POST['uname']);
    // trying to convert date format
    $mydate = mysqli_real_escape_string($conn, $_POST['cdate']);
    $olddate = DateTime::createFromFormat('Y-m-d', $mydate);
    $date = $olddate->format('d-m-Y');
    // $date = mysqli_real_escape_string($conn, $_POST['cdate']);
    $req = mysqli_real_escape_string($conn, $_POST['reqby']);

    $insertquery = "INSERT INTO ivr(userid, username, cdate,req_by) VALUES ('$uid','$username','$date','$req')";

    $query2 = mysqli_query($conn, $insertquery);

    if ($query2) {

        echo "<script>
            alert('Inserted Successfully!');
            window.location.href='display_ivr.php';
        </script>";
    } else {

        echo "<script>
            alert('Couldn't Inserted!');
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
    <title>Add User</title>

    <?php include '../links.php' ?>

</head>

<body>

    <div class="container my-2 d-flex justify-content-end">
        <button class="btn btn-danger">
            <a href="../logout.php" class="text-light">Logout</a>
        </button>
    </div>

    <!----------------------Form Area-------------------->

    <div class="container col-lg-6 my-5">
        <div class="card-header bg-dark m-auto">
            <h1 class="text-center text-white">Insert Operation in IVR</h1>
        </div>


        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3 mt-4">
                <label>User ID:</label>
                <input type="text" class="form-control" placeholder="Enter User ID" name="uid" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>User Name:</label>
                <input type="text" class="form-control" placeholder="Enter username" name="uname" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Created Date:</label>
                <input type="date" class="form-control" placeholder="Date" name="cdate" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Requested By:</label>
                <input type="text" class="form-control" placeholder="Enter requester's name" name="reqby" autocomplete="off">
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_ivr.php">Go Back to Table</a>
            </div>
        </form>
        <hr style="border: 2px solid #47474a;">

        <!-- Upload CSV file code -->
        <h3 class="text-center">Or</h3>
        <p>Click on the "Choose File" button to upload a file:</p>
        <form action="filecon_ivr.php" method="post" enctype="multipart/form-data">

            <input type="file" class="form-control-file" name="doc" />
            <button name="submit" class="btn btn-success">Submit</button>
            <a href="display_ivr.php">Go Back to Table</a>
        </form>
    </div>

</body>

</html>