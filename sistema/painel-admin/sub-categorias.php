<?php
$pag = "sub-categorias";
require_once("../../conexao.php");
@session_start();
//verificar se o usuário está autenticado
if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Admin') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}


?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Sub-Categoria</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome SubCategoria</th>
                        <th>Produtos</th>
                        <th>Categoria</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM tb_sub_categorias order by id desc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {}

                        $nome = $res[$i]['nome'];
                        // $itens = $res[$i]['itens'];
                        $imagem = $res[$i]['imagem'];
                        $categoria = $res[$i]['id_categoria'];
                        $id = $res[$i]['id'];

                        //Recuperar o nome da categoria 
                        $query2 = $pdo->query("SELECT * FROM tb_categorias WHERE id = '$categoria' ");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        $nome_cat = $res2[0]['nome'];

                         // Contabilizando quantidade de produtos que a sub-categoria possui
                        // Retorna o total de produtos por sub-categoria
                        $query3 = $pdo->query("SELECT * FROM tb_produtos WHERE sub_categoria = '$id' ");
                        $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                        $itens = @count($res3);
                     

                    ?>


                        <tr>
                            <td><?php echo $nome ?></td>
                            <td><?php echo $itens ?></td>
                            <td><?php echo $nome_cat ?></td>
                            <td><img src="../../img/sub-categorias/<?php echo $imagem ?>" width="75"></td>


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
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <?php
                if (@$_GET['funcao'] == 'editar') {
                    $titulo = "Editar Registro de Sub-Categoria";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM tb_sub_categorias where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['nome'];
                    $imagem2 = $res[0]['imagem'];
                    $categoria2 = $res[0]['id_categoria']; //chave estrangeira de categoria na tabela sub_categorias
                } else {
                    $titulo = "Inserir Sub-Categoria";
                }


                ?>

                <h5 class="modal-title" id="exampleModalLabel"><?php echo $titulo ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form id="form" method="POST">
                <div class="modal-body">

                    <div class="form-group">
                        <label>Nome</label>
                        <input value="<?php echo @$nome2 ?>" type="text" class="form-control form-control-sm" id="nome-cat" name="nome-cat" placeholder="Nome">
                    </div>

                    <div class="form-group">
                        <label>Categoria</label>
                        <select class="form-control form-control-sm" name="categoria" id="categoria">
                            <?php  
                                if (@$_GET['funcao'] == 'editar') {
                                    $query = $pdo->query("SELECT * FROM tb_categorias WHERE id = '$categoria2' ");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                                    $nomeCat = $res[0]['nome'];
                                    echo "<option value='".$categoria2."' >" . $nomeCat . "</option>";
                                }

                                $query2 = $pdo->query("SELECT * FROM tb_categorias ORDER BY nome asc");
                                $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                                for($i=0; $i<count($res2); $i++){
                                    foreach($res2[$i] as $key => $value){ }

                                    if(@$nomeCat != $res2[$i]['nome']){
                                        echo "<option value='". $res2[$i]['id'] ."' >" . $res2[$i]['nome'] . "</option>";
                                    }
                                }

                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Imagem</label>
                        <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                    </div>

                    <?php if (@$imagem2 != "") { ?>
                        <img src="../../img/sub-categorias/<?php echo $imagem2 ?>" width="300" height="200" id="target">
                    <?php  } else { ?>
                        <img src="../../img/sub-categorias/sem-foto.jpg" width="300" height="200" id="target">
                    <?php } ?>

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
                <h5 class="modal-title">Excluir Registro de Sub-Categoria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro de SUB-CATEGORIA?</p>

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

                if (mensagem.trim() == "Salvo com Sucesso !!!") {
                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "index.php?pag=" + pag;

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

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
                url: pag + "/excluir.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'VOCÊ NÃO PODE DELETAR ESSA SUB-CATEGORIA POIS EXISTEM PRODUTOS QUE SÃO DEPENDENTES DELA!!!') {
                        $('#mensagem_excluir').text(mensagem)
                        //Só restará ao administrador o cancelamento da tentativa de deleção da sub-categoria
                    }

                    if (mensagem.trim() === 'Excluído com Sucesso !!!') {
                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').text(mensagem)
                },

            })
        })
    })
</script>



<!--SCRIPT PARA CARREGAR IMAGEM -->
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





<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>

