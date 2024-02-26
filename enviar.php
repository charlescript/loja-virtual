<?php

require_once('conexao.php');

//---------------------------------------------------------------------------------------
//VERIFICAÇÃO DE ENTRADA DE DADOS

if($_POST['nome'] == ""){
    echo 'PREENCHA O CAMPO NOME!';
    exit();
}

if($_POST['email'] == ""){
    echo 'PREENCHA O CAMPO EMAIL!';
    exit();
}

if($_POST['mensagem'] == ""){
    echo 'PREENCHA O CAMPO MENSAGEM!';
    exit();
}

//---------------------------------------------------------------------------------------



//---------------------------------------------------------------------------------------
//VERIFICA SE EMAIL TEM DOMINIO GMAIL, POIS REQUER AUTENTICAÇÃO SMTP

// Verifique o domínio do e-mail se for GMAIL negarei envio, para que o cliente logue pelo email dele por conta do SMTP
$emailParts = explode('@', $_POST['email']);
$dominio = end($emailParts);

if ($dominio === 'gmail.com') {

    //ENVIAR PARA O BANCO DE DADOS O EMAIL E NOME DOS CAMPOS se, e somente se esse email não estiver na base de dados
    $res = $pdo->query("SELECT * FROM tb_emails WHERE email = '$_POST[email]' ");
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    if(@count($dados) == 0){
        $res = $pdo->prepare("INSERT INTO tb_emails (nome, email, ativo) VALUES (:nome, :email, :ativo)" );
        $res->bindValue(":nome" , $_POST['nome']);
        $res->bindValue(":email", $_POST['email']);
        $res->bindValue(":ativo", "Sim");
        $res->execute();
    } 

    // Nesse caso como o dominio é GMAIL não é possivel enviar sem autenticação SMTP, logo apresenta essa mensagem e retorna
    // essa mensagem abaixo, resultando no ajax de "contatos.php" o redirecionamento para a autenticação na aplicação do GMAIL no host do cliente
    echo 'Dominio de email do GMAIL nao sao permitidos por esse PAINEL pois precisam estar logados';
    exit();
}

//---------------------------------------------------------------------------------------



//---------------------------------------------------------------------------------------
// SE TUDO OCORREU BEM ACIMA O EMAIL DO CLIENTE É PREPARADO COM ESSA VARIAVEL $MENSAGEM
$destinatario = $gmail_loja;
$assunto = $nome_loja . ' - Email da loja';
$mensagem = utf8_decode('Nome: '.$_POST['nome']. "\r\n"."\r\n" . 
                        'Telefone: '.$_POST['telefone']. "\r\n"."\r\n" .
                        'Mensagem: ' . "\r\n"."\r\n" .$_POST['mensagem']);

$remetente = $_POST['email'];
$cabecalhos = "From: ".$remetente;
mail($destinatario, $assunto, $mensagem, $cabecalhos);

echo 'Enviado com Sucesso!';
//---------------------------------------------------------------------------------------



//---------------------------------------------------------------------------------------
// AQUI É FEITA A COLETA DE EMAILS DO USUÁRIO PARA NOSSA BASE DE DADOS PARA FUTUROS EMAIL MARKETING

//ENVIAR PARA O BANCO DE DADOS O EMAIL E NOME DOS CAMPOS se, e somente se esse email não estiver na base de dados
//guardando a busca dentro da variavel result
$res = $pdo->query("SELECT * FROM tb_emails WHERE email = '$_POST[email]' ");

// Extrair a quantidade de retornos provindos na variavel result
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
if(@count($dados) == 0){
    $res = $pdo->prepare("INSERT INTO tb_emails (nome, email, ativo) VALUES (:nome, :email, :ativo)" );
    $res->bindValue(":nome" , $_POST['nome']);
    $res->bindValue(":email", $_POST['email']);
    $res->bindValue(":ativo", "Sim");
    $res->execute();
} 

//---------------------------------------------------------------------------------------




?>