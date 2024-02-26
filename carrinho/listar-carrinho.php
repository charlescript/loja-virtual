<?php 

require_once("../conexao.php");
$pagina = 'produtos';
@session_start();
$id_usuario = @$_SESSION['id_usuario'];

echo '<div class="cart-inline-header"> 
        <div class="shoping__cart__table">
            <table>';

$res = $pdo->query("SELECT * from tb_carrinho where id_usuario = '$id_usuario' and id_venda = 0 order by id asc");
$dados = $res->fetchAll(PDO::FETCH_ASSOC);
$linhas = count($dados);

if($linhas == 0){
    $linhas = 0;
    $total = 0;
}

$total;
for ($i=0; $i < count($dados); $i++) { 
    foreach ($dados[$i] as $key => $value) {
    }

    $id_produto = $dados[$i]['id_produto'];    
    $quantidade = $dados[$i]['quantidade'];
    $id_carrinho = $dados[$i]['id'];
    $combo = $dados[$i]['combo'];

    if($combo == 'Sim'){
        $res_p = $pdo->query("SELECT * from tb_combos where id = '$id_produto' ");
    }else{
        $res_p = $pdo->query("SELECT * from tb_produtos where id = '$id_produto' ");
    }

    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);
    $nome_produto = $dados_p[0]['nome'];

    if($combo == 'Sim'){ 
        $promocao = ""; 
        $pasta = "combos";
    }else{
        $promocao = $dados_p[0]['promocao']; 
        $pasta = "produtos";
    }


    if($promocao == 'Sim'){
        $queryp = $pdo->query("SELECT * FROM tb_promocoes where id_produto = '$id_produto' ");
        $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
        $valor = $resp[0]['valor'];

    }else{
        $valor = $dados_p[0]['valor'];
    }


    $imagem = $dados_p[0]['imagem'];

    $total_item = $valor * $quantidade;
    @$total = @$total + $total_item;

    $valor = number_format( $valor , 2, ',', '.');
    $total_item = number_format( $total_item , 2, ',', '.');

    echo '<tr>
            <td class="shoping__cart__item">
                <img src="img/'.$pasta.'/'.$imagem.'" alt="" width="60">
                <h5><a class="text-dark mr-1" href="" title="Editar Características de '.$nome_produto.'" onclick="addCarac('.$id_produto.', '.$id_carrinho.')">'.$nome_produto.'
                &nbsp;<i class="fa fa-edit text-info"></i></a>
                </h5>
            </td> 
            <td width="150" class="shoping__cart__item">
                <span class="mt-4 d-none d-sm-none d-md-block" id="div-listar-carac-itens-2">';

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

    echo '</span> 
            </td>
            <td class="shoping__cart__quantity ">
                <b>R$ '.$total_item.'</b>
            </td> 
            <td class="shoping__cart__quantity">
                <div class="quantity">
                    <div class="pro-qty">
                        <input onchange="editarCarrinho('.$id_carrinho.')" type="text" data-zeros="true" value="'.$quantidade.'" min="1" max="1000" id="quantidade">
                    </div>
                </div>
            </td>
            <td class="shoping__cart__item__close">
                <a onclick="deletarCarrinho('.$id_carrinho.')" id="btn-deletar" href="" class="ml-2" title="Remover Item do Carrinho">
                    <span class="icon_trash"> <!-- <img src="./img/delete-icon.png" width="20px"> --> </span>
                </a>
            </td>
        </tr>';
}

echo '</table>  
        </div>
    </div>';

@$total = number_format(@$total, 2, ',', '.');

?>

<!--SCRIPT PARA ALTERAR O INPUT NUMBER DO CARRINHO DE COMPRAS -->
<script type="text/javascript">
  jQuery('<span class="dec qtybtn">-</span>').insertBefore('.pro-qty input'); 
  jQuery('<span class="inc qtybtn">+</span>').insertAfter('.pro-qty input'); 
  jQuery('.pro-qty').each(function() {
    var spinner = jQuery(this),
    input = spinner.find('input[type="text"]'),
    btnUp = spinner.find('.inc'),
    btnDown = spinner.find('.dec'),
    min = input.attr('min'),
    max = input.attr('max');

    btnUp.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue >= max) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue + 1;
      }
      spinner.find("input").val(newVal);
      document.getElementById('txtquantidade').value = newVal;
      spinner.find("input").trigger("change");
    });

    btnDown.click(function() {
      var oldValue = parseFloat(input.val());
      if (oldValue <= min) {
        var newVal = oldValue;
      } else {
        var newVal = oldValue - 1;
      }
      spinner.find("input").val(newVal);
      document.getElementById('txtquantidade').value = newVal;
      spinner.find("input").trigger("change");
    });
  });
</script>

<script type="text/javascript">
  var itens = "<?=$linhas?>";
  var total = "<?=$total?>";

  $("#total_itens").text(itens);
  $("#valor_total").text(total);
</script>