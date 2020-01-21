<footer class="white_bg">
    <div class="container">
        <div class="row">

            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">

                <p>Copyright © 2018-2020 Бариев Аюп. Все права защищены!</p>
            </div>
        </div>
    </div>
</footer>


<script>
    $(document).ready(function(){
        $('#login_button').click(function(){
            var username = $('#username').val();
            var password = $('#password').val();
            if(username != '' && password != '')
            {
                $.ajax({
                    url:"auth.php",
                    method:"POST",
                    data: {username:username, password:password},
                    success:function(data)
                    {
                        //alert(data);
                        if(data == 'No')
                        {
                            alert("Пожалуйста, проверьте правильность написания логина и пароля.");
                        }
                        else
                        {
                            location.reload();
                            window.location = "index.php";
                        }
                    }
                });
            }
            else
            {
                alert("Оба поля обязательны для заполнения.");
            }
        });
        $('#logout').click(function(){
            var action = "logout";
            $.ajax({
                url:"auth.php",
                method:"POST",
                data:{action:action},
                success:function()
                {
                    location.reload();
                }
            });
        });
    });
</script>
</body>
</html>