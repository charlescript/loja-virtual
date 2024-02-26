<?php


require_once("../../../conexao.php");
// DADOS RECEBIDOS DE alguns forms html -> sistema/painel-admin/produtos.php
$desconto = $_POST['valor-promocao'];
$data_ini = $_POST['data-inicial-promocao'];
$data_fin = $_POST['data-final-promocao'];
$ativo = $_POST['ativo-promocao'];
$id_produto = $_POST['id-promocao'];
//--------------------------------------------------

// VALIDA ENTRADA DE PORCENTAGEM PARA EVITAR VAZIO
if ($desconto == "") {
    echo 'Insira um Valor em % para descontar do produto!';
    exit();
}

// Remover caracteres não numéricos --------------------------------------------
// VALIDA ENTRADA DE PORCENTAGEM PARA EVITAR CARACTERES MALICIOSOS OU ERROS
$desconto = preg_replace("/[^0-9%]/", "", $desconto);
$desconto = filter_var($desconto, FILTER_SANITIZE_NUMBER_INT); // RETIRA ESPAÇOS E CARACTERES ENTRANDO APENAS NUMEROS

// Validar o valor
$desconto = filter_var($desconto, FILTER_VALIDATE_INT);

if ($desconto === false || $desconto < 0 || $desconto > 100) {
    echo 'Insira um valor válido entre 0% e 100%!';
    exit();
}
//---------------------------------------------------------------------------


// CALCULA O DESCONTO-------------------------------------------------------
$res = $pdo->query("SELECT valor FROM tb_produtos where id = '$id_produto' "); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$valor = $dados[0]['valor'];
$valor = $valor - ($valor * ($desconto / 100));
// Formatando a variável $valor com 2 dígitos após a vírgula
$valor_formatado = number_format($valor, 2, ',', '.');


//-------------------------------------------------------


// Converter as datas no formato 'Y-m-d' em objetos DateTime
$data_ini = new DateTime($data_ini);
$data_fin = new DateTime($data_fin);
$data_atual = new DateTime();  // Obtém a data atual

// Verificar se as datas são válidas
if ($data_ini > $data_fin) {
    echo "A data final deve ser posterior à data inicial!";
    exit();
}
//-------------------------------------------------------


$res = $pdo->query("SELECT * FROM tb_promocoes where id_produto = '$id_produto' "); 
$dados = $res->fetchAll(PDO::FETCH_ASSOC);

try {
    $pdo->beginTransaction();

    if (count($dados) == 0) {
        $pdo->query("INSERT INTO tb_promocoes (id_produto, valor, data_inicio, data_final, ativo, desconto) 
                     VALUES ('$id_produto', '$valor', '{$data_ini->format('Y-m-d H:i')}', '{$data_fin->format('Y-m-d H:i')}', '$ativo', '$desconto')");

        $pdo->query("UPDATE tb_produtos SET promocao = '$ativo' WHERE id = '$id_produto'");

    } else {
        // $pdo->query("UPDATE tb_promocoes SET 
        //                     id_produto = '$id_produto', 
        //                     valor = '$valor', 
        //                     data_inicio = '{$data_ini->format('Y-m-d H:i')}', 
        //                     data_final = '{$data_fin->format('Y-m-d H:i')}', 
        //                     ativo = '$ativo',
        //                     desconto = '$desconto'
        //             WHERE id_produto = '$id_produto'");

        // $pdo->query("UPDATE tb_produtos SET promocao = '$ativo' WHERE id = '$id_produto'");

        //----------------------------------------------------------------------------------------------------------------
        // ESSE UPDATE ABAIXO ATUALIZA A TABELA PROMOCOES E PRODUTOS HABILITANDO A PROMOÇÃO DO PRODUTO EM AMBAS AS TABELAS.
        $pdo->query("UPDATE tb_promocoes AS prom
        JOIN tb_produtos AS prod ON prom.id_produto = prod.id
        SET 
            prom.id_produto = '$id_produto',
            prom.valor = '$valor',
            prom.data_inicio = '{$data_ini->format('Y-m-d H:i')}',
            prom.data_final = '{$data_fin->format('Y-m-d H:i')}',
            prom.ativo = '$ativo',
            prom.desconto = '$desconto',
            prod.promocao = '$ativo'
        WHERE 
            prom.id_produto = '$id_produto' ");
        //----------------------------------------------------------------------------------------------------------------

    }

    $pdo->commit();
   
    echo "Salvo com Sucesso!!";
} catch (PDOException $e) {
    $pdo->rollBack();
    echo "Erro: " . $e->getMessage();
}



?>