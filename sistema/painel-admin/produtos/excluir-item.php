<?php

require_once("../../../conexao.php"); 

$id = $_POST['id_item_carac'];

$pdo->query("DELETE FROM tb_carac_itens WHERE id = '$id'");

echo 'Excluído com Sucesso!!';

?>