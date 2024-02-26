<?php

require_once("../../../conexao.php"); 

$id = $_POST['id_desativar'];

$pdo->query("UPDATE tb_promocao_banner SET ativo = 'Não' WHERE id = '$id'");

echo 'Desativado com Sucesso!!';

?>