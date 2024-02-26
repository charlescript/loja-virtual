<?php
require_once('config.php');
require_once("conexao.php");

@session_start();
$id_usuario = @$_SESSION['id_usuario'];

if($id_usuario != null) { 
// VERIFICA TOTAIS DO CARRINHO
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

    $combo = $dados[$i]['combo'];
    $id_produto = $dados[$i]['id_produto'];
    $quantidade = $dados[$i]['quantidade'];

    if($combo == 'Sim'){
        $res_p = $pdo->query("SELECT * from tb_combos where id = '$id_produto' ");
    }else{
        $res_p = $pdo->query("SELECT * from tb_produtos where id = '$id_produto' ");
    }
    
    $dados_p = $res_p->fetchAll(PDO::FETCH_ASSOC);

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


    $total_item = $valor * $quantidade;
    @$total = @$total + $total_item;

    }

    @$total_carrinho = number_format(@$total, 2, ',', '.');
} else {
    @$total_carrinho = 0;
    @$linhas = 0;
}
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Venda de Roupas e Eletronicos">
    <meta name="keywords" content="eletronicos, roupas masculinas, roupas femininas">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="shortcut icon" href="img/logo_1.png" type="image/x-icon">
    <link rel="icon" href="img/logo_1.png" type="image/x-icon">
    <title> <?php echo $nome_loja; ?> </title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="css/style.css" type="text/css">
</head>

<body>
    <!-- Page Preloder
    <div id="preloder">
        <div class="loader"></div>
    </div> -->

    <!-- Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo ml-5">
            <a href="index.php"><img src="img/logo_1.png" alt=""></a>
        </div>
        <div class="humberger__menu__cart">

            <ul>
                <li><a href="carrinho.php"><i class="fa fa-shopping-bag"></i> <span> <?php echo $linhas ?> </span></a></li>
            </ul>

            <div class="header__cart__price">Valor: <span>R$ <?php echo $total_carrinho ?> </span></div>

            <div class="header__top__right__auth ml-4">
                <?php if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Cliente') { ?>
                    <a href="sistema"><i class="fa fa-user"></i> Login</a>
                <?php } else { ?>
                    <a target="_blank" href="sistema/painel-cliente/"><i class="fa fa-user"></i> Painel</a>

                    <a  href="sistema/logout.php"><i class="fa fa-user"></i> Deslogar</a>
                <?php } ?>

            </div>

        </div>

        <div class="humberger__menu__widget">
            <!-- Aqui poderei inserir a mudança de linguas: inglês, espanhol etc -->
        </div>

        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active"><a href="./index.php">Início</a></li>
                <li><a href="./categorias.php">Categorias</a></li>
                <li><a href="#">Produtos</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="produtos.php">Lista de Produtos</a></li>
                        <li><a href="sub-categorias.php">Sub Categorias</a></li>
                        <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                        <li><a href="./checkout.html">Check Out</a></li>
                        <li><a href="./blog-details.html">Blog Details</a></li>
                    </ul>
                </li>
                <li><a href="./blog.html">Blog</a></li>
                <li><a href="./carrinho.php">Carrinho</a></li>
                <li><a href="./contatos.php">Contatos</a></li>
            </ul>
        </nav>
        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
            <a href="#" target="_blank"><i class="fa fa-linkedin"></i></a>
            <a href="#" target="_blank"><i class="fa fa-instagram"></i></a>
            <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link; ?>" target="_blank" title="<?php echo $whatsapp; ?>"><i class="fa fa-whatsapp"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> <?php echo $email_loja; ?> </li>
                <li> <?php echo $texto_destaque; ?> </li>
            </ul>
        </div>
    </div>
    <!-- Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i> <?php echo $email_loja; ?> </li>
                                <li> <?php echo $texto_destaque ?> </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#" target="_blank" title="Ir para facebook"> <i class="fa fa-facebook "></i></a>
                                <a href="#" target="_blank" title="Ir para Instagram"><i class="fa fa-instagram "></i></a>
                                <a href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link; ?>" target="_blank" title="<?php echo $whatsapp; ?>"><i class="fa fa-whatsapp "></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <!-- Aqui poderá ficar o modelo de tradutor do site inglês, espanhol... -->
                            </div>

                            <div class="header__top__right__auth">
                                <?php if (@$_SESSION['id_usuario'] == null || @$_SESSION['nivel_usuario'] != 'Cliente') { ?>
                                    <a href="sistema"><i class="fa fa-user"></i> Login</a>
                                <?php } else { ?>
                                    <a target="_blank" href="sistema/painel-cliente/"><i class="fa fa-user"></i> Painel</a>

                                    <a  href="sistema/logout.php"><i class="fa fa-user"></i> Deslogar</a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="./index.php"><img src="img/logo_1.png" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="./index.php">Início</a></li>
                            <li><a href="./categorias.php">Categorias</a></li>
                            <li><a href="#">Produtos</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./produtos.php">Produtos</a></li>
                                    <li><a href="./lista-produtos.php">Lista de Produtos</a></li>
                                    <li><a href="sub-categorias.php">Sub Categorias</a></li>
                                    <li><a href="./promocoes.php">Promoções</a></li>
                                    <li><a href="./combos.php">Combos</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.php">Blog</a></li>
                            <li><a href="./contatos.php">Contatos</a></li>
                        </ul>
                    </nav>
                </div>
                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li><a href="carrinho.php"><i class="fa fa-shopping-bag"></i> <span> <?php echo $linhas ?> </span></a></li>
                        </ul>
                        <div class="header__cart__price">Valor:  <span>R$ <?php echo $total_carrinho ?></span></div>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->