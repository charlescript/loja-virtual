<?php

require_once("../../../conexao.php");

$titulo_alerta = $_POST['titulo-alerta'];
$titulo_mensagem = $_POST['titulo-mensagem'];
$mensagem = $_POST['mensagem-alerta'];
$data = $_POST['data'];
$link = $_POST['link-promo'];


$id = $_POST['txtid2'];

if ($titulo_alerta == "") {
	echo 'Preencha o Campo Titulo Alerta!';
	exit();
}



//SCRIPT PARA SUBIR FOTO NO BANCO
$caminho = '../../../img/alertas/' . @$_FILES['imagem']['name'];
if (@$_FILES['imagem']['name'] == "") {
	$imagem = "sem-foto.jpg";
} else {
	$imagem = @$_FILES['imagem']['name'];
}

$imagem_temp = @$_FILES['imagem']['tmp_name'];

$ext = pathinfo($imagem, PATHINFO_EXTENSION);
if ($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif') {
	move_uploaded_file($imagem_temp, $caminho);
} else {
	echo 'Extensão de Imagem não permitida!';
	exit();
}


if ($id == "") {
	$res = $pdo->prepare("INSERT INTO tb_alertas (titulo_alerta, titulo_mensagem, mensagem, link, imagem, data, ativo) VALUES (:titulo_alerta, :titulo_mensagem, :mensagem, :link, :imagem, :data, :ativo)");
	$res->bindValue(":imagem", $imagem);
	$res->bindValue(":ativo", 'Não');
} else {

	if ($imagem == "sem-foto.jpg") {
		$res = $pdo->prepare("UPDATE tb_alertas SET titulo_alerta = :titulo_alerta, titulo_mensagem = :titulo_mensagem, mensagem = :mensagem, link = :link, data = :data WHERE id = :id");
	} else {
		$res = $pdo->prepare("UPDATE tb_alertas SET titulo_alerta = :titulo_alerta, titulo_mensagem = :titulo_mensagem, mensagem = :mensagem, link = :link, data = :data, imagem = :imagem WHERE id = :id");
		$res->bindValue(":imagem", $imagem);
	}

	$res->bindValue(":id", $id);
}

$res->bindValue(":titulo_alerta", $titulo_alerta);
$res->bindValue(":titulo_mensagem", $titulo_mensagem);
$res->bindValue(":link", $link);
$res->bindValue(":mensagem", $mensagem);
$res->bindValue(":data", $data);

$res->execute();


echo 'Salvo com Sucesso!!';
