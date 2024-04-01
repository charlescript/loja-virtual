<?php 
    require_once("../conexao.php");

    @session_start();

    if(@$_SESSION['id_usuario'] != null) {

        $id_produto = $_POST['idproduto'];
        $id_cliente = @$_SESSION['id_usuario'];
        $combo = $_POST['combo'];

        $pdo->query("INSERT INTO tb_carrinho(id_usuario, id_produto, quantidade, id_venda, data, combo) 
                        values('$id_cliente', '$id_produto', '1', '0', curDate(), '$combo' )");

        //echo $combo;
        echo 'Cadastrado com Sucesso!!';
    } 

    
?>