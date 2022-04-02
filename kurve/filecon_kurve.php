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

                $uname = $sheet->getCellByColumnAndRow(0, $i)->getValue();
                $email = $sheet->getCellByColumnAndRow(1, $i)->getValue();
                $aid = $sheet->getCellByColumnAndRow(2, $i)->getValue();
                $kdname = $sheet->getCellByColumnAndRow(3, $i)->getValue();
                $password = $sheet->getCellByColumnAndRow(4, $i)->getValue();
                $remarks = $sheet->getCellByColumnAndRow(5, $i)->getValue();

                // checking the duplicate entries in avaya id. //
                $check_duplicate = "select avayaid from kurve_dashboard where avayaid= '$aid'";
                $countquery = mysqli_query($conn, $check_duplicate);

                if (mysqli_num_rows($countquery) > 0) {
                    echo "<script type = 'text/javascript'>
                            alert('AvayaID: " . $aid . " already exists! Try Another');
                        </script>";
                } else {
                    $query = "INSERT INTO kurve_dashboard(uname, email, avayaid, username, pass, remarks) VALUES ('$uname','$email','$aid ','$kdname','$password','$remarks')";

                    if ($uname != '') {
                        $fire_query = mysqli_query($conn, $query);
                    }
                }



                if ($uname != '') {
                    $fire_query = mysqli_query($conn, $query);
                }
            }
            if ($fire_query) {
                echo "<script>
		            alert('Uploaded Successfully!');
		            window.location.href='display_kurve.php';
        		</script>";
            } else {
                echo "<script>
		            alert('Something went wrong! Please Check.');
		            window.location.href='display_kurve.php';
        		</script>";
            }
        }
    } else {
        echo "<script>
            alert('Invalid file format!');
            window.location.href='insert_kurve.php';
        </script>";
    }
}
