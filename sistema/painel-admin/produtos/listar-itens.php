<?php

require_once("../../../conexao.php"); 

$id_carac_prod = @$_POST['id_carac_item_2']; 

$pag = "produtos";

$query = $pdo->query("SELECT * FROM tb_carac_itens WHERE id_carac_prod = '" . $id_carac_prod . "' ");
   
    echo "<div class='ml-2'>";
        $res = $query->fetchAll(PDO::FETCH_ASSOC);

        for ($i=0; $i < count($res); $i++) { 
            foreach ($res[$i] as $key => $value) { }
          
            echo "<span class='mb-2'>
                <i class='text-secondary fas fa-check mr-1'></i>
                <big><big> ".$res[$i]['nome']."</big></big> 
                <a title='Deletar Item ". $res[$i]['nome'] ." (". $res[$i]['valor_item'] .")' href='#' 
                    onClick='deletarItem(". $res[$i]['id'] .")'>
                    <i class='text-danger fas fa-times ml-1'></i>
                </a></span><br>";
        }

    echo "</div>";
?>
