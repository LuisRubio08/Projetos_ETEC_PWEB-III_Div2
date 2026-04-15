<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET,'jsn');
$data = json_decode($json,true);
$nome = $data['nome'];
$login = $data['login'];
$senha = $data['senha'];
$sql = "insert into usuarios (usunome,usulogin,ususenha) values (?,?,MD5(?));";
$prp = $pdo->prepare($sql);
$prp->execute(array($nome,$login,$senha));
Conexao::desconectar();
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/iusuario.php?jsn={"nome":"ENZO APARECIDO","login":"ENZO","senha":"pythonando"}
