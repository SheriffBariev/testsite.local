<?php
require("header.php");
//Добавляем файл подключения к БД
require_once("dbconnect.php");
$stmt = $pdo->query("SELECT * FROM requests ORDER BY ID DESC");
?>
<?php if(!isset($_SESSION["login"]) && !isset($_SESSION["password"])){ ?>
    <div class="alert alert-danger" role="alert">
        У вас не доступа к этой странице!
    </div>
<?php } else {?>
    <div class="container">
        <h3 align="center">Редактирование заявок</h3>
        <div class="table-responsive">
            <table id="employee_data" class="table table-striped table-bordered">
                <thead>
                <tr>
                    <td width="5%">ID</td>
                    <td width="10%">Фамилия</td>
                    <td width="8%">Имя</td>
                    <td width="8%">Отчество</td>
                    <td width="5%">Возраст</td>
                    <td width="20%">Адрес</td>
                    <td widht="22%">Эл. Почта</td>
                    <td width="14%">Моб. телефон</td>
                    <td width="6%">Действие</td>
                </tr>
                </thead>
                <?php
                while ($row = $stmt->fetch()) {
                    echo '
                               <tr>
                                    <td class="id">' . $row['ID'] . '</td>
                                    <td class="LastName">' . $row["LastName"] . '</td>
                                    <td class="FirstName">' . $row["FirstName"] . '</td>
                                    <td class="MiddleName">' . $row["MiddleName"] . '</td>
                                    <td class="Age">' . $row["Age"] . '</td>
                                    <td class="Address">' . $row["Address"] . '</td>
                                    <td class="email">' . $row["email"] . '</td>
                                    <td class="phonenumber">' . $row["phonenumber"] . '</td>
                                    <td align = "center"><button type="button" name="login" id="login" class="btn btn-success edit" data-toggle="modal" data-target="#loginModal">
                                      <i class="glyphicon glyphicon-pencil" >&times;</i>
                                    </button></td>
                               </tr>
                               ';
                }
                ?>
            </table>
        </div>
    </div>
    <div class="modal fade" id="loginModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title">Личные данные участника
                        <button class="close" type="button" data-dismiss="modal">
                            <i class="fa fa-close" style="font-size: 40px;">&times;</i>
                        </button>
                    </h3>
                </div>
                <div class="modal-body">
                    <form role="form" action="update.php" class="form-signin" method="POST">
                        <input type="hidden" name="id" id="id">
                        <label for="LastName" class="control-label">Фамилия</label>
                        <input name="LastName" type="text" id="LastName" class="form-control" placeholder="">
                        <label for="FirstName" class="control-label">Имя</label>
                        <input name="FirstName" type="text" id="FirstName" class="form-control" placeholder="">
                        <label for="MiddleName" class="control-label">Отчество</label>
                        <input name="MiddleName" type="text" id="MiddleName" class="form-control" placeholder="">
                        <label for="Age" class="control-label">Возраст</label>
                        <input name="Age" type="text" id="Age" class="form-control" placeholder="">
                        <label for="Address" class="control-label">Адрес</label>
                        <input name="Address" type="text" id="Address" class="form-control" placeholder="">
                        <label for="email" class="control-label">Эл. Почта</label>
                        <input name="email" type="text" id="email" class="form-control" placeholder="">
                        <label for="phonenumber" class="control-label">Моб. телефон</label>
                        <input name="phonenumber" type="text" id="phonenumber" class="form-control" placeholder="">
                        <div class="modal-footer">
                            <br>
                            <button type="submit" name="save" id="save" class="btn btn-success">Сохранить изменения
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#employee_data').DataTable();
        });
        var $editRow = null;

        $(".edit").click(function (e) {
            $editRow = $(this).closest("tr");

            $("#id").val($editRow.data('user-id'));
            $("#id").val($editRow.find('.id').text());
            $("#LastName").val($editRow.find(".LastName").text());
            $("#FirstName").val($editRow.find(".FirstName").text());
            $("#MiddleName").val($editRow.find(".MiddleName").text());
            $("#Age").val($editRow.find(".Age").text());
            $("#Address").val($editRow.find(".Address").text());
            $("#email").val($editRow.find(".email").text());
            $("#phonenumber").val($editRow.find(".phonenumber").text());
        });


        $("#save").click(function () {
            $editRow.find(".LastName").text($("#LastName").val());
            $(this).closest('.modal').modal('hide');


        });
    </script>
    <?php }?>
<?php
//Подключение подвала
require_once("footer.php");
?>