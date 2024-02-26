<?php 

require_once("../conexao.php");
@session_start();


$id = $_POST['id'];
$quantidade = $_POST['quantidade'];

$pdo->query("UPDATE tb_carrinho SET quantidade = '$quantidade' where id = '$id'");

echo "Editado com Sucesso!!";

?>