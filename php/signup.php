<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registo</title>
</head>
<body>
    <?php
        require_once 'header.php';
        echo <<<_END
        <script>
            function chackUser(utilizador) <!-- javascript para verificar se utilizador já existe -->
            {
                if (utilizador.value == '')
                {
                    $('#used').html('$&nbsp;')
                    return
                }
                    $.post
                    {
                        'checkuser.php', { utilizador: utilizador.value },
                        function(data)
                        {
                            $('#used').html(data)
                        }
                    }
            }
        </script>
        _END;

        $error = $utilizador = $password = "";
        if (isset($_SESSION['utilizador'])) destruirSessao();
        if (isset($_POST['utilizador']))
        {
            $utilizador = ($_POST['utilizador']);
            $password = $_POST['password'];
            if ($utilizador == ''|| $utilizador == '')
            {
                $error = "Preencha todos os campos<br /><br />";
            }
            else
            {
                $result = queryMysql("SELECT * FROM membros WHERE utilizador='$utilizador'");
                if ($result -> num_rows)
                {
                    $error = "Esse nome de utilizador já existe<br /><br />";
                }
                else
                {
                    queryMysql("INSERT INTO membros VALUES('$utilizador', '$password')");
                    die("<h4>Conta Criada</h4>Por favor entre</body></html>");
                }
            }
        }
        echo <<<_END
            <form method="post" action="signup">$error
                <div data-role='fieldcontain'>
                    <label>Por favor insira os seus dados para se registar</label>
                </div>
                <div data-role='fieldcontain'>
                    <label>Nome de utilizador</label>
                    <input type='text' maxlength='16' name='utilizador' value='$utilizador' onBlur='checkUser(this)' />
                    <div id="used">&nbsp</div>
                </div>
                <div data-role='fieldcontain'>
                    <label>Password</label>
                    <input type='password' maxlength='16' name='password' value='$password' onBlur='checkUser(this)' /> <!-- mudar texto para password para ocultar a mesma -->
                </div>
                <div data-role='fieldcontain'>
                    <input data-transition='slide' type='submit' value='Registar' />
                </div>
            </form>
        _END;
    ?>
</body>
</html>