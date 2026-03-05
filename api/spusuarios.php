<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$jsn = $_GET['jsn'];//{"nome":"valor"}
$data2 = json_decode($jsn,true);
$nome = $data2['nome'];
$sql = "select * from usuarios where usunome like '%?%';";
$prp = $pdo->prepare($sql);
$prp->execute(array($nome));
$data = $prp->fetchall(PDO::FETCH_ASSOC);
echo json_encode($data);