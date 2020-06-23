<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();

include '../includes/DatabaseConnection.php';

mysqli_set_charset($DB, "utf8");

$id_user = $_SESSION['user']['id'];

if (!$DB) {
//        echo "\nConnection failed<br>\n";
} else {
// SQL-запрос
    $sql1 = "select ttn 
                    from documents 
                   WHERE id_user = '$id_user'
                order by ttn";


// Выполнить запрос (набор данных $rs содержит результат)
    $rs = mysqli_query($DB, $sql1);

    if (!($rs)) {
        $good = "Get ttns bad";
        $error_message = mysqli_error($DB);
        $error_code = mysqli_errno($DB);
        $error_sqlstate = mysqli_sqlstate($DB);
        echo("<BR />");
        echo $good;
        echo("<BR />");
        echo $error_message;
        echo("<BR />");
        echo $error_code;
        echo("<BR />");
        echo $error_sqlstate;
        echo("<BR />");
    } else {
        $good = "Get ttn ok";
        $error_message = mysqli_error($DB);
        $error_code = mysqli_errno($DB);
        $error_sqlstate = mysqli_sqlstate($DB);
        echo("<BR />");
        echo $good;
        echo("<BR />");
        echo $error_message;
        echo("<BR />");
        echo $error_code;
        echo("<BR />");
        echo $error_sqlstate;
        echo("<BR />");

        $mas = array();
        $i = 0;

// Цикл по recordset $rs
// Каждый ряд становится массивом ($row) с помощью функции mysql_fetch_array

        while ($row = mysqli_fetch_array($rs)) {

            // Записать значение столбца id_doc, date_doc, ... (из массива $row)
            $ttn = $row['ttn'];

            $result_ok = array(
                'ttn' => $ttn,
            );

            $mas[$i] = $result_ok;
            $i++;
        }

// Закрыть соединение с БД
        mysqli_close($DB);

        return $mas;
    }
}
