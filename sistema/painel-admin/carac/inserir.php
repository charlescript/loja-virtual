<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$nome = $_POST['nome-carac'];
        
$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];



if($nome == ""){
    echo "Preencha o Campo com o nome da Caracteristica!";
    exit();
}

if ($nome != $antigo) {
    $res = $pdo->prepare("SELECT * FROM tb_carac WHERE nome = :nome");
    $res->bindValue(":nome", $nome);
    $res->execute();
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if (@count($dados) > 0) {
        echo 'Caracteristica já cadastrada!';
        exit();
    }
}


if($id == ""){
	$res = $pdo->prepare("INSERT INTO tb_carac (nome) VALUES (:nome)");
}else{

	$res = $pdo->prepare("UPDATE tb_carac SET nome = :nome WHERE id = :id");
	$res->bindValue(":id", $id);
}

	$res->bindValue(":nome", $nome);
  
	$res->execute();


echo 'Salvo com Sucesso !!!';

?>