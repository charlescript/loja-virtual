<?php
$pag = "promocoes";
require_once("../../conexao.php");
@session_start();
//verificar se o usuário está autenticado
if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Admin') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}


?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Nova Promoção</a>
    <!-- <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a> -->
</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Imagem</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php

                    $query = $pdo->query("SELECT * FROM tb_promocao_banner order by id desc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {
                        }

                        $nome = $res[$i]['titulo'];
                        $ativo = $res[$i]['ativo'];
                        $imagem = $res[$i]['imagem'];
                        $id = $res[$i]['id'];
                        $link = $res[$i]['link'];
                    ?>


                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo $link ?>"> 
                                    <?php echo $nome ?>
                                </a>
                            </td>

                            <td>
                                <img src=" ../../img/banner/<?php echo $imagem ?>" width="100" height="50">
                            </td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>


                                <?php if ($ativo == 'Sim') {
                                    echo "
                                    <a href='index.php?pag=$pag&funcao=desativar&id=$id' class='mr-1' title='Desativar Promoção'>
                                    <i class='fas fa-check-circle fa-spin  text-success'></i> </a>";
                                } else {
                                    echo "
                                    <a href='index.php?pag=$pag&funcao=ativar&id=$id' class='mr-1' title='Ativar Promoção'>
                                    <i class='far fa-circle text-dark'></i></a>";
                                } ?>

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
                    $titulo = "Editar Registro";
                    $id2 = $_GET['id'];

                    $query = $pdo->query("SELECT * FROM tb_promocao_banner where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $nome2 = $res[0]['titulo'];
                    $imagem2 = $res[0]['imagem'];
                    $link = $res[0]['link'];
                } else {
                    $titulo = "Inserir Registro de Promoção Banner";
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
                        <label>Título</label>
                        <input value="<?php echo @$nome2 ?>" type="text" class="form-control" id="titulo-promo" name="titulo-promo" placeholder="Título">
                    </div>

                    <div class="form-group">
                        <label>Link</label>
                        <input value="<?php echo @$link ?>" type="text" class="form-control" id="link-promo" name="link-promo" placeholder="Link">
                    </div>

                    <div class="form-group">
                        <label>Imagem</label>
                        <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                    </div>

                    <?php if (@$imagem2 != "") { ?>
                        <img src="  ../../img/banner/<?php echo $imagem2 ?>" width="450" height="200" id="target">
                    <?php  } else { ?>
                        <img src="  ../../img/banner/sem-foto.jpg" width="450" height="200" id="target">
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
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este banner de promoção?</p>

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







<div class="modal" id="modal-ativar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Ativar Promoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente <b>ativar</b> essa promoção?</p>

                <div align="center" id="mensagem_ativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-ativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id_ativar" name="id_ativar" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-ativar" name="btn-ativar" class="btn btn-danger">Ativar</button>
                </form>
            </div>
        </div>
    </div>
</div>





<div class="modal" id="modal-desativar" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Desativar Promoção</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente <b>desativar</b> essa promoção?</p>

                <div align="center" id="mensagem_ativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-desativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id_desativar" name="id_desativar" value="<?php echo @$_GET['id'] ?>" required>

                    <button type="button" id="btn-desativar" name="btn-desativar" class="btn btn-danger">Desativar</button>
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

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "ativar") {
    echo "<script>$('#modal-ativar').modal('show');</script>";
}

if (@$_GET["funcao"] != null && @$_GET["funcao"] == "desativar") {
    echo "<script>$('#modal-desativar').modal('show');</script>";
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

                    if (mensagem.trim() === 'Excluído com Sucesso!!') {


                        $('#btn-cancelar-excluir').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_excluir').addClass('text-danger')
                    $('#mensagem_excluir').text(mensagem)

                },

            })
        })
    })
</script>




<!--AJAX PARA ATIVAR PROMOCAO -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-ativar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/ativar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Ativado com Sucesso!!') {


                        $('#btn-cancelar-ativar').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_ativar').addClass('text-danger')
                    $('#mensagem_ativar').text(mensagem)

                },

            })
        })
    })
</script>




<!--AJAX PARA DESATIVAR PROMOCAO -->
<script type="text/javascript">
    $(document).ready(function() {
        var pag = "<?= $pag ?>";
        $('#btn-desativar').click(function(event) {
            event.preventDefault();

            $.ajax({
                url: pag + "/desativar.php",
                method: "post",
                data: $('form').serialize(),
                dataType: "text",
                success: function(mensagem) {

                    if (mensagem.trim() === 'Desativado com Sucesso!!') {


                        $('#btn-cancelar-desativar').click();
                        window.location = "index.php?pag=" + pag;
                    }

                    $('#mensagem_desativar').text(mensagem)

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