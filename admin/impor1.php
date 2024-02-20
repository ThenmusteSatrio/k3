<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Excel Data</title>
</head>
<body>
    <h2>Import Excel Data</h2>

    <?php
        // Tampilkan pesan sukses atau error jika ada
        if (isset($_SESSION['success'])) {
            echo '<p style="color: green;">' . $_SESSION['success'] . '</p>';
            unset($_SESSION['success']);
        }

        if (isset($_SESSION['error'])) {
            echo '<p style="color: red;">' . $_SESSION['error'] . '</p>';
            unset($_SESSION['error']);
        }
    ?>

    <form action="impor.php" method="post" enctype="multipart/form-data">
        <label for="excel_file">Choose Excel File:</label>
        <input type="file" name="excel_file" id="excel_file" accept=".xlsx, .xls" required>
        <br>
        <button type="submit" name="add">Import Data</button>
    </form>
</body>
</html>
