<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM tb_sub_categorias where id_categoria = '" . $id . "' ");
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if(count($result) > 0) {
    echo 'VOCÊ NÃO PODE DELETAR ESSA CATEGORIA POIS EXISTEM SUB-CATEGORIAS QUE SÃO DEPENDENTES DELA!!!';
    exit();
}

$res = $pdo->prepare("DELETE from tb_categorias WHERE id = :id");
$res->bindValue(":id", $id);
$res->execute();

echo 'Excluído com Sucesso !!!';

?>