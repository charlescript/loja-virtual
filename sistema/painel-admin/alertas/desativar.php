<?php

require_once("../../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("UPDATE tb_alertas SET ativo = 'Não' WHERE id = '$id'");

echo 'Desativado com Sucesso!!';

?>