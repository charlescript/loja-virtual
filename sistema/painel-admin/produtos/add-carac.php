<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$carac = $_POST['caract'];  // id da caracteristica
$id = $_POST['id'];  // id produto

// COM AS DUAS INFORMAÇÕES ACIMA PODEREI FAZER O INSERT NA 
// TABELA DE RESOLUÇÃO  "TB_CARAC_PROD" AMARRANDO O RELACIONAMENTO MUITOS PARA MUITOS ENTRE TB_PRODUTOS E TB_CARAC



if($carac == ""){
    echo "Escolha ao menos uma característica!";
    exit();
}


    $res = $pdo->prepare("SELECT * FROM tb_carac_prod WHERE id_carac = :carac AND id_prod = :id");
    $res->bindValue(":carac", $carac);
    $res->bindValue(":id", $id);
    $res->execute();
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if (@count($dados) > 0) {
        echo "Característica já cadastrada!";
        exit();
    }


	$res = $pdo->prepare("INSERT INTO tb_carac_prod (id_carac, id_prod) VALUES (:carac, :id)");
	$res->bindValue(":carac", $carac);
    $res->bindValue(":id", $id);
	$res->execute();


echo 'Característica salva com Sucesso!';


?>