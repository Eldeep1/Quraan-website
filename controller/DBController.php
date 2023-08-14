<?php

class DBController {

    private $dbhost;
    private $dbUser ;
    private $dbPassword ;
    private $dbName ;
    private $connection;
    private $query;

    public function setdbhost($dbhost){//'localhost'
        $this->dbhost=$dbhost;
    }
    public function setdbPassword($dbpassword){//'1234'
        $this->dbPassword=$dbpassword;
    }
    public function setdbname($dbname){//'quran'
        $this->dbName=$dbname;
    }
    public function setdbuser($dbuser){//'root'
        $this->dbUser=$dbuser;
    }
    public function openConnection() {
        $this->connection = new mysqli($this->dbhost, $this->dbUser, $this->dbPassword, $this->dbName);
        if ($this->connection->connect_error) {
            echo 'Error in connection: ' . $this->connection->connect_error;
            return false;
        } else {
            return true;
        }
    }
    public function closeConnection() {
        if ($this->connection) {
            $this->connection->close();
        } else {
            echo 'connection is already closed';
        }
}
public function execute($query,$number) {
    $result = $this->connection->query($query);
    if (!$result) {
        echo 'Error: ' . mysqli_errno($this->connection);
        return false;
    } else if ($number==1) {
        return true;
    }
 else if ($number==2) {
        
    
   
        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        return $data;
    }
}
}
