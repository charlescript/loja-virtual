<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$id = $_POST['id'];

$res = $pdo->prepare("DELETE from tb_carac WHERE id = :id");
$res->bindValue(":id", $id);
$res->execute();

echo 'Excluído com Sucesso !!!';

?>