<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET, 'jsn');
$data = json_decode($json, true);
$id = $data['id'];
$nome = $data['nome'];
$sql = "update categorias set catnome=? where catid=?;";
$prp = $pdo->prepare($sql);
$prp->execute([$nome, $id]);
Conexao::desconectar();
