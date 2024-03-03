<?php 
require_once("../conexao.php");
@session_start();

$id_produto = $_POST['id'];
$id_cliente = @$_SESSION['id_usuario'];
$id_carrinho = @$_POST['id_carrinho'];


$query2 = $pdo->query("SELECT * FROM tb_carac_prod WHERE id_prod = '$id_produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($res2); $i++) {
    foreach ($res2[$i] as $key => $value) {
    }

    $id_carac = $res2[$i]['id_carac'];
    $id_carac_prod = $res2[$i]['id'];
    $query3 = $pdo->query("SELECT * FROM tb_carac WHERE id = '$id_carac'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $nome_carac = $res3[0]['nome'];
    if ($nome_carac == 'Cor') {
        @$tem_cor = 'Sim';
    }

    echo "<div class='mr-3 mt-2'>
        <span>
        <form id='form' method='post'>

        <input name='id_car' type='hidden' value='" . $id_carrinho . "' >
            <select class='form-control form-control-sm' name='" . $i . "' id='" . $i . "'>";
    echo "<option value=''>Selecionar " . $nome_carac . "</option>";

    $query4 = $pdo->query("SELECT * FROM tb_carac_itens WHERE id_carac_prod = '$id_carac_prod'");
    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
    for ($i2 = 0; $i2 < count($res4); $i2++) {
        foreach ($res4[$i2] as $key => $value) {
        }

        echo "<option value='" . $res4[$i2]['id'] . "'>" . $res4[$i2]['nome'] . "</option>";

    }

    echo '</select></form>
        </span>
         
    </div>';
}

$query2 = $pdo->query("SELECT * FROM tb_carac_prod WHERE id_prod = '$id_produto'");
$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
for ($i = 0; $i < count($res2); $i++) {
    foreach ($res2[$i] as $key => $value) {
    }

    $id_carac = $res2[$i]['id_carac'];
    $id_carac_prod = $res2[$i]['id'];
    $query3 = $pdo->query("SELECT * FROM tb_carac WHERE id = '$id_carac'");
    $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
    $nome_carac = $res3[0]['nome'];
    if ($nome_carac == 'Cor') {
        @$tem_cor = 'Sim';
    }

    if (@$tem_cor == 'Sim') {
        echo '<div class="mt-4">';
        $query2 = $pdo->query("SELECT * FROM tb_carac_prod WHERE id_prod = '$id_produto'");
        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
        for ($i = 0; $i < count($res2); $i++) {
            foreach ($res2[$i] as $key => $value) {
            }

            $id_carac = $res2[$i]['id_carac'];
            $id_carac_prod = $res2[$i]['id'];
            $query3 = $pdo->query("SELECT * FROM tb_carac WHERE id = '$id_carac'");
            $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
            $nome_carac = $res3[0]['nome'];

            if ($nome_carac == 'Cor') {

                $query4 = $pdo->query("SELECT * FROM tb_carac_itens WHERE id_carac_prod = '$id_carac_prod'");
                $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                for ($i2 = 0; $i2 < count($res4); $i2++) {
                    foreach ($res4[$i2] as $key => $value) {
                    }

                    echo "<small><span class='mr-3'><i class='fa fa-circle mr-1' style='color:" . $res4[$i2]['valor_item'] . "'></i>" . $res4[$i2]['nome'] . "</span></small><br>";

                }
            }
        }
    }
}
?>




<script type="text/javascript">
    $("#0").change(function () {
    	
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                    atualizarCaracCarrinho();
                   	atualizarCarrinho();
                    }
                 
            }
        })
    })

</script>



<script type="text/javascript">
    $("#1").change(function () {
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                   atualizarCaracCarrinho();
                   atualizarCarrinho();
                    }
            }
        })
    })

</script>



<script type="text/javascript">
    $("#2").change(function () {
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                   atualizarCaracCarrinho();
                   atualizarCarrinho();
                    }
                
            }
        })
    })

</script>



<script type="text/javascript">
    $("#3").change(function () {
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                   atualizarCaracCarrinho();
                   atualizarCarrinho();
                    }
                
            }
        })
    })

</script>



<script type="text/javascript">
    $("#4").change(function () {
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                   atualizarCaracCarrinho();
                   atualizarCarrinho();
                    }
            }
        })
    })

</script>



<script type="text/javascript">
    $("#5").change(function () {
    	event.preventDefault();
        
        $.ajax({
            url:"carrinho/add-carac-carrinho.php",
            method:"post",
            data: $('form').serialize(),
            dataType: "text",
            success: function(msg){
                if(msg.trim() === 'Cadastrado com Sucesso!'){
                    
                   atualizarCaracCarrinho();
                   atualizarCarrinho();
                   
                    }
                
            }
        })
    })

</script>




<!--AJAX PARA LISTAR OS DADOS -->
<script type="text/javascript">
  $(document).ready(function(){
    
    atualizarCaracCarrinho();

    })
  
</script>




<script>
function atualizarCaracCarrinho() {
  var car = "<?=$id_carrinho?>";
  console.log(car);
    $.ajax({
      url:  "carrinho/listar-carac-carrinho.php",
      method: "post",
      data: {car},
      dataType: "html",
      success: function(result){
        $('#div-listar-carac-itens').html(result)

      },
     })
}
</script>




<script>
function atualizarCarrinho() {
    $.ajax({
      url:  "carrinho/listar-carrinho.php",
      method: "post",
      data: $('#frm').serialize(),
      dataType: "html",
      success: function(result){
        $('#listar-carrinho').html(result)

      },
     })
}
</script>