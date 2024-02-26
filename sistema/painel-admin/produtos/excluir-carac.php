<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
// require_once('../../../conexao.php');

// $id = $_POST['id_carac'];


// $res = $pdo->prepare("DELETE from tb_carac_prod WHERE id = :id");
// $res->bindValue(":id", $id);
// $res->execute();

// echo "Excluído com Sucesso !!!";


// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$id_prod = $_POST['id_carac'];
$carac = $_POST['caract'];

if(empty($carac) or empty($id_prod)){
    echo "Selecione uma caraterística caso queira deletar!";
    exit();
}


$res = $pdo->prepare("DELETE from tb_carac_prod WHERE id_carac = :carac AND id_prod = :id");
$res->bindValue(":carac", $carac);
$res->bindValue(":id", $id_prod);
$res->execute();

echo "Excluído com Sucesso !!!";

?>