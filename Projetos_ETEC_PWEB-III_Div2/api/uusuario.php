<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET, 'jsn');
$data = json_decode($json, true);
$id = $data['id'];
$nome = $data['nome'];
$login = $data['login'];
if (empty($data['senha'])) {
    $sql = "update usuarios set usunome=?,usulogin=? where usuid=?;";
    $prp = $pdo->prepare($sql);
    $prp->execute(array($nome, $login, $id));
} else {
    $senha = $data['senha'];
    $sql = "update usuarios set usunome=?,usulogin=?,ususenha=MD5(?) where usuid=?;";
    $prp = $pdo->prepare($sql);
    $prp->execute([$nome,$login,$senha,$id]);
}
Conexao::desconectar();
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/uusuario.php?jsn={"id":6,"nome":"ENZO APARECIDO","login":"ENZO","senha":"pythonando"}