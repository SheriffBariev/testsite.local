<?php
//Запускаем сессию
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="author" content="Ayup Bariev">
    <link rel="icon" href="../../favicon.ico">

    <title>Система заявок</title>

    <!-- Последняя компиляция и сжатый CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">

    <!-- Дополнение к теме -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Последняя компиляция и сжатый JavaScript -->
    <link rel="stylesheet" href="css/singin.css">
    <script src="/js/bootstrap.js"></script>
    <script src="/js/bootstrap.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="/js/bootstrap.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            "use strict";
            //================ Проверка email ==================

            //регулярное выражение для проверки email
            var pattern = /^[a-z0-9][a-z0-9\._-]*[a-z0-9]*@([a-z0-9]+([a-z0-9-]*[a-z0-9]+)*\.)+[a-z]+/i;
            var mail = $('input[name=email]');

            mail.blur(function(){
                if(mail.val() != ''){

                    // Проверяем, если введенный email соответствует регулярному выражению
                    if(mail.val().search(pattern) == 0){
                        // Убираем сообщение об ошибке
                        $('#valid_login_message').text('');

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }else{
                        //Выводим сообщение об ошибке
                        $('#valid_login_message').text('Не правильный Логин');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);
                    }
                }else{
                    $('#valid_login_message').text('Введите Ваш Логин');
                }
            });

            //================ Проверка длины пароля ==================
            var password = $('input[name=password]');

            password.blur(function(){
                if(password.val() != ''){

                    //Если длина введенного пароля меньше шести символов, то выводим сообщение об ошибке
                    if(password.val().length < 6){
                        //Выводим сообщение об ошибке
                        $('#valid_password_message').text('Минимальная длина пароля 6 символов');

                        // Дезактивируем кнопку отправки
                        $('input[type=submit]').attr('disabled', true);

                    }else{
                        // Убираем сообщение об ошибке
                        $('#valid_password_message').text('');

                        //Активируем кнопку отправки
                        $('input[type=submit]').attr('disabled', false);
                    }
                }else{
                    $('#valid_password_message').text('Введите пароль');
                }
            });
        });
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <script src="/js/bootstrap.min.js"></script>

</head>
<body>
<header class="navbar-inverse" id="top">
    <div class="container">
        <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#bs-navbar"
                    aria-controls="bs-navbar" aria-expanded="true">
                <span class="sr-only">Переключить навигации</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="../" class="navbar-brand">Система заявок</a>
        </div>
        <?php
        if (!isset($_SESSION['login']) && !isset($_SESSION['password'])) {
            // если нет, то выводим блок с ссылками на страницу регистрации и авторизации
            ?>
            <nav id="bs-navbar" class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="form_register.php">Отправить заявку</a>
                    </li>
                </ul>
                <ul class="nav navbar-nav navbar-right pull-right">
                    <li>
                        <a href="form_auth.php">Войти в систему</a>
                    </li>
                </ul>
                </ul>
            </nav>
            <?php
        } else {
        //Если пользователь авторизован, то выводим ссылку Выход
        ?>
        <nav id="bs-navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="/logout.php">Выйти</a>
                </li>
            </ul>
        </nav>
            <?php
        }
        ?>
    </div>
</header>