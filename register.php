<?php
    //Запускаем сессию
    session_start();

    //Добавляем файл подключения к БД
    require_once("dbconnect.php");

    //Объявляем ячейку для добавления ошибок, которые могут возникнуть при обработке формы.
    $_SESSION["error_messages"] = '';

    //Объявляем ячейку для добавления успешных сообщений
    $_SESSION["success_messages"] = '';

    /*
        Проверяем была ли отправлена форма, то есть была ли нажата кнопка отправить. Если да, то идём дальше, если нет, значит пользователь зашёл на эту страницу напрямую. В этом случае выводим ему сообщение об ошибке.
    */
    if(isset($_POST["btn_submit_register"]) && !empty($_POST["btn_submit_register"])){
        //Запрос на добавления пользователя в БД
        $result_query_insert = $pdo->prepare("INSERT INTO `requests` VALUES (Default,:LastName,:FirstName,:MiddleName, :Age, :Address, :email, :phonenumber  )");
        $params = array(
            ':LastName'    => $_POST['LastName'],
            ':FirstName'    => $_POST['FirstName'],
            ':MiddleName'    => $_POST['MiddleName'],
            ':Age'    => $_POST['Age'],
            ':Address'    => $_POST['Address'],
            ':email'    => $_POST['email'],
            ':phonenumber'    => $_POST['phonenumber']
        );
        $result_query_insert->execute($params);
        if(!$result_query_insert){
            // Сохраняем в сессию сообщение об ошибке.
            $_SESSION["error_messages"] .= "<h3 class='mesage_error' ><strong>Ошибка при попытке отправить запрос</strong></h3>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");

            //Останавливаем  скрипт
            exit();
        }else{

            $_SESSION["success_messages"] = "<h3 class='success_message'><strong>Данные успешно отправлены.</strong></h3>";
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: ".$address_site."/form_register.php");
        }

        /* Завершение запроса */
        $result_query_insert = null;

        //Закрываем подключение к БД
        $pdo = null;


    }else{

        exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=".$address_site."> главную страницу </a>.</p>");
    }
?>