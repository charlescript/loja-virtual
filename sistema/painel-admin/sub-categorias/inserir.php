<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

$nome = $_POST['nome-cat'];
$id_cat = $_POST['categoria'];

$nome_novo = strtolower( preg_replace("[^a-zA-Z0-9-]", "-", 
        strtr(utf8_decode(trim($nome)), utf8_decode("áàãâéêíóôõúüñçÁÀÃÂÉÊÍÓÔÕÚÜÑÇ"),
        "aaaaeeiooouuncAAAAEEIOOOUUNC-")) );
        
$nome_url = preg_replace('/[ -]+/' , '-' , $nome_novo);

$antigo = $_POST['antigo'];
$id = $_POST['txtid2'];



if($nome == ""){
    echo "Preencha o Campo Nome!";
    exit();
}

if ($nome != $antigo) {
    $res = $pdo->prepare("SELECT * FROM tb_sub_categorias WHERE nome = :nome");
    $res->bindValue(":nome", $nome);
    $res->execute();
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if (@count($dados) > 0) {
        echo ' SubCategoria já cadastrada no Banco de Dados!';
        exit();
    }
}

//SCRIPT PARA SUBIR FOTO NO BANCO-----------------------------------------
$nome_img = preg_replace('/[ -]+/' , '-' , @$_FILES['imagem']['name']);
$caminho = '../../../img/sub-categorias/' .$nome_img;
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
//SCRIPT PARA SUBIR FOTO NO BANCO-----------------------------------------


if($id == ""){
	$res = $pdo->prepare("INSERT INTO tb_sub_categorias (nome, nome_url, imagem, id_categoria) VALUES (:nome, :nome_url, :imagem, :id_categoria)");
	$res->bindValue(":imagem", $imagem);
  
}else{

	if($imagem == "sem-foto.jpg"){
		$res = $pdo->prepare("UPDATE tb_sub_categorias SET nome = :nome, nome_url = :nome_url, id_categoria = :id_categoria WHERE id = :id");
	}else{
		$res = $pdo->prepare("UPDATE tb_sub_categorias SET nome = :nome, nome_url = :nome_url, imagem = :imagem, id_categoria = :id_categoria WHERE id = :id");
		$res->bindValue(":imagem", $imagem);
	}

	$res->bindValue(":id", $id);
}

	$res->bindValue(":nome", $nome);
	$res->bindValue(":nome_url", $nome_url);
  $res->bindValue(":id_categoria", $id_cat);
	$res->execute();


echo 'Salvo com Sucesso !!!';

?>