<?php
require_once("cabecalho.php");
require_once("conexao.php");
?>

<?php
require_once("cabecalho-busca.php");
$tem_cor;
?>

<?php
//recuperar o nome do produto para filtrar os dados dele
$produto_get = @$_GET['nome'];
?>

<?php
//trazer dados do produto
$query = $pdo->query("SELECT * FROM tb_produtos where nome_url = '$produto_get' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);

@$nome = $res[0]['nome'];
@$imagem = $res[0]['imagem'];
@$sub_cat = $res[0]['sub_categoria'];
@$valor = $res[0]['valor'];
@$estoque = $res[0]['estoque'];
@$descricao = $res[0]['descricao'];
@$desc_longa = $res[0]['descricao_longa'];
@$tipo_envio = $res[0]['tipo_envio'];
@$palavras = $res[0]['palavras'];
@$ativo = $res[0]['ativo'];
@$peso = $res[0]['peso'];
@$largura = $res[0]['largura'];
@$altura = $res[0]['altura'];
@$comprimento = $res[0]['comprimento'];
@$modelo = $res[0]['modelo'];
@$valor_frete = $res[0]['valor_frete'];
@$nome_cat = $res[0]['categoria'];
@$promocao = $res[0]['promocao'];
@$id_produto = $res[0]['id'];

if ($modelo == "") {
    $modelo = "Nenhum";
}

if ($promocao == 'Sim') {
    $queryp = $pdo->query("SELECT * FROM tb_promocoes where id_produto = '$id_produto' ");
    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
    $valor = $resp[0]['valor'];
    $desconto = $resp[0]['desconto'];
}
$valor = number_format($valor, 2, ',', '.');
?>

<!-- Product Details Section Begin -->
<section class="product-details spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6">
                <div class="product__details__pic">
                    <div class="product__details__pic__item">
                        <img class="product__details__pic__item--large" src="img/produtos/<?php echo $imagem ?>" alt="">
                    </div>

                    <div class="product__details__pic__slider owl-carousel">

                        <?php
                        $query = $pdo->query("SELECT * FROM tb_imagens where id_produto = '$id_produto' ");
                        $res = $query->fetchAll(PDO::FETCH_ASSOC);

                        for ($i = 0; $i < count($res); $i++) {
                            foreach ($res[$i] as $key => $value) {
                            }

                            $imagem_prod = $res[$i]['imagem'];
                        ?>

                            <img data-imgbigurl="img/produtos/detalhes/<?php echo $imagem_prod ?>" src="img/produtos/detalhes/<?php echo $imagem_prod ?>" alt="">

                        <?php } ?>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="product__details__text">
                    <h3><?php echo $nome ?></h3>
                    <div class="product__details__rating">
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star"></i>
                        <i class="fa fa-star-half-o"></i>
                        <span>(18 reviews)</span>
                    </div>
                    <div class="product__details__price">R$ <?php echo $valor ?></div>
                    <p><?php echo $descricao ?></p>
                    <div class="product__details__quantity">
                        <div class="quantity">
                            <div class="pro-qty">
                                <input type="text" value="1">
                            </div>
                        </div>
                    </div>
                    <a href="#" class="primary-btn">ADD AO CARRINHO</a>
                    <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>




                    <div class="row mt-4">
                        <?php

                        $query2 = $pdo->query("SELECT * from tb_carac_prod where id_prod = '$id_produto' ");
                        $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                        for ($i = 0; $i < count($res2); $i++) {
                            foreach ($res2[$i] as $key => $value) {
                            }

                            $id_carac = $res2[$i]['id_carac'];
                            $id_carac_prod = $res2[$i]['id'];
                            $query3 = $pdo->query("SELECT * from tb_carac where id = '$id_carac' ");
                            $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                            $nome_carac = $res3[0]['nome'];
                            if ($nome_carac == 'Cor') {
                                @$tem_cor = 'Sim';
                            }
                        ?>
                            <div class="mr-3 mt-2">

                                <span>
                                    <select class="form-control form-control-sm" name="categoria" id="categoria">
                                        <?php

                                        echo "<option value='" . $nome_carac . "' >Selecionar " . $nome_carac . "</option>";

                                        $query4 = $pdo->query("SELECT * from tb_carac_itens where id_carac_prod = '$id_carac_prod'");
                                        $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                                        for ($i2 = 0; $i2 < count($res4); $i2++) {
                                            foreach ($res4[$i2] as $key => $value) {
                                            }

                                            echo "<option value='" . $res4[$i2]['id'] . "' >" . $res4[$i2]['nome'] . "</option>";
                                        }


                                        ?>
                                    </select>
                                </span>
                            </div>

                        <?php } ?>



                    </div>



                    <?php if (@$tem_cor == 'Sim') { ?>
                        <div class="mt-4">
                            <?php

                            $query2 = $pdo->query("SELECT * from tb_carac_prod where id_prod = '$id_produto' ");
                            $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
                            for ($i = 0; $i < count($res2); $i++) {
                                foreach ($res2[$i] as $key => $value) {
                                }

                                $id_carac = $res2[$i]['id_carac'];
                                $id_carac_prod = $res2[$i]['id'];
                                $query3 = $pdo->query("SELECT * from tb_carac where id = '$id_carac' ");
                                $res3 = $query3->fetchAll(PDO::FETCH_ASSOC);
                                $nome_carac = $res3[0]['nome'];
                                if ($nome_carac == 'Cor') {

                                    $query4 = $pdo->query("SELECT * from tb_carac_itens where id_carac_prod = '$id_carac_prod'");
                                    $res4 = $query4->fetchAll(PDO::FETCH_ASSOC);
                                    for ($i2 = 0; $i2 < count($res4); $i2++) {
                                        foreach ($res4[$i2] as $key => $value) {
                                        }

                                        echo "<span class='mr-3'><i class='fa fa-circle mr-1' style='color:" . $res4[$i2]['valor_item'] . "'></i>" . $res4[$i2]['nome'] . "</span>";
                                    }
                                }
                            }

                            ?>
                        </div>
                    <?php } ?>




                </div>
            </div>
            <div class="col-lg-12">
                <div class="product__details__tab">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab" aria-selected="true">Descrição</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab" aria-selected="false">Informações</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab" aria-selected="false">Reviews <span>(1)</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tabs-1" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Informações do Produto</h6>
                                <p><?php echo $desc_longa ?></p>
                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-2" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6 class="mb-4">Informações do Produto</h6>
                                <span class="mr-3"><b>Peso</b> <?php echo $peso ?> gramas</span>
                                <span class="mr-3"><b>Altura</b> <?php echo $altura ?> cm</span>
                                <span class="mr-3"><b>Largura</b> <?php echo $largura ?> cm</span>
                                <span class="mr-3"><b>Comprimento</b> <?php echo $comprimento ?> cm</span>
                                <span class="mr-3"><b>Modelo</b> <?php echo $modelo ?></span>
                                <span class="mr-3"><b>Estoque</b> <?php echo $estoque ?></span>

                            </div>
                        </div>
                        <div class="tab-pane" id="tabs-3" role="tabpanel">
                            <div class="product__details__tab__desc">
                                <h6>Products Infomation</h6>
                                <p><?php 
                                        echo $desc_longa;
                                   ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Details Section End -->

<!-- Related Product Section Begin -->
<section class="related-product">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title related__product__title">
                    <h2>Produtos Relacionados</h2>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="categories__slider owl-carousel">

                <?php
                $query = $pdo->query("SELECT * FROM tb_produtos where sub_categoria = '$sub_cat' order by id desc  ");
                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 0; $i < count($res); $i++) {
                    foreach ($res[$i] as $key => $value) {
                    }

                    $nome = $res[$i]['nome'];
                    $valor = $res[$i]['valor'];
                    $nome_url = $res[$i]['nome_url'];
                    $imagem = $res[$i]['imagem'];
                    $promocao = $res[$i]['promocao'];
                    $id = $res[$i]['id'];

                    $valor = number_format($valor, 2, ',', '.');

                    if ($promocao == 'Sim') {
                        $queryp = $pdo->query("SELECT * FROM tb_promocoes where id_produto = '$id' ");
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
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a>
                                    </ul>
                                </div>
                                <div class="product__discount__item__text">

                                    <h5><a href="produto-<?php echo $nome_url ?>"><?php echo $nome ?></a></h5>
                                    <div class="product__item__price">R$ <?php echo $valor_promo ?> <span>R$ <?php echo $valor ?></span></div>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>


                        <div class="col-lg-3 col-md-4 col-sm-6 mix sapatos fresh-meat">
                            <div class="featured__item">
                                <div class="featured__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                    <ul class="featured__item__pic__hover">
                                        <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="featured__item__text">
                                    <a href="produto-<?php echo $nome_url ?>">
                                        <h6><?php echo $nome ?></h6>
                                        <h5>R$ <?php echo $valor ?></h5>
                                    </a>
                                </div>
                            </div>
                        </div>

                <?php }
                } ?>

            </div>

        </div>
    </div>
</section>
<!-- Related Product Section End -->




<?php
require_once("rodape.php");
?>