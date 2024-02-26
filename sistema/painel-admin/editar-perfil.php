<?php
// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../config.php');
require_once('../../conexao.php');
//-----------------------------------------------------------------------------------

// RECUPERANDO VALORES PROVINDOS DE "painel-admin/index.php" 
$retira_pontuacao_cpf = array(".", "-", " ", "  ");

$nome = $_POST['nome-usuario'];
$email = $_POST['email-usuario'];
$cpf = addslashes(str_replace($retira_pontuacao_cpf, "", $_POST['cpf-usuario']));
$senha = $_POST['senha'];
$senha_crip = MD5($senha);
$conf_senha = $_POST['conf-senha'];
  
$nova_senha = $_POST['senha-nova'];
$nova_senha_crip = MD5($nova_senha);
$conf_nova_senha = $_POST['conf-senha-nova'];

$antigo = $_POST['antigo_user'];
$id_usuario = $_POST['txtid'];

//-----------------------------------------------------------------------------------

//VERIFICA SE O CAMPO NOME ESTÁ VAZIO
if (empty($nome)) {
    echo "</br> Preencha o campo NOME!";
    exit();
} elseif (!preg_match('/^[A-Za-z\s]+$/', $nome)) {
    echo "O nome deve conter apenas letras e espaços em branco.";
    exit();
} else {
    // O nome atende aos critérios, prossiga com o processamento.
}

//-----------------------------------------------------------------------------------

if (empty($cpf)) {
    echo "</br> Preecha o campo CPF !";
    exit();
}

//VALIDAÇÃO DE CPF
function validarCPF($cpf)
{
    // Remove caracteres não numéricos do CPF
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF possui 11 dígitos
    if (strlen($cpf) != 11) {
        return false;
    }

    switch($cpf){
        case "00000000000":
            return false;
        break;

        case "11111111111":
            return false;
        break;

        case "22222222222":
            return false;
        break;

        case "33333333333":
            return false;
        break;

        case "44444444444":
            return false;
        break;

        case "55555555555":
            return false;
        break;

        case "66666666666":
            return false;
        break;

        case "77777777777":
            return false;
        break;

        case "88888888888":
            return false;
        break;

        case "99999999999":
            return false;
        break;
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
    echo "</br> CPF inválido!";
    exit();
}
//-----------------------------------------------------------------------------------

// VALIDANDO O EMAIL
if (empty($email)) {
    echo "</br> Preencha o campo EMAIL!";
} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "</br> O e-mail fornecido não é válido.";
} else {
    // O e-mail é válido, prossiga com o processamento.
}

//-----------------------------------------------------------------------------------

//VERIFICA SE O CAMPO SENHA ESTÁ VAZIO
if (empty($senha)) {
    echo "</br> Preencha o campo SENHA!";
    exit();
} 

//-----------------------------------------------------------------------------------

// VERIFICA SE A SENHA ATUAL COINCIDEM
if ($senha != $conf_senha) {
    echo "</br> Senhas não correspondem! ";
    exit();
}

//VERIFICA SE A NOVA SENHA COINCIDE
if($nova_senha != $conf_nova_senha){
    echo "</br> No campo de nova senha, elas não coincidem!";
    exit();
}

//-----------------------------------------------------------------------------------
// VERIFICA SE O CPF INSERIDO JÁ EXISTE NO BANCO DE DADOS
if ($cpf != $antigo) {
    $res = $pdo->prepare("SELECT * FROM tb_usuarios WHERE cpf = :cpf");
    $res->bindValue(":cpf", $cpf);
    $res->execute();
    $dados = $res->fetchAll(PDO::FETCH_ASSOC);

    if (@count($dados) > 0) {
        echo '</br> CPF já cadastrado no Banco!';
        exit();
    }
}

////////////////////////////////////////////////////////////////////////////////////

//CASO TENHA PASSADO PELAS 9 VALIDAÇÕES ACIMA SEM CAIR EM NENHUMA
//INICIAMOS O PROCESSO DE EDIÇÃO DE DADOS MEDIANTE O FORNECIMENTO DA ATUAL SENHA
// OU SEJA SOMENTE EM POSSE DA SENHA ATUAL SERÁ POSSIVEL FAZER ALTERAÇÕES

$query = $pdo->prepare("SELECT senha, senha_crip from tb_usuarios where id = :id");
$query->bindValue(":id", $id_usuario);
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);

if(@count($result) == 1) {

    if(@$result[0]['senha'] == $senha  AND @$result[0]['senha_crip'] == $senha_crip) {
        // $res = $pdo->prepare("UPDATE tb_usuarios SET nome = :nome, cpf = :cpf, email = :email, senha = :senha, senha_crip = :senha_crip WHERE id = :id");
        $res = $pdo->prepare("UPDATE tb_usuarios SET nome = :nome, cpf = :cpf, email = :email WHERE id = :id");
        $res->bindValue(":nome", $nome);
        $res->bindValue(":cpf", $cpf);
        $res->bindValue(":email", $email);
        $res->bindValue(":id", $id_usuario);
        $res->execute();

        // CASO O USUÁRIO QUEIRA ATUALIZAR MUDAR A SENHA, SERÁ PERMITIDO SOMENTE 
        // COM AS REGRAS ABAIXO, COM MAIUSCULAS MINUSCULAS E NUMEROS
        if(!empty($nova_senha)){
            if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/", $nova_senha)) {
                echo "</br> A NOVA senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número.";
                exit();
            } 
            else {
                $res = $pdo->prepare("UPDATE tb_usuarios SET senha = :senha, senha_crip = :senha_crip WHERE id = :id");
                $res->bindValue(":senha", $nova_senha);
                $res->bindValue(":senha_crip", $nova_senha_crip);
                $res->bindValue(":id", $id_usuario);
                $res->execute();

                echo "</br> Senha atualizada";
                @session_start();
                @session_destroy();
            }
        }
        echo "<script language='text/javascript'> 
            setTimeout(function() {
                window.location.href='index.php';
            }, 1500); // 1500 milissegundos (1.5 segundos)
            </script>";

        echo "<br>Salvo com Sucesso!";
    } else {
        echo "</br> Senha fornecida incorreta!";
    }

} 