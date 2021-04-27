<?php
namespace app;

require_once 'mvc/Controller.php';

use mvc\Controller;

class IndexController extends Controller {

    // Home page
    function index($params) {
        // Send data to view admin page
        $this->render('home');
    }

    // Home page sorting
    function sort($params) {
        // Get sort field
        $field = $params['field'];
        
        // Get order type
        $order_type = $params['order'];

        // Send data to view admin page
        $this->render('home');
    }

    // Add new article
    function store($params) 
    {
        // Get request data
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_email = htmlspecialchars($_POST['user_email']);
        $description = htmlspecialchars($_POST['description']);
        $status = 0;
        
        // Instert operation
        $store = $_SESSION['con']->query("INSERT INTO `articles` (`user_name`, `user_email`, `description`, `status`) VALUE ('$user_name', '$user_email', '$description', '$status')");

        // Check store data
        if(isset($store) && $store == true) { // ok
            // Make success stored response data
            $_SESSION['success_stored'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/home');
        }else{ // error
            // Make error stored response data
            $_SESSION['error_stored'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/home');
        }
    }
}

