<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once("../../../conexao.php");

$nome = $_POST['nome-prod'];
@$id_cat = $_POST['categoria'];
@$id_sub_cat = $_POST['sub-categoria'];
$descricao = $_POST['descricao'];
$descricao_longa = $_POST['descricao_longa'];
$valor = $_POST['valor'];
// $imagem = $_POST['imagem'];
$estoque = $_POST['estoque'];
$tipo_envio = $_POST['tipo_envio'];
$ativo = $_POST['ativo'];
$palavras = $_POST['palavras'];
$peso = $_POST['peso'];
$largura = $_POST['largura'];
$altura = $_POST['altura'];
$comprimento = $_POST['comprimento'];
$modelo = $_POST['modelo'];
$valor_frete = $_POST['valor-frete'];

$valor = str_replace(',', '.', $valor);
$valor_frete = str_replace(',', '.', $valor_frete);
$peso = str_replace(',', '.', $peso);
$largura = str_replace(',', '.', $largura);
$altura = str_replace(',', '.', $altura);
$comprimento = str_replace(',', '.', $comprimento);

$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );   
$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);

$antigo = $_POST['antigo_prod'];
$id = $_POST['txtid2'];




function validarCampoVazio($valor, $mensagem) {
  if (empty($valor)) {
    echo $mensagem;
    exit();
  }
}


function validarCampoNumerico($valor, $mensagem) {
  if (!is_numeric($valor) || empty($valor)) {
    echo $mensagem;
    exit();
  }
}

validarCampoVazio($nome, "Preencha o Campo Nome do Produto!");
validarCampoVazio($id_cat, "Categoria Inválida! Selecione uma categoria!");
// validarCampoVazio($id_sub_cat, "Sub-Categoria Inválida!");
validarCampoVazio($descricao, "Preencha a descrição do produto!");
validarCampoVazio($descricao_longa, "Preencha a descrição Longa do produto!");

validarCampoNumerico($valor, "Preencha o valor do produto com um número!");
validarCampoNumerico($estoque, "Preencha a quantidade desse produto em estoque com um número!");
validarCampoVazio($palavras, "Preencha ao menos uma palavra chave para o produto!");

validarCampoNumerico($peso, "Preencha o peso em gramas do produto com número!");
validarCampoNumerico($largura, "Preencha a largura em centímetros do produto com número!");
validarCampoNumerico($altura, "Preencha a altura em centímetros do produto com número!");
validarCampoNumerico($comprimento, "Preencha o comprimento em centímetros do produto com número!");


// VERIFICA SE JÁ EXISTE ESSE NOME CADASTRADO PARA PRODUTO
if ($nome != $antigo) {
  $res = $pdo->prepare("SELECT * FROM tb_produtos WHERE nome = :nome");
  $res->bindValue(":nome", $nome);
  $res->execute();
  $dados = $res->fetchAll(PDO::FETCH_ASSOC);

  if (@count($dados) > 0) {
      echo ' Produto já cadastrado no Banco de Dados!';
      exit();
  }
}
//---------------------------------------------------------

//SCRIPT PARA SUBIR FOTO NO BANCO
$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
$caminho = '../../../img/produtos/' .$nome_img;
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
//-------------------------------------------------------------


if($id == ""){
	$res = $pdo->prepare("INSERT INTO tb_produtos (categoria, sub_categoria, nome, nome_url, descricao, descricao_longa, valor, imagem, estoque, tipo_envio, palavras, ativo, peso, largura, altura, comprimento, modelo, valor_frete) 
  VALUES (:categoria, :sub_categoria, :nome, :nome_url, :descricao, :descricao_longa, :valor, :imagem, :estoque, :tipo_envio, :palavras, :ativo, :peso, :largura, :altura, :comprimento, :modelo, :valor_frete)");
	 $res->bindValue(":imagem", $imagem);
  
}else{

	if($imagem == "sem-foto.jpg"){
		$res = $pdo->prepare("UPDATE tb_produtos SET categoria = :categoria, sub_categoria = :sub_categoria, nome = :nome, nome_url = :nome_url, 
                          descricao = :descricao, descricao_longa = :descricao_longa, valor = :valor, estoque = :estoque, tipo_envio = :tipo_envio, palavras = :palavras, 
                          ativo = :ativo, peso = :peso, largura = :largura, altura =:altura, comprimento = :comprimento, modelo = :modelo, valor_frete = :valor_frete
                           WHERE id = :id");
	}else{
		$res = $pdo->prepare("UPDATE tb_produtos SET categoria = :categoria, sub_categoria = :sub_categoria, nome = :nome, nome_url = :nome_url, 
    descricao = :descricao, descricao_longa = :descricao_longa, valor = :valor, imagem = :imagem, estoque = :estoque, tipo_envio = :tipo_envio, palavras = :palavras, 
    ativo = :ativo, peso = :peso, largura = :largura, altura =:altura, comprimento = :comprimento, modelo = :modelo, valor_frete = :valor_frete
     WHERE id = :id");
		$res->bindValue(":imagem", $imagem);
	}

	$res->bindValue(":id", $id);
}

$res->bindValue(":categoria", $id_cat);
$res->bindValue(":sub_categoria", $id_sub_cat);
$res->bindValue(":nome", $nome);
$res->bindValue(":nome_url", $nome_url);
$res->bindValue(":descricao", $descricao);
$res->bindValue(":descricao_longa", $descricao_longa);
$res->bindValue(":valor", $valor);
$res->bindValue(":estoque", $estoque);
$res->bindValue(":tipo_envio", $tipo_envio);
$res->bindValue(":palavras", $palavras);
$res->bindValue(":ativo", $ativo);
$res->bindValue(":peso", $peso);
$res->bindValue(":largura", $largura);
$res->bindValue(":altura", $altura);
$res->bindValue(":comprimento", $comprimento);
$res->bindValue(":modelo", $modelo);
$res->bindValue(":valor_frete", $valor_frete);

$res->execute();


echo 'Salvo com Sucesso !!!';

?>