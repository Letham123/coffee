<?php
namespace app\controllers\Admin;
use app\models\ContactModel;
class ContactsController {
    private $contactModel;
     public function __construct($db) {
        $this->db = $db; 
         if (session_status() === PHP_SESSION_NONE) {
        session_start();
        }
        if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
            header("Location: /coffee/login");
            exit();
        }
        $this->contactModel = new ContactModel($db);
    }

    public function index() {
        $contacts = $this->contactModel->getAll();
        require_once __DIR__ . '/../../views/admin/contacts/index.php';
    }
    
}
