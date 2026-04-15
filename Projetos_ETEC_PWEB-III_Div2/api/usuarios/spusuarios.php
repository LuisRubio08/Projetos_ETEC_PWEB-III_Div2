<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET,'jsn');
$data = json_decode($json,true);
$nome = '%'.$data['nome'].'%';
$sql = "select * from usuarios where usunome like ?;";
$prp = $pdo->prepare($sql);
$prp->execute(array($nome));
$data = $prp->fetchall(PDO::FETCH_ASSOC);
echo json_encode($data);