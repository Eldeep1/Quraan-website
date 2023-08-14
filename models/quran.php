
<?php

require_once '../controller/DBController.php';

class Quran {

    private static $instance;
    private $db;

    private function __construct($dbHost, $dbUser, $dbPassword, $dbName) {
        $this->db = new DBController();
        $this->db->setdbPassword($dbPassword);
        $this->db->setdbhost($dbHost);
        $this->db->setdbuser($dbUser);
        $this->db->setdbname($dbName);
        $this->db->openConnection();
    }

    public static function getInstance($dbHost, $dbUser, $dbPassword, $dbName) {
        if (self::$instance == null) {
            self::$instance = new Quran($dbHost, $dbUser, $dbPassword, $dbName);
        }
        return self::$instance;
    }

    public function getSurahText($sura) {
        $query = "SELECT * FROM quran_text where sura = $sura";
        return $this->db->execute($query, 2);
    }

    public function getSurahTafsir($sura) {
        $query = "SELECT * FROM ar_muyassar where sura = $sura";
        return $this->db->execute($query, 2);
    }

    public function getReaderNames() {
        $query = "select name from readers; ";
        return $this->db->execute($query, 2);
    }

    public function addReader($readername) {
        $query = "insert into Readers (name) values('$readername')";
        $this->db->execute($query, 1);
    }
//    public function get_readerNumber($readername){
//        $query1 = "select id from readers where name=$readername";
//       $result= $query1->db->execute($query1, 1);
//       if ($result) {
//              $id = $result[0]['id'];
//              return $id;
//       }
//    }
    
    public function addReaderfolder($folderPath,$folderName,$files){
    $fileCount = count($files['folder']['name']);
    for ($i = 0; $i < $fileCount; $i++) {
        $fileName = $files['folder']['name'][$i];
        $fileTmpLoc = $files['folder']['tmp_name'][$i];
        $moveResult = move_uploaded_file($fileTmpLoc, $folderPath . $folderName . '/' . $fileName);

        // Check if the file was successfully moved
        if (!$moveResult) {
            echo "Error uploading file.";
            exit;
        }
    }
}

}
