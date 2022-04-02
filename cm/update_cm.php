<?php

session_start();
include '../dbcon.php';

$id = $_GET['id'];

$selectquery = "select * from cm_user where id=$id";

$query4 = mysqli_query($conn, $selectquery);

$result = mysqli_fetch_assoc($query4);

if (isset($_POST['submit'])) {

    ////// eikhane post er vitor form er name ta hobe.
    $agentid = mysqli_real_escape_string($conn, $_POST['agentid']);
    $agentname = mysqli_real_escape_string($conn, $_POST['aname']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $req = mysqli_real_escape_string($conn, $_POST['reqby']);

    // UPDATE QUERY
    $updatequery = "UPDATE cm_user SET id=$id, agentid='$agentid', agentname='$agentname', statusfield='$status', cdate='$date', req_by = '$req' where id=$id";

    $query = mysqli_query($conn, $updatequery);

    if ($query) {

        echo "<script>
                        alert('Updated Successfully!');
                        window.location.href='display_cm.php';
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
            <h1 class="text-center text-white">Update Operation in CM Userlist</h1>
        </div>


        <form action="" method="POST">


            <div class="mb-3 mt-4">
                <label>Agent ID:</label>
                <input type="number" class="form-control" placeholder="Enter Agent ID" name="agentid" value="<?php echo $result['agentid']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Agent Name:</label>
                <input type="text" class="form-control" placeholder="Enter Agent Name" name="aname" value="<?php echo $result['agentname']; ?>" autocomplete="off" required>
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
                            if ($result["statusfield"] == 'Inactive') {
                                echo "selected";
                            }
                            ?>>Inactive</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Date:</label>
                <input type="date" class="form-control" placeholder="Enter Date" name="date" value="<?php echo $result['cdate']; ?>" autocomplete="off" required>
            </div>
            <div class="mb-3">
                <label>Requested By:</label>
                <input type="text" class="form-control" placeholder="Enter requester's name" name="reqby" value="<?php echo $result['req_by']; ?>" autocomplete="on">
            </div>

            <div class="d-flex justify-content-between">
                <button name="submit" class="btn btn-success">Submit</button>
                <a href="display_cm.php">Go Back to Table</a>
            </div>
        </form>

    </div>

</body>

</html>