<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET,'jsn');
$data = json_decode($json,true);
$id = $data['id'];
$sql = "delete from usuarios where usuid=?;";
$prp = $pdo->prepare($sql);
$prp->execute([$id]);
Conexao::desconectar();
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/dusuario.php?jsn={"id":11}
