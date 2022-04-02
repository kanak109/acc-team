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

                $msisdn = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $status = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $ipphone = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $email = $sheet->getCellByColumnAndRow(3, $i)->getValue();

                $query = "INSERT INTO ip_phone(msisdn, statusfield, ipphone, email) VALUES ( '$msisdn', '$status', '$ipphone', '$email')";

                if ($msisdn != '') {
                    $fire_query = mysqli_query($conn, $query);
                }
            }
            if ($fire_query) {
                echo "<script>
		            alert('Uploaded Successfully!');
		            window.location.href='display_ip.php';
        		</script>";
            } else {
                echo "<script>
		            alert('Something went wrong! Please Check.');
		            window.location.href='display_ip.php';
        		</script>";
            }
        }
    } else {
        echo "<script>
            alert('Invalid file format!');
            window.location.href='insert_ip.php';
        </script>";
    }
}
