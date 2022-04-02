<!-- /////////// PHP CODE FROM HERE //////////-->

<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}


if (isset($_POST['submit'])) {
    $aid = mysqli_real_escape_string($conn, $_POST['aid']);
    $email_dom = mysqli_real_escape_string($conn, $_POST['email_dom']);   // ekhane form er name attribute POST er  vitor boshbe.
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $dialer = mysqli_real_escape_string($conn, $_POST['dialer']);

    // checking the duplicate entries in avaya id. //
    $check_duplicate = "select aid from acra where aid = '$aid' ";
    $countquery = mysqli_query($conn, $check_duplicate);

    if (mysqli_num_rows($countquery) > 0) {
        echo "<script type = 'text/javascript'>
            alert('Avaya ID: " . $aid . " has already taken! Try another');
        </script>";
    } else {
        $insertquery = "INSERT INTO acra(aid, email_dom, email, dialer) values('$aid','$email_dom', '$email','$dialer')";

        $query2 = mysqli_query($conn, $insertquery);
        if ($query2) {

            echo "<script>
                alert('Inserted Successfully!');
                window.location.href='display-acra.php';
            </script>";
        } else {

            echo "<script>
                alert('Couldn't Inserted!');
            </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include '../links.php' ?>
    <title>Add User</title>

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
            <h1 class="text-center text-white">Insert Operation in ACRA</h1>
        </div>


        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3 mt-4">
                <label>UID/ Avaya ID:</label>
                <input type="text" class="form-control" placeholder="Enter UID" name="aid" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email with Domain:</label>
                <input type="text" class="form-control" placeholder="Email with Domain" name="email_dom" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Email" name="email" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Dialer:</label>
                <select name="dialer" required>
                    <option selected disabled>--Select UID--</option>
                    <option>Avaya</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display-acra.php">Go Back to Table</a>
            </div>
        </form>
        <hr style="border: 2px solid #47474a;">

        <!-- Upload CSV file code -->
        <h3 class="text-center">Or</h3>
        <p>Click on the "Choose File" button to upload a file:</p>
        <form action="filecon_acra.php" method="post" enctype="multipart/form-data">

            <input type="file" class="form-control-file" name="doc" />
            <button name="submit" class="btn btn-success">Submit</button>
            <a href="display-acra.php">Go Back to Table</a>
        </form>
    </div>

</body>

</html>