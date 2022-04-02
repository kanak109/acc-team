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

                $agentid = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $agentname = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $status = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $date = $sheet->getCellByColumnAndRow(3, $i)->getValue();
                $req = $sheet->getCellByColumnAndRow(4, $i)->getValue();

                // checking the duplicate entries in user id. //
                $check_duplicate = "select agentid from cm_user where agentid = '$agentid'";
                $countquery = mysqli_query($conn, $check_duplicate);

                if (mysqli_num_rows($countquery) > 0) {
                    echo "<script type = 'text/javascript'>
                            alert('AgentID: " . $agentid . " already exists! Try Another');
                        </script>";
                } else {
                    $query = "INSERT INTO cm_user(agentid, agentname, statusfield, cdate, req_by) VALUES ( '$agentid', '$agentname', '$status', '$date', '$req')";

                    if ($agentid != '') {
                        $fire_query = mysqli_query($conn, $query);
                    }
                }
            }
            if ($fire_query) {
                echo "<script>
		            alert('Uploaded Successfully!');
		            window.location.href='display_cm.php';
        		</script>";
            } else {
                echo "<script>
		            alert('Something went wrong! Please Check.');
		            window.location.href='display_cm.php';
        		</script>";
            }
        }
    } else {
        echo "<script>
            alert('Invalid file format!');
            window.location.href='insert_cm.php';
        </script>";
    }
}
