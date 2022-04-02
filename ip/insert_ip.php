<!-- /////////// PHP CODE FROM HERE //////////-->

<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}


if (isset($_POST['submit'])) {

    // ekhane FORM er 'name' attribute POST er vitor boshbe.

    $msisdn = mysqli_real_escape_string($conn, $_POST['msi']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $ipphone = mysqli_real_escape_string($conn, $_POST['ip']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // checking the duplicate entries in user id. //
    // $check_duplicate = "select userid from dialer where userid = '$uid'";
    // $countquery = mysqli_query($conn, $check_duplicate);

    // if (mysqli_num_rows($countquery) > 0) {
    //     echo "<script>
    //         alert('UserID has already taken! Try another');
    //     </script>";
    // } else {
    $insertquery = "INSERT INTO ip_phone(msisdn, statusfield, ipphone, email) VALUES ( '$msisdn', '$status', '$ipphone', '$email')";

    $query2 = mysqli_query($conn, $insertquery);

    if ($query2) {

        echo "<script>
            alert('Inserted Successfully!');
            window.location.href='display_ip.php';
        </script>";
    } else {

        echo "<script>
            alert('Couldn't Inserted!');
        </script>";
    }
}
//}

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
            <h1 class="text-center text-white">Insert Operation in IP Phone</h1>
        </div>


        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3 mt-4">
                <label>MSISDN:</label>
                <input type="text" class="form-control" placeholder="Enter msisdn" name="msi" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Status:</label>
                <select name="status" required>
                    <option selected disabled>--Select one--</option>
                    <option>Active</option>
                    <option>Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label>IP phone no.:</label>
                <input type="text" class="form-control" placeholder="Enter IP phone no." name="ip" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Custodian Email:</label>
                <input type="text" class="form-control" placeholder="Enter Custodian Email" name="email" autocomplete="off" required>
            </div>
            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_ip.php">Go Back to Table</a>
            </div>
        </form>
        <hr style="border: 2px solid #47474a;">

        <!-- Upload CSV file code -->
        <h3 class="text-center">Or</h3>
        <p>Click on the "Choose File" button to upload a file:</p>
        <form action="filecon_ip.php" method="post" enctype="multipart/form-data">

            <input type="file" class="form-control-file" name="doc" />
            <button name="submit" class="btn btn-success">Submit</button>
            <a href="display_ip.php">Go Back to Table</a>
        </form>
    </div>

</body>

</html>