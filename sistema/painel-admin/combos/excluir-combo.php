<?php

require_once("../../../conexao.php"); 

$id = $_POST['id'];

$pdo->query("DELETE from tb_prod_combos WHERE id_combo = $id");
$pdo->query("DELETE from tb_combos WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>