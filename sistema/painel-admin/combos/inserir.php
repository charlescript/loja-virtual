<?php

require_once("../../../conexao.php");

function formatarNumero($valor) {
    return str_replace(',', '.', $valor);
}

function formatarNome($nome) {
    $nome = strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"), "aaaaeeiooouuncAAAAEEIOOOUUNC-");
    $nome = preg_replace("/[^a-zA-Z0-9-]/", "-", $nome);
    $nome = preg_replace('/[ -]+/', '-', $nome);
    return strtolower($nome);
}

$nome = $_POST['nome-cat'];
$descricao = $_POST['descricao'];
$descricao_longa = $_POST['descricao_longa'];
$valor = formatarNumero($_POST['valor']);
$tipo_envio = $_POST['tipo_envio'];
$ativo = $_POST['ativo'];
$palavras = $_POST['palavras'];
$peso = $_POST['peso'];
$largura = $_POST['largura'];
$altura = $_POST['altura'];
$comprimento = $_POST['comprimento'];
$valor_frete = $_POST['valor-frete'];

$nome_url = formatarNome($nome);

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];

function validarCampoPreenchido($campo, $mensagem) {
    if (empty($campo)) {
        echo $mensagem;
        exit();
    }
}

function validarNumero($numero, $mensagem) {
    if (!is_numeric($numero)) {
        echo $mensagem;
        exit();
    }
}

validarCampoPreenchido($nome, 'Preencha o Campo <b><u>Nome</u></b>!');
validarCampoPreenchido($valor, 'Preencha o Campo <b><u>Valor</u></b>!');
validarNumero($valor, 'O Campo <b><u>Valor</u></b> deve conter apenas números!');
validarNumero($peso, 'Verifique se o campo <b><u>Peso</u></b> está preenchido, e deve conter apenas números e/ou . ');
validarNumero($largura, 'Verifique se o campo <b><u>Largura</u></b> está preenchido e deve conter apenas números com ou sem pontos!');
validarNumero($altura, 'Verifique se o campo <b><u>Altura</u></b> está preenchido e deve conter apenas números com ou sem pontos !');
validarNumero($comprimento, 'Verifique se o campo <b><u>Comprimento</u></b> está preenchido e deve conter apenas números com ou sem pontos !');
//validarNumero($valor_frete, 'Verifique se o campo do <b><u>Frete</u></b> está preenchido e deve conter apenas números com ou sem pontos!');



//SCRIPT PARA SUBIR FOTO NO BANCO --------------------------------------------------
$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
$caminho = '../../../img/combos/' .$nome_img;
if (@$_FILES['imagem']['name'] == ""){
    $imagem = "sem-foto.jpg";
  }else{
    $imagem = $nome_img;
  }

$imagem_temp = @$_FILES['imagem']['tmp_name']; 

$ext = pathinfo($imagem, PATHINFO_EXTENSION);   
if($ext == 'png' or $ext == 'jpg' or $ext == 'jpeg' or $ext == 'gif'){ 
move_uploaded_file($imagem_temp, $caminho);
}else{
	echo 'Extensão de Imagem não permitida!';
	exit();
}
// -----------------------------------------------------------------------------


if($id == ""){
	$res = $pdo->prepare("INSERT INTO tb_combos 
                          (nome, nome_url, descricao, descricao_longa, valor, imagem, tipo_envio, palavras, ativo, peso, largura, altura, comprimento, valor_frete) 
                   VALUES (:nome, :nome_url, :descricao, :descricao_longa, :valor, :imagem,  :tipo_envio, :palavras, :ativo, :peso, :largura, :altura, :comprimento,  :valor_frete)");
	                 $res->bindValue(":imagem", $imagem);
}else{

	if($imagem == "sem-foto.jpg"){
		$res = $pdo->prepare("UPDATE tb_combos SET nome = :nome, nome_url = :nome_url, descricao = :descricao, descricao_longa = :descricao_longa, valor = :valor,  tipo_envio = :tipo_envio, palavras = :palavras, ativo = :ativo, peso = :peso, largura = :largura, altura = :altura, comprimento = :comprimento, valor_frete = :valor_frete WHERE id = :id");
	}else{
		$res = $pdo->prepare("UPDATE tb_combos SET nome = :nome, nome_url = :nome_url,descricao = :descricao,descricao_longa = :descricao_longa,valor = :valor, tipo_envio = :tipo_envio,palavras = :palavras,ativo = :ativo,peso = :peso, largura = :largura, altura = :altura, comprimento = :comprimento, valor_frete = :valor_frete, imagem = :imagem WHERE id = :id");
		$res->bindValue(":imagem", $imagem);
	}

	$res->bindValue(":id", $id);
}

	$res->bindValue(":nome", $nome);
	$res->bindValue(":nome_url", $nome_url);
	$res->bindValue(":descricao", $descricao);
	$res->bindValue(":descricao_longa", $descricao_longa);
	$res->bindValue(":valor", $valor);
	$res->bindValue(":tipo_envio", $tipo_envio);
	$res->bindValue(":palavras", $palavras);
	$res->bindValue(":ativo", $ativo);
	$res->bindValue(":peso", $peso);
	$res->bindValue(":largura", $largura);
	$res->bindValue(":altura", $altura);
	$res->bindValue(":comprimento", $comprimento);
	
	$res->bindValue(":valor_frete", $valor_frete);
	$res->execute();


echo 'Salvo com Sucesso!!';


?>


