<?php

require_once("../../../conexao.php"); 

$id = $_POST['id_produto'];

$pdo->query("DELETE from tb_prod_combos WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>