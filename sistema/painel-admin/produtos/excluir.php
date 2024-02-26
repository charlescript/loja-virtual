<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$id = $_POST['id'];

// QUANDO HÁ UMA DELEÇÃO DE PRODUTO PRECISO FAZER UMA SEQUÊNCIA DE DELETES PARA MANTER A INTEGRIDADE NO BANCO DE DADOS
// OU SEJA DELETO EM CASCATA IMAGENS, ITENS DE CARACTERISTICAS, E CARACTERISTICAS RELACIONADAS AQUELE PRODUTO...
$query1 = $pdo->prepare("DELETE from tb_imagens WHERE id_produto = :id");  
$query2 = $pdo->prepare("DELETE FROM tb_carac_itens WHERE id_carac_prod IN (SELECT id FROM tb_carac_prod WHERE id_prod = :id)");
$query3 = $pdo->prepare("DELETE FROM tb_carac_prod WHERE id_prod = :id");
$query4 = $pdo->prepare("DELETE FROM tb_prod_combos WHERE id_produto = :id");
$query5 = $pdo->prepare("DELETE FROM tb_promocoes WHERE id_produto = :id");
$query6 = $pdo->prepare("DELETE from tb_produtos WHERE id = :id");


$query1->bindValue(":id", $id);
$query2->bindValue(":id", $id);
$query3->bindValue(":id", $id);
$query4->bindValue(":id", $id);
$query5->bindValue(":id", $id);
$query6->bindValue(":id", $id);

$query1->execute();
$query2->execute();
$query3->execute();
$query4->execute();
$query5->execute();
$query6->execute();

echo 'Excluído com Sucesso !!!';

?>