<?php

include '../dbcon.php';
require('../Classes/PHPExcel.php');
require('../Classes/PHPExcel/IOFactory.php');

if (isset($_POST['submit'])) {
    $file = $_FILES['doc']['tmp_name'];

    $ext = pathinfo($_FILES['doc']['name'], PATHINFO_EXTENSION);
    if ($ext == 'xlsx') {

        $obj = PHPExcel_IOFactory::load($file);

        foreach ($obj->getWorksheetIterator() as $sheet) {

            $getHighestRow = $sheet->getHighestRow();
            for ($i = 2; $i <= $getHighestRow; $i++) {

                $aid = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $email_dom = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $email = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $dialer = $sheet->getCellByColumnAndRow(3, $i)->getValue();

                // checking the duplicate entries in avaya id. //
                $check_duplicate = "select aid from acra where aid = '$aid' ";
                $countquery = mysqli_query($conn, $check_duplicate);

                if (mysqli_num_rows($countquery) > 0) {
                    echo "<script type = 'text/javascript'>
                            alert('AgentID: " . $aid . " already exists! Try Another');
                        </script>";
                } else {
                    $query = "INSERT INTO acra(aid, email_dom, email, dialer) values('$aid','$email_dom', '$email','$dialer')";

                    if ($aid != '') {
                        $fire_query = mysqli_query($conn, $query);
                    }
                }
            }
            if ($fire_query) {
                echo "<script>
		            alert('Uploaded Successfully!');
		            window.location.href='display-acra.php';
        		</script>";
            } else {
                echo "<script>
		            alert('Something went wrong!');
		            window.location.href='insert-acra.php';
        		</script>";
            }
        }
    } else {
        echo "<script>
            alert('Invalid file format!');
            window.location.href='insert-acra.php';
        </script>";
    }
}
