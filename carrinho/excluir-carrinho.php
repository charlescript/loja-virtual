<?php 
require_once("../conexao.php");
@session_start();

$id = $_POST['id'];

$pdo->query("DELETE FROM tb_carac_itens_car where id_carrinho = '$id'");
$pdo->query("DELETE FROM tb_carrinho where id = '$id'");

echo "Excluido com Sucesso!!";

?>