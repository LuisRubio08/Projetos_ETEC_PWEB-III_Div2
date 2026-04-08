<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET, 'jsn');
$data = json_decode($json, true);
$nome = $data['nome'];
$sql = "
insert into categorias (catnome)
values (?);";
$prp = $pdo->prepare($sql);
$prp->execute([$nome]);
Conexao::desconectar();