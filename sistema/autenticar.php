<?php
    require_once('../conexao.php');
    @session_start();

    $email = $_POST['email_login'];
    $senha = md5($_POST['senha_login']);

    //  Usei uma consulta preparada para proteger contra SQL Injection
    $query = "SELECT * FROM tb_usuarios WHERE (email = :email OR cpf = :email) AND senha_crip = :senha"; 
    $res = $pdo->prepare($query);
    $res->bindValue(":email", $email);
    $res->bindValue(":senha", $senha);
    $res->execute();
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if(@count($dados) > 0){
        $_SESSION['id_usuario'] = $dados[0]['id'];
        $_SESSION['nome_usuario'] = $dados[0]['nome'];
        $_SESSION['email_usuario'] = $dados[0]['email'];
        $_SESSION['cpf_usuario'] = $dados[0]['cpf'];
        $_SESSION['senha_crip'] = $dados[0]['senha_crip'];
        $_SESSION['nivel_usuario'] = $dados[0]['nivel'];
        
        if($_SESSION['nivel_usuario'] == 'Admin'){
            echo "<script language='javascript'> window.location='painel-admin' </script> ";
        }

        if($_SESSION['nivel_usuario'] == 'Cliente'){
            echo "<script language='javascript'> window.location='../' </script> ";
        }
    
    } else {
        echo "<script language='javascript'> window.alert('Dados Incorretos!') </script> ";
        echo "<script language='javascript'> window.location='index.php' </script> ";
    } 

?>