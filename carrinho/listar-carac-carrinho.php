<?php 

require_once("../conexao.php");

$id_carrinho = @$_POST['car'];

$query4 = $pdo->query("SELECT * from tb_carac_itens_car where id_carrinho = '$id_carrinho'");
$res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
for ($i2=0; $i2 < count($res4); $i2++) { 
    foreach ($res4[$i2] as $key => $value) {
    }

    $nome_item_carac = $res4[$i2]['nome'];
    $id_carac = $res4[$i2]['id_carac'];

    $query1 = $pdo->query("SELECT * from tb_carac where id = '$id_carac' ");
    $res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
    $nome_carac = $res1[0]['nome'];


    echo '<small><span class="mr-2"><i class="mr-1 fa fa-check text-info"></i>'.$nome_carac.' : '.$nome_item_carac.'</span></small><br>';

}

?>