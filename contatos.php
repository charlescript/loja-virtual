<?php
    require_once("cabecalho.php");
    require_once("cabecalho-busca.php");
   
?>

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="img/banner_contatos.png">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Contatos</h2>
                    <div class="breadcrumb__option">
                        <!-- <a href="./index.php"></a> -->
                        <span></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->

<!-- Contact Section Begin -->
<section class="contact spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span><i class="fa fa-phone text-info"></i></span>
                    <h4>Telefone</h4>
                    <p> <?php echo $telefone; ?> </p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link; ?>" target="_blank" title="<?php echo $whatsapp; ?>">
                    <div class="contact__widget">
                        <span class="icon_whatsapp">
                        <i class="fa fa-whatsapp text-success"></i>
                        </span>
                        <h4>WhatsApp</h4>
                        <?php echo $whatsapp; ?>
                    </div>
                </a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <div class="contact__widget">
                    <span class="fa fa-history text-danger"></span>
                    <h4>Horário atendimento</h4>
                    <p>09:00 até 18:00 pm</p>
                </div>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 text-center">
                <a href='mailto:<?php echo $email_loja ?>' target='_blank'>
                <div class="contact__widget">
                    <span> <i class="fa fa-envelope"> </i></span>
                    <h4>Email</h4>
                    <?php echo $email_loja; ?> 
                </a> 
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Contact Section End -->

<!-- Map Begin -->
<div class="map">
<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3644.7350908634944!2d-46.41477348886009!3d-24.005129978407773!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94ce1db2e586da8d%3A0x271ae3e10bdc671e!2sFatec%20Praia%20Grande!5e0!3m2!1spt-BR!2sbr!4v1695670987144!5m2!1spt-BR!2sbr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <div class="map-inside">
        <i class="icon_pin"></i>
        <div class="inside-widget">
            <h4> <?php echo $cidade; ?> </h4>
            <ul>
                <li> <?php echo $telefone; ?> </li>
                <li> <?php echo $endereco_loja; ?> </li>
            </ul>
        </div>
    </div>
</div>
<!-- Map End -->

<!-- Contact Form Begin -->
<!-- <div class="contact-form spad bg-light">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact__form__title">
                    <h2>Contate-nos</h2>
                </div>
            </div>
        </div>

        <form method="post">
            <div class="row">
                <div class="col-lg-4 col-md-4">
                    <input id="nome" name="nome" type="text" placeholder="Seu nome" >
                </div>
                <div class="col-lg-4 col-md-4">
                    <input id="email" name="email" type="email" placeholder="Seu email">
                </div>
                <div class="col-lg-4 col-md-4">
                    <input id="telefone" name="telefone" type="text"  placeholder="Seu Whatsapp">
                </div>

                <div class="col-lg-12 text-center">
                    <textarea id="mensagem" name="mensagem" placeholder="Sua Mensagem: "></textarea>
                    <button name="btn-enviar-email" id="btn-enviar-email" type="button" class="site-btn">Enviar</button>
                </div>

                <div class="col-lg-12 text-center mt-3 text-info" id="div-mensagem">  </div>
                
            </div>
        </form>

    </div>
</div> -->
<!-- Contact Form End -->

<?php
    require_once("rodape.php");
?>

<script type="text/javascript">

    $('#btn-enviar-email').click(function(event){
        event.preventDefault();
        $('#div-mensagem').addClass('text-info');
        $('#div-mensagem').removeClass('text-danger');
        $('#div-mensagem').removeClass('text-success');
        $('#div-mensagem').text('Enviando...');
        
        $.ajax({
            url:"enviar.php",
            method:"post",
            data:  $('form').serialize(),
            dataType: "text",
            success: function(msg){

                if(msg.trim() === 'PREENCHA O CAMPO NOME!'){
                    $('#div-mensagem').addClass('text-danger');
                    $('#div-mensagem').html(msg);
                } else 
                
                if(msg.trim() === 'PREENCHA O CAMPO EMAIL!') {
                    $('#div-mensagem').addClass('text-danger');
                    $('#div-mensagem').html(msg);
                } else

                if(msg.trim() === 'Dominio de email do GMAIL nao sao permitidos por esse PAINEL pois precisam estar logados'){
                    $('#div-mensagem').addClass('text-danger');
                    $('#div-mensagem').html(msg);           
                    $('#div-mensagem').html(msg + " <br/>Acesse o seu GMAIL e nos envie a partir dele: <div><a href='mailto:<?php echo $email_loja ?>' target='_blank'>GMAIL</a></div>");
                } else 
                
                if(msg.trim() === 'PREENCHA O CAMPO MENSAGEM!') {
                    $('#div-mensagem').addClass('text-danger');
                    $('#div-mensagem').html(msg);
                } else 

                if(msg.trim() === 'Enviado com Sucesso!'){
                    $('#div-mensagem').removeClass('text-danger');
                    $('#div-mensagem').removeClass('text-info');
                    $('#div-mensagem').addClass('text-success')
                    $('#div-mensagem').text(msg);
                    $('#nome').val('');
                    $('#email').val('');
                    $('#telefone').val('');
                    $('#mensagem').val('');   
                    
                } else {
                    $('#div-mensagem').removeClass('text-success');
                    $('#div-mensagem').removeClass('text-info');
                    $('#div-mensagem').addClass('text-danger');
                    //$('#div-mensagem').text('Ocorreu erro ao enviar o Formulário! </br>Provavelmente seu servidor de hospedagem não está com permissão de envio habilitada ou você está em um servidor local!');
                    $('#div-mensagem').html("Ocorreu um erro ao enviar o Formulário!<br>Provavelmente seu servidor de hospedagem não está com permissão de envio habilitada ou você está em um servidor local!");
                    //$('#div-mensagem').text(msg);
                }
            }
        })
    })

</script>