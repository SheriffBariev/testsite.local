<?php
    require_once("header.php");
?>
<!-- Блок для вывода сообщений -->
<div class="block_for_messages">
    <?php
        //Если в сессии существуют сообщения об ошибках, то выводим их
        if(isset($_SESSION["error_messages"]) && !empty($_SESSION["error_messages"])){
            echo $_SESSION["error_messages"];
 
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["error_messages"]);
        }
 
        //Если в сессии существуют радостные сообщения, то выводим их
        if(isset($_SESSION["success_messages"]) && !empty($_SESSION["success_messages"])){
            echo $_SESSION["success_messages"];
             
            //Уничтожаем чтобы не выводились заново при обновлении страницы
            unset($_SESSION["success_messages"]);
        }
    ?>
</div>
 
<?php
    if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){
?>
        <div id="form_register">
            <br>
            <h3 align="center">Заполните заявку</h3>
            <br>
            <form action="register.php" role="form" class="form-signin" method="post">
                <label for="LastName" class="control-label">Фамилия:</label>
                <input type="LastName" required="required" class="form-control" name="LastName">
                <label for="FirstName" class="control-label">Имя:</label>
                <input type="FirstName" required="required" class="form-control" name="FirstName">
                <label for="MiddleName" class="control-label">Отчество:</label>
                <input type="MiddleName" required="required" class="form-control" name="MiddleName">
                <label for="Age" class="control-label">Возраст:</label>
                <input type="Age" required="required" class="form-control" name="Age">
                <label for="Address" class="control-label">Адрес:</label>
                <input type="Address" class="form-control" required="required" name="Address">
                <label for="email" class="control-label">Эл. почта:</label>
                <input type="email" class="form-control" required="required" name="email">
                <label for="phonenumber" class="control-label">Моб. телефон:</label>
                <input type="phonenumber" class="form-control" required="required" name="phonenumber"><br>
                <button type="submit" value="OK" name="btn_submit_register" class="btn btn-primary">Отправить заявку</button>
            </form>
<!--            <form action="register.php" method="post" name="form_register">-->
<!--                <table>-->
<!--                    <tbody><tr>-->
<!--                        <td> Имя: </td>-->
<!--                        <td>-->
<!--                            <input type="text" name="first_name" required="required">-->
<!--                        </td>-->
<!--                    </tr>-->
<!-- -->
<!--                    <tr>-->
<!--                        <td> Фамилия: </td>-->
<!--                        <td>-->
<!--                            <input type="text" name="last_name" required="required">-->
<!--                        </td>-->
<!--                    </tr>-->
<!--              -->
<!--                    <tr>-->
<!--                        <td> Email: </td>-->
<!--                        <td>-->
<!--                            <input type="email" name="email" required="required"><br>-->
<!--                            <span id="valid_email_message" class="mesage_error"></span>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--              -->
<!--                    <tr>-->
<!--                        <td> Пароль: </td>-->
<!--                        <td>-->
<!--                            <input type="password" name="password" placeholder="минимум 6 символов" required="required"><br>-->
<!--                            <span id="valid_password_message" class="mesage_error"></span>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td> Введите капчу: </td>-->
<!--                        <td>-->
<!--                            <p>-->
<!--                                <img src="captcha.php" alt="Капча" /> <br><br>-->
<!--                                <input type="text" name="captcha" placeholder="Проверочный код" required="required">-->
<!--                            </p>-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                    <tr>-->
<!--                        <td colspan="2">-->
<!--                            <input type="submit" name="btn_submit_register" value="Зарегистрироватся!">-->
<!--                        </td>-->
<!--                    </tr>-->
<!--                </tbody></table>-->
<!--            </form>-->
        </div>
<?php
    }else{
?>
        <div id="authorized">
            <h2>Вы уже зарегистрированы</h2>
        </div>
<?php
    }
     
    //Подключение подвала
    require_once("footer.php");
?>