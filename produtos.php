<?php
include_once("conexao.php");
include_once("cabecalho.php");
include_once("cabecalho-busca.php");
?>


<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-5">
                <div class="sidebar">
                    <!-- <div class="sidebar__item">
                        <h4>Sub categorias</h4>
                        <ul>
                            <li><a href="#">Fresh Meat</a></li>
                            <li><a href="#">Vegetables</a></li>
                            <li><a href="#">Fruit & Nut Gifts</a></li>
                            <li><a href="#">Fresh Berries</a></li>
                            <li><a href="#">Ocean Foods</a></li>
                            <li><a href="#">Butter & Eggs</a></li>
                            <li><a href="#">Fastfood</a></li>
                            <li><a href="#">Fresh Onion</a></li>
                            <li><a href="#">Papayaya & Crisps</a></li>
                            <li><a href="#">Oatmeal</a></li>
                        </ul>
                    </div> -->
                    <div class="sidebar__item">
                        <h4>Sub Categorias</h4>
                        <ul>
                            <?php
                            $query = $pdo->query("SELECT nome, nome_url FROM tb_sub_categorias order by nome asc ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $nome = $key['nome'];
                                $nome_url = $key['nome_url'];

                            ?>
                                <li><a href="produtos-<?php echo $nome_url ?>"><?php echo $nome ?></a></li>

                            <?php } ?>

                        </ul>
                    </div>
                    <div class="sidebar__item">
                        <h4>Filtrar por valor R$</h4>
                        <div class="price-range-wrap">
                            <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content" data-min="10" data-max="5000">
                                <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                            </div>
                            <div class="range-slider">
                                <div class="price-input">
                                    <form method="GET" action="lista-produtos.php" name="form_valor">
                                        <input type="text" name="valor-inicial" id="minamount">
                                        <input type="text" name="valor-final" id="maxamount">
                                        <a href="#" onclick="document.form_valor.submit(); return false;" class="text-dark">
                                            <i class="fa fa-search ml-2"></i>
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="sidebar__item">
                        <div class="latest-product__text">
                            <h4>Lançamentos</h4>

                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">

                                    <?php
                                    $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos WHERE ativo = 'Sim' order by id desc limit 6 ");
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($res as $key) {
                                        $id = $key['id'];
                                        $nome = $key['nome'];
                                        $valor = $key['valor'];
                                        $nome_url = $key['nome_url'];
                                        $imagem = $key['imagem'];
                                        $promocao = $key['promocao'];

                                        if ($promocao == 'Sim') {
                                            $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' and ativo = 'Sim'");
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
                                    $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos WHERE ativo = 'Sim' order by id desc limit 6,6 "); // PARA NÃO REPETIR O CARROSSEL DE CIMA INICIO O LOOP EM 3
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($res as $key) {
                                        $id = $key['id'];
                                        $nome = $key['nome'];
                                        $valor = $key['valor'];
                                        $nome_url = $key['nome_url'];
                                        $imagem = $key['imagem'];
                                        $promocao = $key['promocao'];

                                        if ($promocao == 'Sim') {
                                            $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' and ativo = 'Sim'");
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
                                    $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao FROM tb_produtos WHERE ativo = 'Sim' order by id desc limit 12,6 "); // PARA NÃO REPETIR O CARROSSEL DE CIMA INICIO O LOOP EM 6
                                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                    foreach ($res as $key) {
                                        $id = $key['id'];
                                        $nome = $key['nome'];
                                        $valor = $key['valor'];
                                        $nome_url = $key['nome_url'];
                                        $imagem = $key['imagem'];
                                        $promocao = $key['promocao'];

                                        if ($promocao == 'Sim') {
                                            $queryp = $pdo->query("SELECT valor FROM tb_promocoes where id_produto = '$id' and ativo = 'Sim' ");
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
                    <!-- -----------------------------------------------------------------------------------------------------------  -->
                    
                    <?php
                        // Essa consulta -> $query_verify_quantidade_registros_combos - serve para verificar quantos combos estão ativos
                        $query_verify_quantidade_registros_combos = $pdo->query("SELECT id FROM tb_combos WHERE ativo = 'Sim'");
                        $quantidade_registros_combos = $query_verify_quantidade_registros_combos->rowCount();
                        
                        // caso haja mais que zero combos essa div -> <div class="section-title product__discount__title mt-4"> é apresentada, caso contrário omite esse trecho de código
                        if ($quantidade_registros_combos > 0) {
                    ?>

                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Combos</h4>

                                <div class="latest-product__slider owl-carousel">


                                    <div class="latest-prdouct__slider__item">

                                        <?php
                                        $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos WHERE ativo = 'Sim' order by id desc limit 6 ");
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
                                        $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos WHERE ativo = 'Sim' order by id desc limit 6,6 ");
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
                                        $query = $pdo->query("SELECT nome, valor, nome_url, imagem FROM tb_combos WHERE ativo = 'Sim' order by id desc limit 12,6 ");
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
                    
                    <?php } else {} // Fim da verificação da existência de combos?>


                    <!----- -----------------------------------------------------------------------------------------------------------  -->

                </div>
            </div>
            <div class="col-lg-9 col-md-7">

                <?php
                    // Essa consulta -> $query_verify_quantidade_registros - serve para verificar quantos produtos estão em promoção
                    $query_verify_quantidade_registros = $pdo->query("SELECT id FROM tb_produtos WHERE promocao = 'Sim' and ativo = 'Sim' ");
                    $quantidade_registros = $query_verify_quantidade_registros->rowCount();
                    
                    // caso haja mais que zero produtos essa div -> <div class="product__discount"> é apresentada, caso contrário omite esse trecho de código
                    if ($quantidade_registros > 0) {
                ?>
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Promoções</h2>
                            <span class="ml-2">
                                <a class="text-muted" href="promocoes.php" title="Ver todas as Promoções">
                                    <small> <i class="fa fa-eye mr-1"></i>Ver todas</small>
                                </a>
                            </span>
                        </div>

                        <div class="row">
                            <div class="product__discount__slider owl-carousel">

                                <?php
                                $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem FROM tb_produtos WHERE promocao = 'Sim' and ativo = 'Sim' ");
                                $res = $query->fetchAll(PDO::FETCH_ASSOC);

                                foreach ($res as $key) {
                                    $id = $key['id'];
                                    $nome = $key['nome'];
                                    $valor_original = $key['valor'];
                                    $nome_url = $key['nome_url'];
                                    $imagem = $key['imagem'];

                                    $queryp = $pdo->query("SELECT valor, desconto FROM tb_promocoes where id_produto = '$id' and ativo = 'Sim' ");
                                    $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                                    $valor_descontado = $resp[0]['valor'];
                                    $desconto = $resp[0]['desconto'];
                                    $valor_descontado = number_format($valor_descontado, 2, ',', '.');
                                ?>

                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                                <div class="product__discount__percent"> <?php echo $desconto ?>% </div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                                    <li><a href="" onclick="carrinhoModal('<?php echo $id ?>' , 'Não' )"> <i class="fa fa-shopping-cart"></i></a></li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <h5><a href="produto-<?php echo $nome_url ?>"> <?php echo $nome ?> </a></h5>
                                                <div class="product__item__price">R$ <?php echo $valor_descontado ?> <span>R$ <?php echo $valor_original ?> </span></div>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?> <!-- ENDFOR -->

                            </div>
                        </div>
                    </div>
                <?php } else {
                } ?>

                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////-->

                <div class="section-title product__discount__title">
                    <h2>Produtos Mais Vendidos</h2>
                    <span class="ml-2">
                        <a class="text-muted" href="lista-produtos.php" title="Ver todos os Produtos">
                            <small> <i class="fa fa-eye mr-1"></i>Ver Todos</small>
                        </a>
                    </span>
                </div>

                <div class="row">

                    <?php
                    $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem, promocao, vendas FROM tb_produtos WHERE ativo = 'Sim' ORDER BY vendas DESC LIMIT 6");
                    $res = $query->fetchAll(PDO::FETCH_ASSOC);

                    foreach ($res as $key) {
                        $id = $key['id'];
                        $nome = $key['nome'];
                        $valor_original = $key['valor'];
                        $nome_url = $key['nome_url'];
                        $imagem = $key['imagem'];
                        $promocao = $key['promocao'];

                        if ($promocao == 'Sim') {
                            $queryp = $pdo->query("SELECT valor, desconto FROM tb_promocoes where id_produto = '$id' and ativo = 'Sim'");
                            $resp = $queryp->fetchAll(PDO::FETCH_ASSOC);
                            $valor_descontado = $resp[0]['valor'];
                            $desconto = $resp[0]['desconto'];
                            $valor_descontado = number_format($valor_descontado, 2, ',', '.');
                    ?>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__discount__item">
                                    <div class="product__discount__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                        <div class="product__discount__percent"> <?php echo $desconto ?>% </div>
                                        <ul class="product__item__pic__hover">
                                            <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="" onclick="carrinhoModal('<?php echo $id ?>' , 'Não' )"> <i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__discount__item__text">
                                        <h5><a href="produto-<?php echo $nome_url ?>"> <?php echo $nome ?> </a></h5>
                                        <div class="product__item__price">R$ <?php echo $valor_descontado ?> <span>R$ <?php echo $valor_original ?> </span></div>
                                    </div>
                                </div>
                            </div>

                        <?php } // END IF
                        else { ?>

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="img/produtos/<?php echo $imagem ?>">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="produto-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                            <li><a href="" onclick="carrinhoModal('<?php echo $id ?>' , 'Não' )"> <i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <h6><a href="produto.php"><?php echo $nome ?></h6>
                                        <h5>R$ <?php echo $valor_original ?> </h5> </a>
                                    </div>
                                </div>
                            </div>

                    <?php } // END ELSE
                    } // END FOREACH
                    ?>

                </div>

                <!-- ////////////////////////////////////////////////////////////////////////////////////////////////-->
                
                <?php
                    // Essa consulta -> $query_verify_quantidade_registros_combos - serve para verificar quantos combos estão ativos
                    $query_verify_quantidade_registros_combos = $pdo->query("SELECT id FROM tb_combos WHERE ativo = 'Sim'");
                    $quantidade_registros_combos = $query_verify_quantidade_registros_combos->rowCount();
                    
                    // caso haja mais que zero combos essa div -> <div class="section-title product__discount__title mt-4"> é apresentada, caso contrário omite esse trecho de código
                    if ($quantidade_registros_combos > 0) {
                ?>

                        <div class="section-title product__discount__title mt-4">
                            <h2>Combos Mais Vendidos</h2>
                            <span class="ml-2">
                                <a class="text-muted" href="combos.php" title="Ver todos os Combos">
                                    <small> <i class="fa fa-eye mr-1"></i>Ver Todos</small>
                                </a>
                            </span>
                        </div>

                        <div class="row">

                            <?php
                            $query = $pdo->query("SELECT id, nome, valor, nome_url, imagem FROM tb_combos WHERE ativo = 'Sim' order by vendas desc limit 6 ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $nome = $key['nome'];
                                $valor = $key['valor'];
                                $nome_url = $key['nome_url'];
                                $imagem = $key['imagem'];
                                $id_combo = $key['id'];  //combos

                                $valor = number_format($valor, 2, ',', '.');
                            ?>
                                <div class="col-lg-4 col-md-6 col-sm-6">
                                    <div class="product__item">
                                        <div class="product__item__pic set-bg" data-setbg="img/combos/<?php echo $imagem ?>">
                                            <ul class="product__item__pic__hover">
                                                <li><a href="combo-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>
                                                <li><a href="" onclick="carrinhoModal('<?php echo $id_combo ?>' , 'Sim' )"> <i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="product__item__text">
                                            <a href="combo-<?php echo $nome_url ?>">
                                                <h6><b><?php echo $nome ?> </b></h6>
                                                <h5>R$ <?php echo $valor ?> </h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                            <?php } ?>
                        </div>

                <?php } else { } // fechamento da verificação de quantidade de combos?> 

            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require_once("modal-carrinho.php");
require_once("rodape.php");
?>