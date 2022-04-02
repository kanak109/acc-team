<?php

include '../dbcon.php';


$id = $_GET['ids'];

$deletequery = "delete from acra where id=$id";


$query = mysqli_query($conn, $deletequery);

if ($query) {

  echo "<script>
            alert('Deleted Successfully!');
            window.location.href='display-acra.php';
        </script>";
} else {

  echo "<script>
            alert('CouldNot Deleted Successfully!');
            window.location.href='display-acra.php';
        </script>";
}
