<?php // membros.php
    require_once 'header.php';
    if ($loggedin) die("</div></body></html>");
    if (isset($_GET['ver'])) {
        $ver = ($_GET['ver']);
        if ($ver == $utilizador) $nome = 'O seu';
        else $nome = "$ver";
        echo "<h3>Perfil do $nome</h3>";
        mostarPerfil(($ver));
        echo "<a data-role='button' data-transition='slide' href='mensagens.php?ver=$ver'>Ver mensagens do $nome</a>";
        die("</div></body></html>");
    }

    if (isset($_GET['adiciona'])) // adicionar como amigo na tabela
    {
        $adiciona = ($_GET['adiciona']);
        $result = queryMysql("SELECT * FROM amigos WHERE utilizador ='$adiciona' AND amigos = '$utilizador");
        if (!$result->num_rows) {
            queryMysql("INSERT INTO amigos VALUES ('$adiciona', '$utilizador')");
        } elseif (isset($_GET['remove'])) {
            $remove = ($_GET['remove']);
            queryMysql("DELETE FROM amigos WHERE utilizador='$remove AND amigos='$utilizador'");
        }
        $result = queryMysql("SELECT utilizador FROM membros ORDER BY utilizador");
        $num = $result->num_rows;
        echo "<h3>Outros membros</h3><ul>";
        for ($j = 0; $j < $num; $j++) {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($row['utilizador'] == $utilizador) continue;
            echo "<li><a data-transition='slide' href='membros.php?ver=" . $row['utilizador'] . "'>" . $row['utilizador'] . "</a></li>";
            $seguir = "seguir";
            $result1 = queryMysql("SELECT * FROM amigos WHERE utilizador ='". $row['utilizador'] ." AND amigos='$utilizador '"); // ver amigos
            $t1 = $result1->num_rows;
            $result1 = queryMysql("SELECT FROM amigos WHERE utilizador='$utilizador' AND amigo='". $row['utilizador']. "'");
        }
    }
?>