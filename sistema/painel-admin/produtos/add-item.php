<?php

require_once("../../../conexao.php"); 

$nome_item = $_POST['nome-item'];
$valor_item= $_POST['valor-item'];
$id_carac_prod = $_POST['id_carac_item'];

    if($nome_item == ""){
        echo 'Digite uma descrição para o item!';
        exit();
    }


	$res = $pdo->query("SELECT * FROM tb_carac_itens where nome = '$nome_item' and id_carac_prod = '$id_carac_prod' "); 
	$dados = $res->fetchAll(PDO::FETCH_ASSOC);
	if(@count($dados) > 0){
		echo 'Item para esta caracteristica já cadastrado!';
		exit();
	}

$pdo->query("INSERT INTO tb_carac_itens (id_carac_prod, nome, valor_item) VALUES ('$id_carac_prod', '$nome_item', '$valor_item')");


echo 'Salvo com Sucesso!!';

?>