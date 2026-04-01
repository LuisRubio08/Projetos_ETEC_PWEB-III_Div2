<?php
require '../app/conexao.php';

$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET, 'jsn');
$data = json_decode($json, true);
$id = $data['id'];
$sql = "DELETE FROM usuarios WHERE usu_id = ?";
$prp = $pdo->prepare($sql);
$prp->execute([$id]);
Conexao::desconectar();
?>