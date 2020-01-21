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
Проверяем была ли отправлена форма, то есть была ли нажата кнопка Войти. Если да, то идём дальше, если нет, то выведем пользователю сообщение об ошибке, о том что он зашёл на эту страницу напрямую.
*/
if (isset($_POST["btn_submit_auth"]) && !empty($_POST["btn_submit_auth"])) {

    if (isset($_POST["password"])) {

        //Обрезаем пробелы с начала и с конца строки
        $password = trim($_POST["password"]);

        if (!empty($password)) {
            $password = htmlspecialchars($password, ENT_QUOTES);

            //Шифруем пароль
            $password = md5($password . "top_secret");
        } else {
            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<h3 class='mesage_error' >Укажите Ваш пароль</h3>";

            //Возвращаем пользователя на страницу регистрации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Останавливаем скрипт
            exit();
        }

    } else {
        // Сохраняем в сессию сообщение об ошибке. 
        $_SESSION["error_messages"] .= "<h3 class='mesage_error' >Отсутствует поле для ввода пароля</h3>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_auth.php");

        //Останавливаем скрипт
        exit();
    }

    $result_query_select = $pdo->prepare("SELECT * FROM `teh_per` WHERE login = :login AND password = :password");
    $params = array(
        ':login'    => $login,
        ':password'    => $password,
    );
    $result_query_select->execute($params);

    if (!$result_query_select) {
        // Сохраняем в сессию сообщение об ошибке.
        $_SESSION["error_messages"] .= "<h3 class='mesage_error' >Ошибка запроса на выборке пользователя из БД</h3>";

        //Возвращаем пользователя на страницу регистрации
        header("HTTP/1.1 301 Moved Permanently");
        header("Location: " . $address_site . "/form_auth.php");

        //Останавливаем скрипт
        exit();
    } else {

        //Проверяем, если в базе нет пользователя с такими данными, то выводим сообщение об ошибке
        if ($result_query_select == 1) {

            // Если введенные данные совпадают с данными из базы, то сохраняем логин и пароль в массив сессий.
            $_SESSION['login'] = $login;
            $_SESSION['password'] = $password;

            //Возвращаем пользователя на главную страницу
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/requests.php");

        } else {

            // Сохраняем в сессию сообщение об ошибке. 
            $_SESSION["error_messages"] .= "<h3 class='mesage_error' >Неправильный логин и/или пароль</h3>";

            //Возвращаем пользователя на страницу авторизации
            header("HTTP/1.1 301 Moved Permanently");
            header("Location: " . $address_site . "/form_auth.php");

            //Останавливаем скрипт
            exit();
        }
    }
}else{
    exit("<p><strong>Ошибка!</strong> Вы зашли на эту страницу напрямую, поэтому нет данных для обработки. Вы можете перейти на <a href=" . $address_site . "> главную страницу </a>.</p>");
}