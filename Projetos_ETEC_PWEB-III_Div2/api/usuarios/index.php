<?php
require '../../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
/* jsn={"op":i,"id":"0","nome","login":"senha"}*/
$json = filter_input(INPUT_GET, 'jsn');
$data = json_decode($json, true);
$op = filter_input(INPUT_GET, 'op');/*op=i insert - op=u update - op=d delete - op=sp consulta com parametro*/
$id = filter_input(INPUT_GET, 'id');
echo $op . ' - ' . $id;
$op = $data['op'];
$id = $data['id'];
$nome = $data['nome'];
$login = $data['login'];
$senha = $data['senha'];
$logado = $data['logado0'];

switch ($op) {
    case 'i':
        $sql = "insert into usuarios (usunome,usulogin,ususenha) values (?,?,MD5(?));";

        break;
    case 'u':
        if (empty($data['senha'])) {
            $sql = "update usuarios set usunome=?,usulogin=? usulogado=? where usuid=?;";
            $prp = $pdo->prepare($sql);
            $prp->execute(array($nome, $login, $id));
        } else {
            $senha = $data['senha'];
            $sql = "update usuarios set usunome=?,usulogin=?,ususenha=MD5(?) where usuid=?;";
            $prp = $pdo->prepare($sql);
            $prp->execute(array($nome, $login, $senha, $logado, $id));
        }
        break;
    case 'd':

        break;
    case 'l':
        $json = filter_input(INPUT_GET, 'jsn');
        $data = json_decode($json, true);
        $usuario = $data['usuario'];
        $senha = $data['senha'];
        $sql = "select * from usuarios where usulogin = ? and ususenha = MD5(?);";
        $prp = $pdo->prepare($sql);
        $prp->execute([$usuario, $senha]);
        $data = $prp->fetchall(PDO::FETCH_ASSOC);
        echo json_encode($data);
        break;
    case 'sp':
       $nome = '%' . $nome. '%';
       $sql = '
       select * from usuarios;';

        break;
    default:
        echo 'DÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃÃOOOOOOOOOOOOOOOOOOO, coloca parametro certo ae';
        break;
}
