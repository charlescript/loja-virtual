<?php

    require_once("../../../conexao.php"); 

    $id_combo = @$_POST['txtid']; 

    $pag = "combos";


    // AQUI APRESENTO O VALOR ESTIPULADO DO COMBO PARA O ADMINISTRADOR TER NOÇÃO E NÃO EXTRAPOLAR O VALOR
    $query0 = $pdo->query("SELECT valor FROM tb_combos where id = '" . $id_combo . "' "); 
    $res0 = $query0->fetchAll(PDO::FETCH_ASSOC);

    echo "<small> Combo estipulado:  ". $res0[0]['valor'] ."</small>  <hr><br/> ";

    
    ///////////////////////////////////////////////////////////////////////////////////////////////////////

    // LISTAR OS PRODUTOS DO COMBO
    $query = $pdo->query("SELECT * FROM tb_prod_combos where id_combo = '" . $id_combo . "' ");
    $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($res); $i++) { 
            foreach ($res[$i] as $key => $value) { }

                $id_prod = $res[$i]['id_produto'];
      
                $query2 = $pdo->query("SELECT * from tb_produtos where id = '$id_prod' ");
                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                $nome_prod = @$res2[0]['nome'];
                $imagem = $res2[0]['imagem'];
                
                // ECHO $imagem;
                
            echo "<span class='text-dark mr-1'>
                    <small>"
                       .@$nome_prod.
                    "</small>
                        <?php if (@$imagem != '') { ?>
                            <img src='../../img/produtos/$imagem' width='30 em' height='30 em'> &nbsp;/
                        <?php  }  ?>
                  </span>
                  
                  <a href='#' onClick='deletarProd(". $res[$i]['id'] .")' title='Excluir Produto'>
                  <small><i class='text-danger far fa-trash-alt'></i></small></a>
                  
                  <hr/>";

        } // FIm do FOR


    ///////////////////////////////////////////////////////////////////////////////////////////////////////


    // ABAIXO CALCULEI O VALOR TOTAL DESSE COMBO EM QUESTÃO SOMENTE NESSE MOMENTO DE EXECUÇÃO E
    // APRESENTO NO FINAL DA LISTAGEM DE PRODUTOS DESSE COMBO DANDO A POSSIBILIDADE DO ADM COMPARAR COM O VALOR ESTIPULADO ACIMA
    $query2 = $pdo->query("SELECT p.id id_p, 
                            p.valor AS valor_produto, 
                            pc.id_produto AS id_produto,
                            pc.id_combo AS id_combo
                          FROM tb_produtos p 
                          JOIN tb_prod_combos pc ON p.id = pc.id_produto
                          WHERE pc.id_combo = '".$id_combo."' ");
    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
    
    $sub_total_combo = 0;
    for($i = 0; $i < count($res2); $i++){
        foreach($res2[$i] as $key => $value) {}
        $sub_total_combo += $res2[$i]['valor_produto'];
    }

    echo "<br/><br/><small>Total de itens: R$ ". $sub_total_combo ."</small>";
    
?>
