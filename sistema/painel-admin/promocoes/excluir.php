<?php

require_once("../../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from tb_promocao_banner WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>