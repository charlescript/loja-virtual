<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM tb_produtos where tipo_envio = '" . $id . "' ");
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if(count($result) > 0) {
    echo 'VOCÊ NÃO PODE DELETAR ESSE TIPO DE ENVIO, POIS UM OU MAIS PRODUTOS UTILIZAM ESSE MÉTODO DE ENVIO!!!';
    exit();
}

$res = $pdo->prepare("DELETE from tb_tipo_envios WHERE id = :id");
$res->bindValue(":id", $id);
$res->execute();

echo 'Excluído com Sucesso !!!';

?>