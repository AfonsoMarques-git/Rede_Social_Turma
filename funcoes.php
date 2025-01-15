<?php // funcoes.php
	
	$dbhost = 'localhost';
	$dbname = 'gpsi22';
	$dbuser = 'afonsomarques';
	$dbpass = 'password123';

	// Correção na ordem dos parâmetros
	$ligacao = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
	
	if ($ligacao->connect_error) {
		die("Erro fatal na ligação: " . $ligacao->connect_error);
	}
	
	// função para criar tabela
	function createTable($nome, $query) {
		queryMysql("CREATE TABLE IF NOT EXISTS $nome($query)");
		echo "A tabela '$nome' foi criada ou já existe.<br>";
	}
	
	// função para criar query
	function queryMysql($query) {
		global $ligacao;
		$result = $ligacao->query($query);
		if (!$result) die("Erro fatal na consulta: " . $ligacao->error);
		return $result;
	}
	
	// função para destruir sessão e limpar dados no logout
	function destruirSessao() {
		$_SESSION = array(); // Limpa todas as variáveis de sessão
		if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
		}
		session_destroy();
	}
	
	// função para mostrar imagem e apresentação do utilizador
	function mostarPerfil($utilizador) {
		if (file_exists("$utilizador.jpg"))
			echo "<img src='$utilizador.jpg' style='float:left;'>";
		
		$result = queryMysql("SELECT * FROM perfis WHERE utilizador ='$utilizador'");
		if ($result->num_rows) {
			$row = $result->fetch_array(MYSQLI_ASSOC);
			echo stripcslashes($row['texto']) . "<br style='clear:left;'></br>";
		} else {
			echo "<p> Ainda não há dados.</p><br>";
		}
	}
?>
