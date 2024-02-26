<?php
$pag = "alertas";
require_once("../../conexao.php");
@session_start();
//verificar se o usuário está autenticado
if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Admin') {
    echo "<script language='javascript'> window.location='../index.php' </script>";
}

// $agora = date('Y-m-d');

// Define o fuso horário para Brasília
date_default_timezone_set('America/Sao_Paulo');

// Obtém a data, hora e minuto atuais no padrão brasileiro
$agora = date('Y-m-d H:i');

?>

<div class="row mt-4 mb-4">
    <a type="button" class="btn-primary btn-sm ml-3 d-none d-md-block" href="index.php?pag=<?php echo $pag ?>&funcao=novo">Novo Alerta</a>
    <a type="button" class="btn-primary btn-sm ml-3 d-block d-sm-none" href="index.php?pag=<?php echo $pag ?>&funcao=novo">+</a>

</div>



<!-- DataTales Example -->
<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Título</th>
                        <th>Data</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    //$query = $pdo->query("CALL atualizarAlertas()");  Funciona apenas em servidor local e não em servidor da hostgator compartilhado
                    // Somente se fizermos a contratação de um VPS virtual private server
                    $query = $pdo->query("SELECT * FROM tb_alertas order by id desc ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    for ($i = 0; $i < count($res); $i++) {
                        foreach ($res[$i] as $key => $value) {  }

                        $titulo_mensagem = $res[$i]['titulo_mensagem'];
                        $ativo = $res[$i]['ativo'];

                        $id = $res[$i]['id'];
                        $link = $res[$i]['link'];
                        $data = $res[$i]['data'];

                       // $data = implode('/', array_reverse(explode('-', $data)));

                        // Obtém a data no formato americano
                        $dataAmericana = $data;
                        
                        // Converte a data para o formato brasileiro
                        $data = (new DateTime($dataAmericana))->format('d/m/Y H:i:s');

                    ?>


                        <tr>
                            <td>
                                <a target="_blank" href="<?php echo $link ?>"> <?php echo $titulo_mensagem ?></a>
                            </td>

                            <td>
                                <?php echo $data; ?>
                            </td>

                            <td>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=editar&id=<?php echo $id ?>" class='text-primary mr-1' title='Editar Dados'><i class='far fa-edit'></i></a>
                                <a href="index.php?pag=<?php echo $pag ?>&funcao=excluir&id=<?php echo $id ?>" class='text-danger mr-1' title='Excluir Registro'><i class='far fa-trash-alt'></i></a>


                                <?php if ($ativo == 'Sim') {
                                    echo "
                                        <a href='index.php?pag=$pag&funcao=desativar&id=$id' class='mr-1' title='Desativar Alerta'>
                                        <i class='fas fa-check-circle fa-spin  text-success'></i> </a>";
                                } else {
                                    echo "
                                        <a href='index.php?pag=$pag&funcao=ativar&id=$id' class='mr-1' title='Ativar Alerta'>
                                        <i class='far fa-circle text-dark'></i></a>";
                                } ?>

                            </td>
                        </tr>
                    <?php }  //FIM do FOR ?>
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

                    $query = $pdo->query("SELECT * FROM tb_alertas where id = '" . $id2 . "' ");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    $titulo_alerta = $res[0]['titulo_alerta'];
                    $titulo_mensagem = $res[0]['titulo_mensagem'];
                    $link = $res[0]['link'];
                    $imagem = $res[0]['imagem'];
                    $mensagem = $res[0]['mensagem'];
                    $data = $res[0]['data'];
                } else {
                    $titulo = "Inserir Registro de Alerta";
                    $data = $agora;
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
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título Alerta <small>(Max 20 Caracteres)</small></label>
                                <input maxlength="20" value="<?php echo @$titulo_alerta ?>" type="text" class="form-control" id="titulo-alerta" name="titulo-alerta" placeholder="Título Alerta">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Título Mensagem</label>
                                <input value="<?php echo @$titulo_mensagem ?>" type="text" class="form-control" id="titulo-mensagem" name="titulo-mensagem" placeholder="Título Mensagem">
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label>Mensagem <small>(Max 1000 Caracteres)</small></label>
                        <textarea maxlength="1000" class="form-control" id="mensagem-alerta" name="mensagem-alerta"><?php echo @$mensagem ?></textarea>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Link</label>
                                <input value="<?php echo @$link ?>" type="text" class="form-control" id="link-promo" name="link-promo" placeholder="Link caso Exista">
                            </div>

                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Imagem</label>
                                <input type="file" value="<?php echo @$imagem2 ?>" class="form-control-file" id="imagem" name="imagem" onChange="carregarImg();">
                            </div>
                        </div>
                    </div>



                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Data <small>(Até quando promoção será exibida)</small></label>
                                <input type="datetime-local" class="form-control" id="data" name="data" value="<?php echo @$data ?>" min="<?php echo $agora ?>">
                            </div>

                        </div>

                        <div class="col-md-6">

                            <?php if (@$imagem != "") { ?>
                                <img src="../../img/alertas/<?php echo $imagem ?>" width="120" height="120" id="target">
                            <?php  } else { ?>
                                <img src="../../img/alertas/sem-foto.jpg" width="120" height="120" id="target">
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
                <h5 class="modal-title">Excluir Registro</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <p>Deseja realmente Excluir este Registro?</p>

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

                <p>Deseja realmente Ativar essa promoção?</p>

                <div align="center" id="mensagem_ativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-ativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

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

                <p>Deseja realmente Desativar essa promoção?</p>

                <div align="center" id="mensagem_ativar" class="">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" id="btn-cancelar-desativar">Cancelar</button>
                <form method="post">

                    <input type="hidden" id="id" name="id" value="<?php echo @$_GET['id'] ?>" required>

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




<script>
// Função para atualizar a tela a cada 30 segundos
function atualizarTela() {
    location.reload();
}

// Chama a função a cada 30 segundos (30000 milissegundos)
setInterval(atualizarTela, 60000);
</script>



<script type="text/javascript">
    $(document).ready(function() {
        $('#dataTable').dataTable({
            "ordering": false
        })

    });
</script>