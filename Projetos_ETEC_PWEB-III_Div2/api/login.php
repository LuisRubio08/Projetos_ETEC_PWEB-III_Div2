<?php
require '../app/conexao.php';
$pdo = Conexao::conectar();
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$json = filter_input(INPUT_GET,'jsn');
$data = json_decode($json,true);
$usuario = $data['usuario'];
$senha = $data['senha'];
$sql = "
select 
    usuid as id,
	usunome as nome,
	usulogin as usuario,
	usulogado as logado
from 
    usuarios
where 
]   usulogin = ? 
and 
    ususenha = MD5(?);";
$prp = $pdo->prepare($sql);
$prp->execute([$usuario,$senha]);
$data = $prp->fetchall(PDO::FETCH_ASSOC);
echo json_encode($data);
//http://localhost/Projetos_ETEC_PWEB-III_Div2/api/login.php?jsn={"usuario":"XANDAO","senha":"123456"}