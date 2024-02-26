<?php

require_once("../conexao.php");

$retira_pontuacao_cpf = array(".","-"," ","  ");

$nome =addslashes($_POST['nome']);
$cpf = addslashes(str_replace($retira_pontuacao_cpf, "", $_POST['cpf']));
$email = addslashes($_POST['email']);
$senha = $_POST['senha'];
$senha_crip = md5($senha);

//-------------------------------------------------------------------
//VERIFICA SE O CAMPO NOME ESTÁ VAZIO
if (empty($nome)) {
    echo "Preencha o campo NOME!";
    exit();
} elseif (!preg_match('/^[A-Za-z\s]+$/', $nome)) { //Isso garante que o nome contenha apenas letras e espaços em branco.
    echo "O nome deve conter apenas letras e espaços em branco.";
    exit();
} else {
    // O nome atende aos critérios, prossiga com o processamento.
}

//-------------------------------------------------------------------

    //VERIFICA SE O EMAIL ESTÁ VAZIO
    // VALIDANDO O EMAIL
    if (empty($email)) {
        echo "Preencha o campo EMAIL!";
        exit();
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "O e-mail fornecido não é válido.";
        exit();
    } else {
        // O e-mail é válido, prossiga com o processamento.
    }
 
//-------------------------------------------------------------------


// Verifica se o CPF não está vazio
if ($cpf == "") {
    echo 'CPF inválido!';
    exit();
}


//VALIDA CPF
function validarCPF($cpf) {
    // Remove caracteres não numéricos do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    // Calcula o primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += $cpf[$i] * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica se o primeiro dígito verificador está correto
    if ($cpf[9] != $digito1) {
        return false;
    }

    // Calcula o segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += $cpf[$i] * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica se o segundo dígito verificador está correto
    if ($cpf[10] != $digito2) {
        return false;
    }

    return true; // CPF válido
}

if (validarCPF($cpf)) {
    
} else {
    echo " CPF inválido!";
    exit();
}


//-------------------------------------------------------------------

//VERIFICA SE O CAMPO SENHA ESTÁ VAZIO
if (empty($senha)) {
    echo "Preencha o campo SENHA!";
    exit();
} elseif (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $senha)) {
    echo "A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.";
    exit();
} else {
    // A senha atende aos critérios, prossiga com o processamento.
}


//-------------------------------------------------------------------

// VERIFICA SE O CAMPO CONFIRMAR SENHA CORRESPONDE AO CAMPO SENHA
if($senha != $_POST['confirmar-senha']){
    echo 'Senhas não correspondentes!';
    exit();
}

//-------------------------------------------------------------------


// CASO O FORMULÁRIO NÃO CAIA EM NENHUMA VALIDAÇÃO ACIMA(é porque ocorreu tudo bem) E FAÇO A INSERÇÃO NO BANCO DE DADOS
//ENVIAR PARA O BANCO DE DADOS O CADASTRO DO USUARIO
$res = $pdo->query("SELECT * FROM tb_usuarios WHERE cpf = '$cpf' OR email = '$email' "); // VERIFICA SE JÁ EXISTE ALGUM REGISTRO COM ESSE CPF OU EMAIL
$dados = $res->fetchAll(PDO::FETCH_ASSOC); // CONTABILIZA O NUMERO DE REGISTROS RETORNADOS NA CONSULTA ACIMA

if(@count($dados) == 0) { // CASO NÃO HAJA REGISTRO DE RETORNO, É PORQUE NÃO HÁ CPF IGUAL AO QUE ESTÁ SENDO TRATADO NESSE TEMPO DE EXECUÇÃO
                         // ENTÃO PODEMOS INSERIR ESSES DADOS NA TABELA POIS O CPF NÃO É REPETIDO
    $res = $pdo->prepare("INSERT INTO tb_usuarios (nome, cpf, email, senha, senha_crip, nivel, dt_cadastro)
    VALUES (:nome, :cpf, :email, :senha, :senha_crip, :nivel, NOW())" );
        $res->bindValue(":nome" , $nome );
        $res->bindValue(":cpf" , $cpf );
        $res->bindValue(":email", $email);
        $res->bindValue(":senha", $senha);
        $res->bindValue(":senha_crip", $senha_crip);
        $res->bindValue(":nivel", "Cliente");
        $res->execute();


    
    $res = $pdo->prepare("INSERT INTO tb_clientes (nome, cpf, email) VALUES (:nome, :cpf, :email)" );
        $res->bindValue(":nome" , $nome );
        $res->bindValue(":cpf" ,  $cpf) ;
        $res->bindValue(":email", $email );
        $res->execute();
    

    $res = $pdo->query("SELECT * FROM tb_emails WHERE email = '$email' ");
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);
    if(@count($dados) == 0){ // VALIDA NOVAMENTE SE NÃO HÁ EMAIL IGUAL NA TABELA TB_EMAILS PORQUE, EXISTE OUTRA FORMA DE INSERÇÃO
                             // ALÉM DESSA AQUI(em "contatos.php" -> "enviar.php"), O QUE PODERIA CAUSAr AMBIGUIDADE
        $res = $pdo->prepare("INSERT INTO tb_emails (nome, email, ativo) VALUES (:nome, :email, :ativo)" );
        $res->bindValue(":nome" , $nome);
        $res->bindValue(":email", $email);
        $res->bindValue(":ativo", "Sim");
        $res->execute();

    } 
    echo 'Cadastrado com Sucesso!';

}// CASO O CPF OU EMAIL JÁ ESTEJA CADASTRADOS NA BASE DE DADOS, PULA DIRETO PARA O ELSE RETORNANDO A MENSAGEM ABAIXO
 else {
    echo 'CPF ou EMAIL já está cadastrado no sistema!';
}

?>