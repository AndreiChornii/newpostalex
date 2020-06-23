<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($method === 'GET') {
    # code...
    
    $currentUser = $_SESSION['user'];
    
    if(empty($_SESSION['routes'])) {
       $_SESSION['routes'] = [];
    } 
    
    if ($route === '/get_documents') {
        $id_user = $_SESSION['user']['id'];
        echo json_encode(getDocuments($id_user, $DB));
        die;
    }
    
    include '../views/header.html.php';
 
    if ($route === '/registration') {
        include '../views/registration.html.php';
    }
    
    if ($route === '/') {
        $error = '';
        include '../views/login.html.php';
    }
    
    if ($route === '/documents') {
        $error = '';
        include '../views/documents.html.php';
    }
    
    if ($route === '/logout') {
        $_SESSION['user'] = null;
        header("Location: /");
    }

    include '../views/footer.html.php';
}