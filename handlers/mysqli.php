<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function getUser($email, $DB)
{

    if (!$DB) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        //    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        //    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    //
    //echo "Соединение с MySQL установлено!" . PHP_EOL;
    //echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

    $dataUser = $DB->query("select id, login, email
                              from users 
                             where email = '{$email}'");

    $user = $dataUser->fetch_all(MYSQLI_ASSOC);
    //    var_dump($users->fetch_all(MYSQLI_ASSOC));

    mysqli_close($DB);

    return $user;
}

function addUser($data, $DB)
{

    //    var_dump($data);

    if (!$DB) {
        echo "Ошибка: Невозможно установить соединение с MySQL." . PHP_EOL;
        //    echo "Код ошибки errno: " . mysqli_connect_errno() . PHP_EOL;
        //    echo "Текст ошибки error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }

    $sql = "insert into users(login, email)
                       VALUES ('{$data['name']}', '{$data['email']}');";
    //
    //echo "Соединение с MySQL установлено!" . PHP_EOL;
    //echo "Информация о сервере: " . mysqli_get_host_info($link) . PHP_EOL;

    $resultQuery = $DB->query($sql);

    mysqli_close($DB);

    //    var_dump($resultQuery);

    return $resultQuery;
}

function saveTtn($data, $DB)
{
    //    var_dump($data);
    //    echo $data['ScheduledDeliveryDate'];
    //    var_dump($data);
    // Соединиться с сервером БД
    mysqli_set_charset($DB, "utf8");
    if (!$DB) {
        $result = "Connection failed";
        //        echo json_encode($result);
    } else {

        //$num = $_POST['num'];
        $ttn = $data['ttn'];
        $id_user = $data['id_user'];
        // SQL-запрос
        // $sql1 = "INSERT INTO `reestr`(num, descr, trespassing, date, who, source, risk_destroy, process_name, department, comment)
        //  VALUES (82, 'Отримання клієнтами підроблених документів щодо заборгованості перед банком, які направляються банком', 'Отримання клієнтами підроблених документів щодо заборгованості перед банком. Крім того, вимога з ознаками залякування', '2018-02-13', 'Сігал Н.В.', 'Інформація з відділення банку', 'Проводяться заходи щодо попередження зазначеного комплаєнс-ризику','Моніторинг по роботі з кредитними картками','Департамент з моніторингу по роботі з кредитними картками - (Польща В.В.)','Здійснюються язаходи щодо попередження зазначеного комплаєнс-ризику')";

        // Перевірити, чи немає ттн вже в б/д і якщо немає то додати
        $sql0 = "SELECT ttn FROM documents WHERE ttn = " .  $ttn;
        $rs0 = mysqli_query($DB, $sql0);
        // var_dump($rs0);
        // exit(0);

        if ($rs0->num_rows === 0) {
            $sql1 = "INSERT INTO documents(ttn, id_user)
                    VALUES ($ttn, $id_user);
                    ";

            // Выполнить запрос (набор данных $rs содержит результат)
            //$rs = mysqli_query($strSQL);
            $rs = mysqli_query($DB, $sql1);

            // Цикл по recordset $rs
            // Каждый ряд становится массивом ($row) с помощью функции mysql_fetch_array
            // Закрыть соединение с БД

            if ($rs) {
                $result = "Wrote ok";
                //            echo json_encode($result);
            } else {
                $result = "Wrote wrong";
                $error_message = mysqli_error($DB);
                $error_code = mysqli_errno($DB);
                $error_sqlstate = mysqli_sqlstate($DB);
                //            echo("<BR />");
                //            echo $error_message;
                //            echo("<BR />");
                //            echo $error_code;
                //            echo("<BR />");
                //            echo $error_sqlstate;
                //            echo("<BR />");
                //            echo json_encode($result);
            }
        }

        //        mysqli_close($DB);
    }
}

function getDocuments($id_user, $DB)
{
    mysqli_set_charset($DB, "utf8");

    //    $id_user = $_SESSION['user']['id'];

    if (!$DB) {
        echo "\nConnection failed<br>\n";
    } else {
        // SQL-запрос
        $sql1 = " select ttn 
                    from documents 
                   WHERE id_user = '$id_user'
                order by ttn";

        // Выполнить запрос (набор данных $rs содержит результат)
        $rs = mysqli_query($DB, $sql1);

        if (!($rs)) {
            $bad = "Get ttns bad";
            $error_message = mysqli_error($DB);
            $error_code = mysqli_errno($DB);
            $error_sqlstate = mysqli_sqlstate($DB);
            //            echo("<BR />");
            //            echo $good;
            //            echo("<BR />");
            //            echo $error_message;
            //            echo("<BR />");
            //            echo $error_code;
            //            echo("<BR />");
            //            echo $error_sqlstate;
            //            echo("<BR />");
            return $bad;
        } else {
            $good = "Get ttn ok";
            $error_message = mysqli_error($DB);
            $error_code = mysqli_errno($DB);
            $error_sqlstate = mysqli_sqlstate($DB);
            //            echo("<BR />");
            //            echo $good;
            //            echo("<BR />");
            //            echo $error_message;
            //            echo("<BR />");
            //            echo $error_code;
            //            echo("<BR />");
            //            echo $error_sqlstate;
            //            echo("<BR />");

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
}

function getStatus($data)
{

    //    $ttn = $data['ttn'];
    //    $id = $data['id'];
    //    var_dump($data);
    //    header("Content-Type: application/json;charset=UTF-8");
    //    ini_set('max_execution_time', 300);

    $url_str = 'https://api.novaposhta.ua/v2.0/json/';
    $post_str = '
        {
            "apiKey": "b88af3fba3af070a6a2d1b01aa16607e",
            "modelName": "TrackingDocument",
            "calledMethod": "getStatusDocuments",
            "methodProperties": {
                "Documents": [
                    {
                        "DocumentNumber": "' . $data['ttn'] . '",
                        "Phone":""
                    }
                ]
            }

        }
        ';
    //    echo $post_str;
    //    exit();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_str);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json;charset=UTF-8'));
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        $post_str
    );
    $statusDate = curl_exec($ch);
    if (curl_errno($ch)) {
        // print "Error curl: ". curl_error($ch);
        $rezult = "Error curl: " . curl_error($ch);
        $rez = "from new_post bad";
        $to_fe = array(
            'rez' => $rez,
            'rezult' => $rezult
        );
        return $to_fe;
    } else {
        // echo("adr: ");
        //    print_r($adr);
        //    echo("<BR />");
        $decoded = json_decode($statusDate);
        //    var_dump($decoded);
        //    exit();
        // return($decoded);
        $date = 'data';
        $got_array = $decoded->$date;

        //        //элементы ттн
        $ttn_obj = $got_array[0];
        //        var_dump($ttn_obj);
        $sta = 'Status';
        $Status = $ttn_obj->$sta;
        $snd = 'WarehouseSender';
        $WarehouseSender = $ttn_obj->$snd;
        $rcp = 'WarehouseRecipient';
        $WarehouseRecipient = $ttn_obj->$rcp;

        //
        $data = [];

        $data['Status'] = $Status;
        $data['WarehouseSender'] = $WarehouseSender;
        $data['WarehouseRecipient'] = $WarehouseRecipient;

        $data['rez'] = "from new_post ok";
        //       
        return $data;
        //        var_dump($data);
    }

    //    return $resultQuery;
}
