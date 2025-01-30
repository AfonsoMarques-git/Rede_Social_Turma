<?php // login.php
    require_once '../php/header.php';
    $error = $utilizador = $password = "";
    if (isset($_POST['utilizador'])) {
        $utilizador = $_POST['utilizador'];
        $password = $_POST['password'];
        if ($utilizador == ''|| $utilizador == '') {
            $error = 'Não estáo preenchidos todos os campos';
        } else {
            $result = queryMysql("SELECT utilizador,password FROM membros WHERE utilizador='$utilizador' AND password = '$password'");
            if ($result -> num_rows == 0) {
                $error = "Login Inválido";
            } else {
                $_SESSION['utilizador'] = $utilizador;
                $_SESSION['utilizador'] = $password;
                die("<div class='center'>Você não está ligado. Por favor <a data-transition='slide' href='membros.php?view=$utilizador'>Clique aqui</a> para continuar.</div>");
            }
        }
    }
    echo <<<_END
        <html>
        <body>
            <form method='post' action='login.php'>
                <div data-role='fieldcontain'>
                    <label></label>
                    <span class='error'>$error</span>
                </div>
                <div data-role='fieldcontain'>
                    <label></label>
                    Por favor introduza os dados
                </div>
                <div data-role='fieldcontain'>
                    <label>Nome de utilizador</label>
                    <input type='text' maxlenght='16' name='utilizadores' value='$utilizador' />
                </div>
                <div data-role='fieldcontain'>
                    <label>Password</label>
                    <input type='password' maxlenght='16' name='password' value='$password' />
                </div>
                <div data-role='fieldcontain'>
                    <label></label>
                    <input data-transition='slide' type='submit' value='Entrar' />
                </div>
            </form>
        </body>
    </html>
    _END;
?>