<!-- /////////// PHP CODE FROM HERE //////////-->

<?php

session_start();
include '../dbcon.php';

if (!isset($_SESSION['user'])) {
    header('location:../login.php');
}

if (isset($_POST['submit'])) {

    // ekhane FORM er 'name' attribute POST er vitor boshbe.

    $agentid = mysqli_real_escape_string($conn, $_POST['agentid']);
    $agentname = mysqli_real_escape_string($conn, $_POST['aname']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    // trying to convert date format
    $mydate = mysqli_real_escape_string($conn, $_POST['date']);
    $olddate = DateTime::createFromFormat('Y-m-d', $mydate);
    $date = $olddate->format('d-m-Y');

    $req = mysqli_real_escape_string($conn, $_POST['reqby']);
    $req = mysqli_real_escape_string($conn, $_POST['reqby']);

    // checking the duplicate entries in user id. //
    $check_duplicate = "select agentid from cm_user where agentid = '$agentid'";
    $countquery = mysqli_query($conn, $check_duplicate);

    if (mysqli_num_rows($countquery) > 0) {
        echo "<script>
            alert('AgentID " . $agentid . " has already taken! Try another');
        </script>";
    } else {
        $insertquery = "INSERT INTO cm_user(agentid, agentname, statusfield, cdate, req_by) VALUES ( '$agentid', '$agentname', '$status', '$date', '$req')";

        $query2 = mysqli_query($conn, $insertquery);

        if ($query2) {

            echo "<script>
            alert('Inserted Successfully!');
            window.location.href='display_cm.php';
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

    <!--------------------------Form Area-------------------------->

    <div class="container col-lg-6 my-5">
        <div class="card-header bg-dark m-auto">
            <h1 class="text-center text-white">Insert Operation in CM Userlist</h1>
        </div>


        <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">

            <div class="mb-3 mt-4">
                <label>Agent ID:</label>
                <input type="number" class="form-control" placeholder="Enter Agent ID" name="agentid" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Agent Name:</label>
                <input type="text" class="form-control" placeholder="Enter Agent Name" name="aname" autocomplete="off" required>
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
                <label>Date:</label>
                <input type="date" class="form-control" placeholder="Enter Date" name="date" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Requested By:</label>
                <input type="text" class="form-control" placeholder="Enter requester's name" name="reqby" autocomplete="on">
            </div>
            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_cm.php">Go Back to Table</a>
            </div>
        </form>
        <hr style="border: 2px solid #47474a;">

        <!-- Upload CSV file code -->
        <h3 class="text-center">Or</h3>
        <p>Click on the "Choose File" button to upload a file:</p>
        <form action="filecon_cm.php" method="post" enctype="multipart/form-data">

            <input type="file" class="form-control-file" name="doc" />
            <button name="submit" class="btn btn-success">Submit</button>
            <a href="display_cm.php">Go Back to Table</a>
        </form>
    </div>

</body>

</html>