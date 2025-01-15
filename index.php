<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
</head>
<body>
    <?php // index.php
        session_start();
        require_once 'header.php';
        echo "<div class='center'> Bem-Vindo a gpsi22,";
        if ($loggedin) echo "4utilizador, você está ligado.";
        else echo('por favor registe-se ou entre.');
        echo <<<_END
        </div><br />
        </div>
        <div data-role="footer">
            <h4 class='center'><i><a href='http://www.epb.pt' target='_blank'>Rede Social da turma de gpsi22</a></i></h4>
        </div>
_END;
    ?>
</body>
</html>