<?php
require_once('conexao.php');
require_once("cabecalho.php");
@session_start();
?>
<!-- Hero Section Begin -->
<?php
$query = $pdo->query("SELECT id FROM tb_categorias");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

// Contabilizar a quantidade de categorias
$quantidadeCategorias = count($res);

if ($quantidadeCategorias > 11) {
    $sobrepoe = 'hero-normal';
} else {
    $sobrepoe = '';
}
?>
<section class="hero <?php echo $sobrepoe ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    <ul>

                        <?php // TRECHO DE CÓDIGO PARA APRESENTAR AS CATEGORIAS NA VITRINE DA LOJA
                        $query = $pdo->query("SELECT nome, nome_url FROM tb_categorias order by nome asc ");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($res as $row) {
                        ?>
                            <li>
                                <a href="sub-categoria-de-<?php echo $row['nome_url']; ?>">
                                    <?php echo $row['nome']; ?>
                                </a>
                            </li>
                        <?php } // ENDFOREACH 
                        ?>

                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="lista-produtos.php" method="get">
                            <input name="txtBuscar" type="text" placeholder="O que você deseja?">
                            <button type="submit" class="site-btn">Buscar</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <a class="text-success" href="http://api.whatsapp.com/send?1=pt_BR&phone=<?php echo $whatsapp_link; ?>" target="_blank" title="<?php echo $whatsapp; ?>">
                                <i class="fa fa-whatsapp"></i>
                            </a>
                        </div>
                        <div class="hero__search__phone__text">
                            <h5> <?php echo $whatsapp ?> </h5>
                            <span>Nosso WhatsApp</span>
                        </div>
                    </div>
                </div>
                <div class="hero__item set-bg" data-setbg="img/hero/banner2.png" width="100%">
                    <div class="hero__text">
                        <span> SanSales e Voce!</span>
                        <h2 style="color:#fbbb68;">Tecnologia <br />de ponta</h2>
                        <p> <?php echo $slogan_loja ?> </p>
                        <a href="produtos.php" class="primary-btn">COMPRE AGORA</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Categories Section Begin -->
<section class="categories">
    <div class="container">
        <div class="row">
            <div class="categories__slider owl-carousel">

                <?php
                $query = $pdo->query("SELECT nome, nome_url, imagem FROM tb_categorias order by nome asc ");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                foreach ($res as $key) {
                    $nome = $key['nome'];
                    $imagem = $key['imagem'];
                    $nome_url = $key['nome_url'];
                ?>

                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="img/categorias/<?php echo $imagem ?>">
                            <h5><a href="sub-categoria-de-<?php echo $nome_url; ?>"><?php echo $nome ?></a></h5>
                        </div>
                    </div>

                <?php } ?> <!-- ENDFOREACH -->

            </div>
        </div>
    </div>
</section>
<!-- Categories Section End -->

<!-- Featured Section Begin -->
<section class="featured spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title">
                    <a class="text-dark" href="produtos.php"> <span class="">Ver + Produtos </span> <i class="fa fa-eye"></i> </a> <br />
                    <h2>Produtos Destaque</h2>
                </div>
                <div class="featured__controls">
                    <ul>

                        <?php
                        $query = $pdo->query("SELECT nome, nome_url FROM tb_sub_categorias order by nome asc limit 6");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        foreach ($res as $key) {
                            $nome = $key['nome'];
                            $nome_url = $key['nome_url'];
                        ?>

                            <li>
                                <a href="produtos-<?php echo $nome_url; ?>" class="text-dark">
                                    <?php echo $nome ?>
                                </a>
                            </li>

                        <?php } ?>

                    </ul>
                </div>
            </div>
        </div>


        <div class="row featured__filter">

            <?php
            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by vendas desc limit 8");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($res as $key) {
                $nome = $key['nome'];
                $valor = $key['valor'];
                $nome_url = $key['nome_url'];
                $imagem = $key['imagem'];
                $promocao = $key['promocao'];
                $id = $key['id'];
                $valor = number_format($valor, 2, ',', '.');

                if ($promocao == 'Sim') {
                    $queryp = $pdo->query("SELECT valor, desconto FROM tb_promocoes where id_produto = '$id' ");
                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                    $valor_promo = $resp[0]['valor'];
                    $desconto = $resp[0]['desconto'];
                    $valor_promo = number_format($valor_promo, 2, ',', '.');
            ?>

                    <div class="col-lg-3 col-md-4 col-sm-6 mix sapatos fresh-meat">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                <div class="product__discount__percent">-<?php echo $desconto ?>%</div>
                                <ul class="product__item__pic__hover">
                                    <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>

                                    <!-- <li><a href="index.php?funcao=carrinho&id=<?php //echo $id ?> "><i class="fa fa-shopping-cart"></i></a></li> -->
                                    <li><a href="" onclick="carrinhoModal('<?php echo $id ?>' , 'Não' )"> <i class="fa fa-shopping-cart"></i></a></li>

                                </ul>
                            </div>
                            <div class="product__discount__item__text">

                                <h5><a href="produto-<?php echo $nome_url ?>"><?php echo $nome ?></a></h5>
                                <div class="product__item__price">R$ <?php echo $valor_promo ?> <span>R$ <?php echo $valor ?></span></div>
                            </div>
                        </div>
                    </div>

                <?php } // END IF
                else { ?>

                    <!-- Comentei esse trecho de código aqui pois estava ocorrendo uma transparencia no icone de VIEW e CART, para evitar perder tempo procurando erro comentei e fiz outro -->
                    <!-- <div class="col-lg-3 col-md-4 col-sm-6 mix sapatos fresh-meat">
                        <div class="featured__item">
                            <div class="featured__item__pic set-bg" data-setbg="img/produtos/<?php //echo $imagem ?>">
                                <ul class="featured__item__pic__hover">
                                    <li><a href="produto-<?php //echo $nome_url ?>"><i class="fa fa-eye"></i></a></li> -->
                                    <!-- <li><a href="" onclick="carrinhoModal('<?php //echo $id ?>' , 'Não' )"> <i class="fa fa-shopping-cart"></i></a></li> -->
                                <!-- </ul>
                            </div>
                            <div class="featured__item__text">
                                <a href="produto-<?php //echo $nome_url ?>">
                                    <h6><?php //echo $nome ?></h6>
                                    <h5>R$ <?php // echo $valor ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>  -->
                    
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="product__discount__item">
                            <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                <ul class="product__item__pic__hover">
                                    <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                    <li><a href="" onclick="carrinhoModal('<?php echo $id ?>' , 'Não')"> <i class="fa fa-shopping-cart"></i></a></li>
                                </ul>
                            </div>
                            <div class="product__discount__item__text">
                                <a href="produto-<?php echo $nome_url ?>">
                                    <h6><?php echo $nome ?></h6>
                                    <h5>R$ <?php echo $valor ?></h5>
                                </a>
                            </div>
                        </div>
                    </div>

            <?php } // END ELSE
            } // END FOREACH
            ?>

        </div>
    </div>
</section>
<!-- Featured Section End -->

<!-- Banner Begin -->
<div class="banner">
    <div class="container">
        <div class="row">

            <?php
            $query = $pdo->query("SELECT id, titulo, link, imagem, ativo FROM tb_promocao_banner where ativo = 'Sim' order by id desc limit 2");
            $res = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($res as $key) {
                $id = $key['id'];
                $titulo = $key['titulo'];
                $link = $key['link'];
                $imagem = $key['imagem'];
                $ativo = $key['ativo'];
            ?>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <a href="<?php echo $link; ?> " title="<?php echo $titulo ?>">
                            <img src="img/banner/<?php echo $imagem ?>" alt="<?php echo $titulo ?>">
                        </a>
                    </div>
                </div>

            <?php } ?> <!-- ENDFOREACH -->

        </div>
    </div>
</div>
<!-- Banner End -->

<!-- Latest Product Section Begin -->
<section class="latest-product spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Produtos Recentes</h4>
                    <div class="latest-product__slider owl-carousel">
                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by id desc limit 3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>

                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>

                            <?php } // END FOREACH
                            ?>
                        </div>


                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by id desc limit 3,3 "); // PARA NÃO REPETIR O CARROSSEL DE CIMA INICIO O LOOP EM 3
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>
                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>

                            <?php } ?>
                        </div>



                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by id desc limit 6,3 "); // PARA NÃO REPETIR O CARROSSEL DE CIMA INICIO O LOOP EM 6
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>
                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>

                            <?php } ?>


                        </div>


                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Mais Vendidos</h4>
                    <div class="latest-product__slider owl-carousel">

                        <div class="latest-prdouct__slider__item">
                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by vendas desc limit 3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>

                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>

                            <?php } // END FOREACH
                            ?>
                        </div>


                        <div class="latest-prdouct__slider__item">
                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by vendas desc limit 3,3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>
                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>
                            <?php } // END FOREACH 
                            ?>
                        </div>



                        <div class="latest-prdouct__slider__item">
                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos where ativo = 'Sim' order by vendas desc limit 6,3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $promocao = $key['promocao'];

                                if ($promocao == 'Sim') {
                                    $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor = $resp[0]['valor'];
                                    $valor = number_format($valor, 2, ',', '.');
                                } else {
                                    $valor = number_format($valor, 2, ',', '.');
                                }
                            ?>
                                <a href="produto-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/produtos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>
                            <?php } //END FOREACH
                            ?>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="latest-product__text">
                    <h4>Combos Promocionais</h4>
                    <div class="latest-product__slider owl-carousel">


                        <div class="latest-prdouct__slider__item">

                            <?php
                            $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos where ativo = 'Sim' order by id desc limit 3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];

                                $valor = number_format($valor, 2, ',', '.');
                            ?>
                                <a href="combo-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>
                            <?php } // END FOREACH 
                            ?>
                        </div>


                        <div class="latest-prdouct__slider__item">
                            <?php
                            $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos  where ativo = 'Sim' order by id desc limit 3,3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];

                                $valor = number_format($valor, 2, ',', '.');
                            ?>
                                <a href="combo-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>

                            <?php } // END FOREACH
                            ?>
                        </div>



                        <div class="latest-prdouct__slider__item">
                            <?php
                            $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos  where ativo = 'Sim'  order by id desc limit 6,3 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];

                                $valor = number_format($valor, 2, ',', '.');
                            ?>
                                <a href="combo-<?php echo $nome_url ?>" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img src="img/combos/<?php echo $imagem ?>" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6><?php echo $nome ?></h6>
                                        <span>R$ <?php echo $valor ?></span>
                                    </div>
                                </a>
                            <?php } // END FOREACH
                            ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Latest Product Section End -->





<?php
require_once("modal-carrinho.php");
require_once("rodape.php");
?>