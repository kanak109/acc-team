<?php

include '../dbcon.php';


$id = $_GET['ids'];

$deletequery = "delete from dialer where id=$id";


$query = mysqli_query($conn, $deletequery);

if ($query) {

  echo "<script>
            alert('Deleted Successfully!');
            window.location.href='display_dialer.php';
        </script>";
} else {

  echo "<script>
            alert('Couldn't be Deleted!');
            window.location.href='display_dialer.php';
        </script>";
}
