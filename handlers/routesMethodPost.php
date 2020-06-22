<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if ($method === 'POST') {
// header('Content-type:application/json');
    if ($route === '/registration') {
        $request = json_decode(file_get_contents('php://input'), true);

//        var_dump($request);
        $isValid = valid($request);
//        var_dump($isValid);
        
        if ($isValid) {
            $responseSuccess = [
                'result' => true,
                'message' => 'registration successful, go to login'
            ];
            
            $responseFail = [
                'result' => false,
                'message' => 'name or email already exists'
            ];
            
            $isSave = addUser($request);
//            var_dump($isSave);
            
            if($isSave) {
                echo json_encode($responseSuccess);
            } else {
                echo json_encode($responseFail);
            }

            
        } else {
            $response = [
                'result' => false,
                'message' => $isValid
            ];

            echo json_encode($response);
        }
    }
    
    if ($route === '/ttn') {
        $request = json_decode(file_get_contents('php://input'), true);

        $isValid = validTtn($request);
        
        if ($isValid) {
            
            $request['id'] = $_SESSION['user']['id'];
            
            $isGot = getStatus($request);
            
            saveTtn($isGot);
            
            $isGot['ttns'] = getTtns($isGot);
//            
            echo json_encode($isGot);
            
        } else {
            $response = [
                'result' => false,
                'message' => $isValid
            ];

            echo json_encode($response);
        }
    }
    
    if ($route === '/login') {
        
        $name = $_POST['name'];
        $email = $_POST['email'];

        $User = getUser($email);
        
        /* if name or email is not correct
           send page login with error
         *          */
        if(empty($User) || empty($User[0]) || ($name != $User[0]['login']) || ($email != $User[0]['email'])) {
            $error = 'user not found, enter correct username and email';
            include '../views/header.php';
            include '../views/login.php';
            include '../views/footer.php';
            $_SESSION['user'] = NULL;
            die;
        }
        
        $_SESSION['user'] = $User[0];

        header("Location: /ttn");
        
    }
}