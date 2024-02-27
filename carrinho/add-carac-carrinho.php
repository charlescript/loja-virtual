<?php 
require_once("../conexao.php");
@session_start();

$salvar;
$id_carac_itens = 0;

for ($i=0; $i < 6; $i++) {
	if(isset($_POST[$i]) and $_POST[$i]==""){
		$salvar = 'Não';	
	}
}



for ($i=0; $i < 6; $i++) {
	if(isset($_POST[$i]) and $_POST[$i]!=""){
		$id_carac_itens = $_POST[$i];
		$salvar = 'Sim';
	}
}



$id_carrinho = @$_POST['id_car'];

$query2 = $pdo->query("SELECT * from tb_carac_itens where id = '$id_carac_itens'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
$id_carac_prod = @$res2[0]['id_carac_prod'];
$nome_carac = @$res2[0]['nome'];

$query3 = $pdo->query("SELECT * from tb_carac_prod where id = '$id_carac_prod'");
$res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
$id_caract = @$res3[0]['id_carac'];


$query4 = $pdo->query("SELECT * from tb_carac_itens_car where id_carrinho = '$id_carrinho' and id_carac = '$id_caract'");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
$linhas = @count($res4);


if($salvar == 'Sim' and $linhas == 0){
	$pdo->query("INSERT INTO tb_carac_itens_car(id_carrinho, id_carac, nome) values ('$id_carrinho', '$id_caract', '$nome_carac')");

echo 'Cadastrado com Sucesso!';

}

if($salvar == 'Sim' and $linhas > 0){
	$pdo->query("UPDATE tb_carac_itens_car SET nome = '$nome_carac' where id_carrinho = '$id_carrinho' and id_carac = '$id_caract' ");

echo 'Cadastrado com Sucesso!';
}


 ?>