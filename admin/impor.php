<?php
include 'includes/session.php';

if (isset($_POST['add'])) {
    if (isset($_FILES['excel_file']['name'])) {
        $excel_file = $_FILES['excel_file']['tmp_name'];

        // Buka file Excel
        $excelData = [];
        $objPHPExcel = new COM("Excel.Application") or die("Unable to instantiate Excel");

        $objPHPExcel->Workbooks->Open($excel_file);
        $worksheet = $objPHPExcel->Worksheets(1);

        // Ambil data dari setiap baris
        $row = 2; // Mulai dari baris kedua (asumsi baris pertama adalah header)
        while ($worksheet->Cells($row, 1)->Value != "") {
            $firstname = $worksheet->Cells($row, 1)->Value;
            $lastname = $worksheet->Cells($row, 2)->Value;
            $password = password_hash($worksheet->Cells($row, 3)->Value, PASSWORD_DEFAULT);
            $filename = $worksheet->Cells($row, 4)->Value;

            // Generate voters id
            $set = '1234567890';
            $voter = substr(str_shuffle($set), 0, 5);

        

            $row++;
        }

        $objPHPExcel->Quit();
        $objPHPExcel = null;

        $_SESSION['success'] = 'Data from Excel imported successfully';
    } else {
        $_SESSION['error'] = 'Upload Excel file first';
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

header('location: voters.php');
?>
