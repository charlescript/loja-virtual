<?php

require_once("../../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from tb_alertas WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>