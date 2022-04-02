<!-- /////////// PHP CODE FROM HERE //////////-->

<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}


if (isset($_POST['submit'])) {

    // ekhane FORM er name attribute POST er vitor boshbe.

    $uname = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $aid = mysqli_real_escape_string($conn, $_POST['aid']);
    $kdname = mysqli_real_escape_string($conn, $_POST['kdname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $remarks = mysqli_real_escape_string($conn, $_POST['remarks']);

    // checking the duplicate entries in user id. //
    $check_duplicate = "select avayaid from kurve_dashboard where avayaid= '$aid'";
    $countquery = mysqli_query($conn, $check_duplicate);

    if (mysqli_num_rows($countquery) > 0) {
        echo "<script>
            alert('AvayaID " . $aid . " has already taken! Try another');
        </script>";
    } else {
        $insertquery = "INSERT INTO kurve_dashboard(uname, email, avayaid, username, pass, remarks) VALUES ('$uname','$email','$aid ','$kdname','$password','$remarks')";

        $query2 = mysqli_query($conn, $insertquery);

        if ($query2) {

            echo "<script>
            alert('Inserted Successfully!');
            window.location.href='display_kurve.php';
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
            <h1 class="text-center text-white">Insert Operation in kurve_dashboard</h1>
        </div>


        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3 mt-4">
                <label>Name:</label>
                <input type="text" class="form-control" placeholder="Enter Name" name="name" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Email:</label>
                <input type="text" class="form-control" placeholder="Enter email" name="email" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Avaya ID:</label>
                <input type="number" class="form-control" placeholder="Enter User ID" name="aid" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>KURVE Dashboard-User name:</label>
                <input type="text" class="form-control" placeholder="Enter User name" name="kdname" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Password:</label>
                <input type="text" class="form-control" placeholder="Enter Password" name="password" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Remarks:</label>
                <input type="text" class="form-control" placeholder="Enter Remarks" name="remarks" autocomplete="off" required>
            </div>
            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_kurve.php">Go Back to Table</a>
            </div>
        </form>
        <hr style="border: 2px solid #47474a;">

        <!-- Upload CSV file code -->
        <h3 class="text-center">Or</h3>
        <p>Click on the "Choose File" button to upload a file:</p>
        <form action="filecon_kurve.php" method="post" enctype="multipart/form-data">

            <input type="file" class="form-control-file" name="doc" />
            <button name="submit" class="btn btn-success">Submit</button>
            <a href="display_kurve.php">Go Back to Table</a>
        </form>
    </div>

</body>

</html>