<?php
namespace app;

require_once 'mvc/Controller.php';

use mvc\Controller;

class AdminController extends Controller {
    
    // Articles
    function articles($params) {
        // Check auth data
        if(isset($_SESSION['login_time']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){ // ok
            // Get articles data
            $_SESSION['articles'] = $_SESSION['con']->query("SELECT * FROM articles ORDER BY `id` DESC");
            
            // Send data to view admin page
            $this->render('admin');
        }else{ // error
            // Redirect to login page
            header('Location: ' . '/example/login', true);
        }
    }

    // Login page
    function login($params) { 
        // Check auth data
        if(isset($_SESSION['login_time']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){ // error
            // Redirect to admin page
            header('Location: ' . '/example/admin', true);
        }else{ // ok
            // Send data to view login page
            $this->render('login');
        }
    }

    // Logout action
    function logout($params) {
        // Check data
        if(isset($_SESSION['login_time']) && isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 1){ // ok
            // Unset all sessions
            session_unset();
        }

        // Redirect to login page
        header('Location: ' . '/example/login', true);
    }

    // Destroy action
    function destroy($params) {
        // Get id
        $id = $params['id'];
        
        // Deleteing
        $delete = $_SESSION['con']->query("DELETE FROM articles WHERE `id` = $id");

        // Check delete data
        if(isset($delete) && $delete == true){ // ok
            // Make success deleted response data
            $_SESSION['success_deleted'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/admin');
        }else{ // error
            // Make error deleted response data
            $_SESSION['error_deleted'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/admin');
        }
    }

    // Update action
    function update($params) {
        // Get id
        $id = $params['id'];
        
        // Get status
        $status = intval($params['status']);

        // Get description
        $description = htmlspecialchars($params['description']);

        // Update
        $update = $_SESSION['con']->query("UPDATE articles SET `status` = '$status', `description` = '$description' WHERE `id` = $id");

        // Check update data
        if(isset($update) && $update == true){ // ok
            // Make success updated response data
            $_SESSION['success_updated'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/admin');
        }else{ // error
            // Make error updated response data
            $_SESSION['error_updated'] = true;

            // Redirecting to back page
            header('Location: ' . '/example/admin');
        }
    }

    // Send login data action
    function send($params) {
        // Check data
		if(htmlspecialchars($params['username']) === 'admin' && md5(htmlspecialchars($params['password'])) == md5('123')) {
            // Make loged time session
            $_SESSION['login_time'] = time();
			
            // Meke logged in session
            $_SESSION['logged_in'] = 1;

            // Meke logged in session first time
            $_SESSION['logged_in_first'] = true;
            
            // Redirecting to admin page
            header('Location: ' . '/example/admin', true);
		}else{
            // Make login error session
            $_SESSION['login_error'] = true;
            
            // Redirect to login page
            header('Location: ' . '/example/login', true);
		}
    }
    
}

