<?php
require 'fetchuser.php';

class UserController {
    private $userHandler;

    public function __construct($conn) {
        $this->userHandler = new UserHandler($conn);
    }

    public function index() {
        return $this->userHandler->fetchUsers();
    }
}
?>
