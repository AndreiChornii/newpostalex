<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$currentUser = $_SESSION['user'];

if ($method === 'GET') {
    # code...
    
   if(empty($_SESSION['routes'])) {
       $_SESSION['routes'] = [];
    } 
    
    if (($route === '/get_documents') and !empty($currentUser['login'])) {
        $id_user = $_SESSION['user']['id'];
        echo json_encode(getDocuments($id_user, $DB));
        die;
    }
    
    include '../views/header.html.php';
 
    if ($route === '/registration') {
        include '../views/registration.html.php';
    }
    
    if (($route === '/') and empty($currentUser['login'])) {
        $error = '';
        include '../views/login.html.php';
    }
    
    if (($route === '/documents') and !empty($currentUser['login'])) {
        $error = '';
        include '../views/documents.html.php';
    }
    
    if (($route === '/logout') and !empty($currentUser['login'])) {
        $_SESSION['user'] = null;
        header("Location: /");
    }

    include '../views/footer.html.php';
}