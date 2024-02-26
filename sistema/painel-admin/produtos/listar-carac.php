<?php

// INCLUINDO VARIAVEIS GLOBAIS E CONEXÃO AO BANCO
require_once('../../../conexao.php');

// $id_prod = @$_POST['txtid'];
$id_prod = @$_POST['id']; 

$pag = "produtos";


///////////////////////////////////////////////////////////////////////////////////////////////
// MODO OTIMIZADO ABAIXO POIS NECESSITA DE APENAS UMA QUERY PARA BUSCAR OS REGISTROS
// NO MODELO ABAIXO BASTA UMA QUERY COM JOINS
    $query = $pdo->query("SELECT 
                        p.id AS produto_id,
                        p.nome AS produto_nome,
                        c.id AS caracteristica_id,
                        c.nome AS caracteristica_nome,
                        cp.id AS id_carac_prod
                    FROM tb_produtos p
                    JOIN tb_carac_prod cp ON p.id = cp.id_prod
                    JOIN tb_carac c ON cp.id_carac = c.id
                    WHERE p.id = '" . $id_prod . "' ");

    echo "<div class='ml-2'>";
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($res); $i++) { 
            foreach ($res[$i] as $key => $value) {}

            
            $nome_carac = $res[$i]['caracteristica_nome'];

            echo "<span class='mb-2'> 
                    <small><small><small> 
                        <i class='text-primary fas fa-check-circle mr-1 '></i> 
                    </small></small></small>
                    <a class='text-info' title='Adicionar item a característica' href='#' onClick='addItem(".$res[$i]['id_carac_prod'].")'>"
                        // .$res[$i]['id_carac_prod']. '--'  //Debugando para verificar o código da tabela de resolução tb_carac_prod
                        . $nome_carac ."
                    </a>
                </span></br>";
        }

        if(!empty($nome_carac)){ // Se não houver caracteristicas vou omitir o icone e link de deleção
            echo "<hr/><a href='#' title='Para deletar, selecione uma característica e clique na lixeira!' 
                    onClick='deletarCarac(".$id_prod.")'>
                    <h6><i class='text-danger fas fa-trash-alt ml-1 mb-1 mt-10'></i></h6>  
                </a> ";
        }
                    
    echo "</div>";

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////

// $query = $pdo->query("SELECT * FROM tb_carac_prod where id_prod = '" . $id_prod . "' ");
//     echo "<div class='ml-2'>";
//         $res = $query->fetchAll(PDO::FETCH_ASSOC);

//         for ($i=0; $i < count($res); $i++) { 
//             foreach ($res[$i] as $key => $value) {}

//             $id_carac = $res[$i]['id_carac'];
//             //Recuperar o nome da caracteristica
//             $query2 = $pdo->query("SELECT * FROM tb_carac WHERE id = '" .$id_carac. "' ");
//             $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
//             $nome_carac = $res2[0]['nome'];

//             echo "<span class='mb-7'>". $nome_carac ."
//                     <a href='#' onClick='deletarCarac(". $res[$i]['id'] .")'>
//                         <i class='text-danger fas fa-times ml-1'></i>
//                     </a>
//                 </span></br>";
//         }
//     echo "</div>";

///////////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////////////////////////


// O MODELO ABAIXO FUNCIONA PORÉM ELE DELETA O PRODUTO QUE ESTIVER NA COMBOBOX INDEPENDENTE DE QUAL ICONE VOCÊ CLICAR
// POR ISSO NÃO IMPLEMENTEI ELE


    // $query = $pdo->query("SELECT 
    // p.id AS produto_id,
    // p.nome AS produto_nome,
    // c.id AS caracteristica_id,
    // c.nome AS caracteristica_nome
    // FROM tb_produtos p
    // JOIN tb_carac_prod cp ON p.id = cp.id_prod
    // JOIN tb_carac c ON cp.id_carac = c.id
    // WHERE p.id = '" . $id_prod . "' ");

    // echo "<div class='ml-2'>";
    // $res = $query->fetchAll(PDO::FETCH_ASSOC);

    // for ($i=0; $i < count($res); $i++) { 
    // foreach ($res[$i] as $key => $value) {}


    // $nome_carac = $res[$i]['caracteristica_nome'];

    // echo "<span class='mb-7'> <small><small><small> <i class='text-primary fas fa-circle mr-1 '></i> </small></small></small>"
    // . $nome_carac ."
    // <a href='#' onClick='deletarCarac(". $res[$i]['produto_id'] .")'>
    //       <small><small> <i class='text-danger fas fa-times ml-1 mb-1'></i> </small></small>
    //  </a>
    // </span></br>";
    // }

   

    // echo "</div>";
?>


