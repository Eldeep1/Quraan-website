<?php
class User {
    private $username;

    public function __construct($username) {
        $this->username = $username;
    }

    public function getUsername() {
        return $this->username;
    }
}

$user = new User('johnsmith');

// Endpoint that returns the username property of the User object
if ($_GET['action'] === 'getUsername') {
    header('Content-Type: application/json');
    echo json_encode($user->getUsername());
}

$username = json_decode(file_get_contents('http://example.com/api.php?action=getUsername'));
