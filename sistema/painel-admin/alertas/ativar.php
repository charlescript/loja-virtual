<?php

require_once("../../../conexao.php"); 

$id = $_POST['id'];
$data = $_POST['data'];



$query = $pdo->query("SELECT * FROM tb_alertas where ativo = 'Sim' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($res) >= 1){
	echo 'Você não pode Ter mais de um alerta Ativo!!';
	exit();
}

// if($agora >= $data){
// 	echo "Data e hora deve ser posterior ao atual momento: $agora";
// }

$pdo->query("UPDATE tb_alertas SET ativo = 'Sim' WHERE id = '$id'");

echo 'Ativado com Sucesso!!';

?>