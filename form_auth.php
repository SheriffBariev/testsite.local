<?php
require_once("header.php");
?>

    <!-- Блок для вывода сообщений -->
    <div class="block_for_messages">
        <?php

        if (isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])) {
            echo $_SESSION["error_messages"];

            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }

        if (isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])) {
            echo $_SESSION["success_messages"];

            //Уничтожаем чтобы не появилось заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
        ?>
    </div>

<?php
//иначе выводим сообщение о том, что он уже авторизован
if (!isset($_SESSION["login"]) && !isset($_SESSION["password"])) {
    ?>


    <div id="form_auth">
        <h2>Авторизация</h2>
        <form action="auth.php" method="post" name="form_auth">

            <input type="login" placeholder="Введите логин" class="form-control" name="login" required="required"><br>
            <span id="valid_login_message" class="mesage_error"></span>

            <input type="password" class="form-control" name="password" placeholder="Введите пароль"
                   required="required"><br>
            <span id="valid_password_message" class="mesage_error"></span>

            <input type="submit" class="btn btn-primary" name="btn_submit_auth" value="Войти">

        </form>
    </div>

    <?php
} else {
    ?>

    <div id="authorized">
        <h2>Вы уже авторизованы</h2>
    </div>

    <?php
}
?>

<?php
//Подключение подвала
require_once("footer.php");
?>