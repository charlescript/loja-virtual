<?php

require_once("../../conexao.php");

$assunto = $_POST['assunto-email'];
$link = $_POST['link-email'];
$mensagem = $_POST['mensagem-email'];


if ($assunto == "") {
    echo 'Preencha o Campo Assunto!';
    exit();
}

if ($mensagem == "") {
    echo 'Preencha o Campo Mensagem!';
    exit();
}

$query = $pdo->query("SELECT * FROM tb_emails where ativo = 'Sim'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

for ($i = 0; $i < count($res); $i++) {
    foreach ($res[$i] as $key => $value) {
    }

    $to = $res[$i]['email'];
    $nome_cliente = $res[$i]['nome'];
    $subject = "$assunto";
    $url_descadastrar = $url_loja . 'descadastrar.php';
    $message = "
				Olá $nome_cliente, <br>
				$mensagem !


				<br><br> <i> <a title='$link' href='$link' target='_blank'>Clique aqui </a> para ir para o nosso site!!</i><br><br>

				<a title='$url_loja' href='$url_loja' target='_blank'>$url_loja</a>

				<br><br><br>
				WhatsApp -> <a href='http://api.whatsapp.com/send?1=pt_BR&phone=$whatsapp_link' alt='$whatsapp' target='_blank'><i class='fab fa-whatsapp'></i>$whatsapp</a>

				<br><br><br>
                <i> Caso não queira mais receber nossos emails <a href='$url_descadastrar' target='_blank'> clique aqui </a> para se descadastrar!</i> <br><br>

				";


    $remetente = $email_loja;
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8;' . "\r\n";

    if ($to != $remetente) {
        $headers .= "From: " . $remetente;
    }

    // Adapte as configurações do seu servidor SMTP da HostGator
    ini_set("SMTP", "smtp.sansales.com.br");
    ini_set("smtp_port", "587");

    mail($to, $subject, $message, $headers);
}




echo 'Enviado com Sucesso!';
