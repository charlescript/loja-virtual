<?php

require_once("../../../conexao.php"); 

$id = $_POST['id_ativar'];

$query = $pdo->query("SELECT * FROM tb_promocao_banner where ativo = 'Sim' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) >= 2){
	echo 'Você não pode Ter mais que duas Promoções Ativas!!';
	exit();
}

$pdo->query("UPDATE tb_promocao_banner SET ativo = 'Sim' WHERE id = '$id'");

echo 'Ativado com Sucesso!!';

?>