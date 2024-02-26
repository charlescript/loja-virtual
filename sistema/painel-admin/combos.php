<?php
$pag = "combos";
require_once("../../conexao.php");
@session_start();
//verificar se o usuário está autenticado
if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Admin') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}


?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Combo</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Produtos no Combo</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM tb_combos order by id desc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $nome = $res[$i]['nome'];
                        $valor = $res[$i]['valor'];
                        $imagem = $res[$i]['imagem'];
                        $ativo = $res[$i]['ativo'];
                        $id = $res[$i]['id'];
                        $valor = number_format($valor, 2, ',', '.');

                        $query2 = $pdo->query("SELECT * FROM tb_prod_combos where id_combo = '$id' ");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $total_produtos = @count($res2);

                        $classe = "";
                        if ($ativo == "Sim") {
                            $classe = "fas fa-check-square text-success";
                        } else {
                            $classe = "fas fa-check-square text-secondary";
                        }


                    ?>


                        <tr>
                            <td>
                                <i class=' <?php echo $classe ?>'></i>

                                <a href="index.php?pag=<?php echo $pag ?>&funcao=produtos&id=<?php echo $id ?>" class="text-info">
                                    <?php echo $nome ?>
                                </a>

                            </td>
                            <td>
                                R$ <?php echo $valor ?>
                            </td>

                            <td>
                                <?php echo $total_produtos ?>
                            </td>

                            <td>
                                <img src="../../img/combos/<?php echo $imagem ?>" width="50">
                            </td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>

        </div>
    </div>
</div>





<!-- Modal -->
<div class="modal fade" id="modalDados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM tb_combos where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $nome2 = $res[0]['nome'];
                    $imagem2 = $res[0]['imagem'];
                    $valor2 = $res[0]['valor'];
                    $descricao2 = $res[0]['descricao'];
                    $desc_longa2 = $res[0]['descricao_longa'];
                    $tipo_envio2 = $res[0]['tipo_envio'];
                    $palavras2 = $res[0]['palavras'];
                    $ativo2 = $res[0]['ativo'];
                    $peso2 = $res[0]['peso'];
                    $largura2 = $res[0]['largura'];
                    $altura2 = $res[0]['altura'];
                    $comprimento2 = $res[0]['comprimento'];
                    $valor_frete2 = $res[0]['valor_frete'];
                } else {
                    $titulo = "Inserir Registro de Combo";
                }


                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" method="POST">
                <div class="modal-body">

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nome</label>
                                <input value="<?php echo @$nome2 ?>" type="text" class="form-control form-control-sm" id="nome-cat" name="nome-cat" placeholder="Nome">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Valor</label>
                                <input value="<?php echo @$valor2 ?>" type="text" class="form-control form-control-sm" id="valor" name="valor" placeholder="Valor">
                            </div>
                        </div>



                        <div class="col-md-3">

                            <div class="form-group">
                                <label>Tipo Envio</label>
                                <select class="form-control form-control-sm" name="tipo_envio" id="tipo_envio">
                                    <?php
                                    if (@$_GET['funcao'] == 'editar') {
                                        $query = $pdo->query("SELECT * from tb_tipo_envios where id = '$tipo_envio2' ");
                                        $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                        $nomeTipo = $res[0]['nome'];
                                        echo "<option value='" . $tipo_envio2 . "' >" . $nomeTipo . "</option>";
                                    }

                                    $query2 = $pdo->query("SELECT * from tb_tipo_envios order by nome asc ");
                                    $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i = 0; $i < count($res2); $i++) {
                                        foreach ($res2[$i] as $key => $value) {  }

                                        if (@$nomeTipo != $res2[$i]['nome']) {
                                            echo "<option value='" . $res2[$i]['id'] . "' >" . $res2[$i]['nome'] . "</option>";
                                        }
                                    }


                                    ?>
                                </select>

                            </div>
                        </div>


                        <div class="col-md-2">

                            <div class="form-group">
                                <label>Ativo</label>
                                <select class="form-control form-control-sm" name="ativo" id="ativo">
                                    <?php
                                    if (@$_GET['funcao'] == 'editar') {

                                        echo "<option value='" . $ativo2 . "' >" . $ativo2 . "</option>";
                                    }


                                    if (@$ativo2 != "Sim") {
                                        echo "<option value='Sim'>Sim</option>";
                                    }

                                    if (@$ativo2 != "Não") {
                                        echo "<option value='Não'>Não</option>";
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>



                    </div>




                    <div class="form-group">
                        <label>Descrição Curta <small>(1000 caracteres)</small></label>
                        <textarea maxlength="1000" class="form-control form-control-sm" id="descricao" name="descricao"><?php echo @$descricao2 ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Descrição Longa </label>
                        <textarea class="form-control form-control-sm" id="descricao_longa" name="descricao_longa"><?php echo @$desc_longa2 ?></textarea>
                    </div>

                    <div class="form-group">
                        <label>Palavras Chaves</label>
                        <input value="<?php echo @$palavras2 ?>" type="text" class="form-control form-control-sm" id="palavras" name="palavras" placeholder="Palavras Chave">

                    </div>


                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Peso</label>
                                <input value="<?php echo @$peso2 ?>" type="text" class="form-control form-control-sm" id="peso" name="peso" placeholder="Peso">

                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Largura</label>
                                <input value="<?php echo @$largura2 ?>" type="text" class="form-control form-control-sm" id="largura" name="largura" placeholder="Largura">

                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Altura</label>
                                <input value="<?php echo @$altura2 ?>" type="text" class="form-control form-control-sm" id="altura" name="altura" placeholder="Altura">

                            </div>
                        </div>


                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Comprimento</label>
                                <input value="<?php echo @$comprimento2 ?>" type="text" class="form-control form-control-sm" id="comprimento" name="comprimento" placeholder="Comprimento">

                            </div>
                        </div>
                    </div>

                    <div class="row">


                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Valor Frete</label>
                                <input value="<?php echo @$valor_frete2 ?>" type="text" class="form-control form-control-sm" id="valor-frete" name="valor-frete" placeholder="Valor Fixo Frete">

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                            </div>

                        </div>
                        <div class="col-md-4 mt-4">

                            <?php if (@$imagem2 != "") { ?>
                                <img src="../../img/combos/<?php echo $imagem2 ?>" width="170" height="100" id="target">
                            <?php  } else { ?>
                                <img src="../../img/combos/sem-foto.jpg" width="100" height="100" id="target">
                            <?php } ?>
                        </div>

                    </div>



                    <small>
                        <div id="mensagem">

                        </div>
                    </small>

                </div>

                <div class="modal-footer">

                    <input value="<?php echo @$_GET['id'] ?>" type="hidden" name="txtid2" id="txtid2">
                    <input value="<?php echo @$nome2 ?>" type="hidden" name="antigo" id="antigo">

                    <button type="button" id="btn-fechar" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" name="btn-salvar" id="btn-salvar" class="btn btn-primary">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>






<div class="modal" id="modal-deletar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Combo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Combo?</p>

                <div align="center" id="mensagem_excluir" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-deletar" name="btn-deletar" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="modal fade" id="modal-produtos" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Adicionar Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-9">

                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nome</th>
                                        <th>Valor</th>
                                        <th>Adicionar</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $query = $pdo->query("SELECT * FROM tb_produtos where ativo = 'Sim' order by id desc ");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                    for ($i = 0; $i < count($res); $i++) {
                                        foreach ($res[$i] as $key => $value) {
                                        }

                                        $nome_prod = $res[$i]['nome'];
                                        $valor_prod = $res[$i]['valor'];
                                        $id_prod = $res[$i]['id'];
                                        $valor_prod = number_format($valor_prod, 2, ',', '.');
                                        $imagem_prod = $res[$i]['imagem'];

                                    ?>

                                        <tr>
                                            <td>
                                                <?php echo $nome_prod ?>
                                            </td>

                                            <td>
                                                R$ <?php echo $valor_prod ?>
                                            </td>

                                            <td>
                                                <form id="form-prod" method="post">
                                                    <input type="hidden" id="txtid" name="txtid" value="<?php echo @$_GET['id'] ?>">
                                                    <input type="hidden" id="txtidProduto" name="txtidProduto">

                                                    <a id="btn-add-produtos" href="#" onClick="addProd(<?php echo $id_prod ?>); atualizarTela();" class="text-success mr-1" title="Adicionar Produto">
                                                        <?php if (@$imagem_prod != '') { ?>
                                                            <img src='../../img/produtos/<?php echo $imagem_prod ?>' width='50 em' height='30 em'> &nbsp;
                                                        <?php  } ?>

                                                        <?php 
                                                        // QUERY ABAIXO SERVE PARA VERIFICAR SE O PRODUTO FAZ PARTE DO COMBO E COLOCA O ICONE DE CHECK AO LADO DA FOTO
                                                        // PARA O ADMINISTRADOR SABER QUAIS PRODUTOS ESTÃO NESSE COMBO      
                                                        $query_verifica_prod_no_combo = $pdo->query("SELECT p.nome AS nome_produto,
                                                                                                        pc.id_produto AS id_produto_tb_prod_comb,
                                                                                                        pc.id_combo AS id_do_combo,
                                                                                                        p.id as id_do_produto_Tbprodutos
                                                                                                        FROM tb_prod_combos pc 
                                                                                                        JOIN tb_produtos p ON p.id = $id_prod AND pc.id_produto = $id_prod AND pc.id_combo = '" . @$_GET['id'] . "' ");
                                                        $res_verifica_prod = $query_verifica_prod_no_combo->fetchAll(PDO::FETCH_ASSOC);

                                                        if (count($res_verifica_prod) != 0) {
                                                            echo "<i class='far fa-check-circle'></i> &nbsp;";
                                                        }

                                                        //echo "<script>setTimeout(function(){ location.reload(); }, 3000);</script>"; // Atualiza a página após 3 segundos
                                                        ?>
                                                        <i class="fas fa-chec"></i><img src="../../img/icones/add_produto.png" width="20 em">

                                                        <!-- <?php echo "<br/>ID Produto(" . $id_prod . ") <br/> ID Combo(" . $_GET['id'] . ")" ?> -->
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>

                                    <?php } //FIM DO FOR 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <p>Produtos desse Pacote </p>
                        <div id="produtos-combo">

                        </div>

                        <small>
                            <div id="mensagem_produtos" class="mt-4">

                            </div>
                        </small>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>



<!-- MODAL ABERTO PARA DELETAR PRODUTO. -->
<div class="modal" id="modalDeletarProd" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Excluir Produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente excluir esse produto do combo?</p>

                <div align="center" id="mensagem_excluir_produto" class="">

                </div>

            </div>
            <div class="modal-footer">

                <form method="post">
                    <input type="hidden" name="id_produto" id="id_produto">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-excluir-produto">Cancelar</button>
                    <button type="button" id="btn-deletar-produto" name="btn-deletar-produto" onClick="atualizarTela();" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>





<?php

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "novo") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "editar") {
    echo "<script>$('#modalDados').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "excluir") {
    echo "<script>$('#modal-deletar').modal('show');</script>";
}


if (@$_GET["funcao"] != null && @$_GET["funcao"] == "produtos") {
    echo "<script>$('#modal-produtos').modal('show'); </script>";
}

?>




<!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
<script type="text/javascript">
    $("#form").submit(function() {
        var pag = "<?= $pag ?>";
        event.preventDefault();
        var formData = new FormData(this);

        $.ajax({
            url: pag + "/inserir.php",
            type: 'POST',
            data: formData,

            success: function(mensagem) {

                $('#mensagem').removeClass()

                if (mensagem.trim() == "Salvo com Sucesso!!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag=" + pag;

                } else {
                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').html(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function() { // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function() {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
    });
</script>





<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir-combo.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)
                },

            })
        })
    })
</script>





<script type="text/javascript">
    function listarProd() {
        var pag = "<?= $pag ?>";

        $.ajax({
            url: pag + "/listar-produtos.php",
            method: "post",
            data: $('#form-prod').serialize(),
            dataType: "html",
            success: function(result) {

                $('#produtos-combo').html(result);
            }
        })
    }
</script>





<!--FUNCAO PARA CHAMAR MODAL DE DELETAR CARAC DOS PRODUTOS -->
<script type="text/javascript">
    function deletarProd(id) {
        console.log(id);
        document.getElementById('id_produto').value = id;
        $('#modalDeletarProd').modal('show');

    }
</script>




<!--FUNCAO PARA ADD PROD -->
<script type="text/javascript">
    function addProd(id) {
        document.getElementById('txtidProduto').value = id;

        event.preventDefault();
        var pag = "<?= $pag ?>";
        $.ajax({
            url: pag + "/add-produto.php",
            method: "post",
            data: $('#form-prod').serialize(),
            dataType: "text",
            success: function(msg) {
                if (msg.trim() === 'Salvo com Sucesso!!') {

                    // $('#mensagem_produtos').addClass('text-success')
                    //$('#mensagem_produtos').text(msg);
                    listarProd();
                    $('#mensagem_produtos').text('')
                } else {
                    $('#mensagem_produtos').addClass('text-danger')
                    $('#mensagem_produtos').text(msg);
                }
            }
        })

    }
</script>





<!--SCRIPT QUE É EXECUTADO AO CARREGAR A PÁGINA -->
<script type="text/javascript">
    $(document).ready(function() {
        listarProd()
    })
</script>





<!--SCRIPT PARA CARREGAR IMAGEM PRINCIPAL -->
<script type="text/javascript">
    function carregarImg() {

        var target = document.getElementById('target');
        var file = document.querySelector("input[type=file]").files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            target.src = reader.result;
        };

        if (file) {
            reader.readAsDataURL(file);


        } else {
            target.src = "";
        }
    }
</script>






<!--AJAX PARA EXCLUSÃO DOS DADOS -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-deletar-produto').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/excluir-produto.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {

                        listarProd();
                        $('#btn-cancelar-excluir-produto').click();
                        $('#mensagem_produtos').text('')

                    } else {
                        $('#mensagem_excluir_produto').text(mensagem)
                    }

                },
            })
        })
    })
</script>






<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable2').dataTable({
            "ordering": false
        })

    });
</script>

<script>
    function atualizarTela() {
        setTimeout(function() {
            location.reload();
        }, 300); // 1500 milissegundos = 1,5 segundos
    }
</script>

<style>
    hr {
        margin: 3px;
    }

</style>