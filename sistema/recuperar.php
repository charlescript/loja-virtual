<?php

    require_once('../conexao.php');
    require_once('../config.php');
    

    $email = $_POST['email-recuperar'];

    if($email == ""){
        echo "Preencha o campo Email!";
        exit();
    }

    // $res = $pdo->query("SELECT * FROM tb_usuarios WHERE email = '$email' ");
    $query = ("SELECT * FROM tb_usuarios WHERE email = :email");
    $res = $pdo->prepare($query);
    $res->bindValue(":email", $email);
    $res->execute();
   
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
   
    if(@count($dados) > 0){
        $senha = $dados[0]['senha'];

        // ENVIAR O EMAIL COM A SENHA
        $destinatario = $email;
        $assunto = $nome_loja . ' - Recupere sua senha!';
        $mensagem = utf8_decode("Sua senha: $senha");
        $cabecalhos = "From: ".$email_loja;
        mail($destinatario, $assunto, $mensagem, $cabecalhos);

        echo 'Senha Enviada para o Email!';
    } else {
        echo 'Este email não foi identificado!';
    }

?>