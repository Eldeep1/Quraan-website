<?php
// Check if form is submitted
require_once '../models/quran.php';
$quran = Quran::getInstance("localhost", "root", "1234", "quran");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Set the folder path where the new folder will be created
    $folderPath = 'E:/Xampp/htdocs/Islameiat/';

    // Check if name field is set
    if (isset($_POST['name'])) {
        $quran->addReader( $_POST['name']);
        $data=$quran->getReaderNames();
        $counter = 0;
        foreach ($data as $row) {
            $counter++;
        }

        $folderName = $counter;

        // Check if the name is not empty
        if (!empty($folderName)) {
            // Create the new folder
            if (!file_exists($folderPath . $folderName)) {
                mkdir($folderPath . $folderName, 0777, true);
            }

            // Check if a folder was uploaded
            if (isset($_FILES['folder'])) {
                //getting the number of the uploaded folders
                //to use it later on moving the file number x from temporary (system ) to the wanted directory
               $quran->addReaderfolder($folderPath,$folderName,$_FILES);
                echo "Folder and files uploaded successfully.";
            } else {
                echo "No files uploaded.";
            }
        } else {
            echo "Name field cannot be empty.";
        }
    } else {
        echo "Name field is not set.";
    }
}



?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Create Folder</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" id="name" name="name">
        <br>
        <label for="folder">Folder (add sura numbers only and remember, once the files in, they are never out):</label>
        <input type="file" id="folder" name="folder[]" multiple>
        <br>
        <input type="submit" value="Create Folder">
    </form>   
</body>
</html>
