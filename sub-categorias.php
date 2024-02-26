<?php
require_once('conexao.php');
require_once("cabecalho.php");
require_once("cabecalho-busca.php");

// PEGAR PAGINA ATUAL PARA PAGINAÇÃO
if(@$_GET['pagina'] != null){
    $pag = $_GET['pagina'];
} else{
    $pag = 0;
}

$limite = $pag * @$itens_por_pagina;
$pagina = $pag;
$nome_pag = 'sub-categorias.php';

?>

<?php
// RECUPERAR O NOME DA CATEGORIA PARA FILTRAR AS SUB-CATEGORIAS
$categoria_get = @$_GET['nome'];
// echo $categoria_get;
$query = $pdo->query("SELECT id, nome_url FROM tb_categorias WHERE nome_url = '$categoria_get' ");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
@$id_categoria = @$res[0]['id'];

?>




<!-- Product Section Begin -->
<section class="product spad">
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-5">
                <div class="sidebar">

                    <div class="sidebar__item">
                        <h4>Categorias</h4>
                        <ul>

                            <?php // TRECHO DE CÓDIGO PARA APRESENTAR AS CATEGORIAS NA VITRINE DA LOJA
                            // $query = $pdo->query("SELECT nome, nome_url FROM tb_categorias ORDER BY nome ASC LIMIT $limite, $itens_por_pagina "); // limite onde começa e itens_por_pagina é onde termina
                            $query = $pdo->query("SELECT nome, nome_url FROM tb_categorias ORDER BY nome ASC  ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $row) {
                            ?>
                                <li>
                                    <a href="sub-categoria-de-<?php echo $row['nome_url']; ?>">
                                        <?php echo $row['nome']; ?>
                                    </a>
                                </li>

                            <?php } ?>

                        </ul>
                    </div>

                </div>
            </div>


            <div class="col-lg-9 col-md-7">

                <h5><b>Lista de Sub-Categorias</b></h5>
                <div class="row mt-4">

                    <?php // TRECHO DE CÓDIGO PARA APRESENTAR AS CATEGORIAS NA VITRINE DA LOJA
                    try {
                    if($categoria_get != ""){
                        $query = $pdo->query("SELECT id, nome, nome_url, imagem FROM tb_sub_categorias WHERE id_categoria = '$id_categoria' ORDER BY nome ASC  "); // Váriavel $itens_por_página é GLOBAL está em config.php, sendo acionada por conexão.php que chama config.php
                    
                    } else {
                        $query = $pdo->query("SELECT id, nome, nome_url, imagem FROM tb_sub_categorias order by nome asc LIMIT $limite, $itens_por_pagina "); // Váriavel $itens_por_página é GLOBAL está em config.php, sendo acionada por conexão.php que chama config.php
                    }

                    $res = $query->fetchAll(PDO::FETCH_ASSOC);
                    $total_sub = @count($res);
                    if($total_sub == 0){
                        echo "<h5> Nenhum item para <u>$categoria_get</u> foi encontrado! </h5>";
                    }

                    foreach ($res as $row) {
                        $id = $row['id'];
                        $nome = $row['nome'];
                        $imagem = $row['imagem'];
                        $nome_url = $row['nome_url'];

                        $query_quantidade_produtos = $pdo->query("SELECT id FROM tb_produtos WHERE sub_categoria = '$id' ");

                        $total_itens = $query_quantidade_produtos->rowCount();

                        //BUSCAR O TOTAL DE REGISTROS PARA PAGINAR
                        $query_3 = $pdo->query("SELECT id FROM tb_sub_categorias");
                        $num_total_categorias = $query_3 -> rowCount();
                        $num_paginas = ceil($num_total_categorias / $itens_por_pagina);
                    ?>

                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="img/sub-categorias/<?php echo $imagem ?>">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="produtos-<?php echo $nome_url ?>"><i class="fa fa-eye"></i></a></li>

                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <a href="produtos-<?php echo $nome_url ?>">
                                        <h5> <?php echo $nome?> </h5>
                                        <h6> Contém <?php echo $total_itens ?> item(s) </h6>
                                    </a>
                                </div>
                            </div>
                        </div>

                    <?php }
                    } catch (PDOException $e) {
                        echo "Erro ocorreu provavelmente pelo número de página estar incorreto na URL." /* . $e->getMessage()*/  ;
                    }
                    ?>

                </div>
                
            
                <?php 
                if($categoria_get == "") { ?>
                            
                    <div class="product__pagination">
                        <a href="<?php echo $nome_pag ?>?pagina=0"><i class="fa fa-long-arrow-left"></i></a>

                        <?php
                            for($i = 0; $i < @$num_paginas; $i++) {
                                $estilo = '';
                                if($pagina == $i){
                                    $estilo = 'bg-dark text-light';
                                }

                                if($pagina >= ($i - 2) && $pagina <= ($i + 2)){  ?>
                                    <a 
                                        href="<?php echo $nome_pag?>?pagina=<?php echo $i?>"
                                        class="<?php echo @$estilo ?>" >
                                            <?php echo $i + 1 ?>
                                    </a>
                                <?php }
                            } 
                        ?>
                        
                        <a href="<?php echo $nome_pag ?>?pagina=<?php echo @$num_paginas-1 ?>"><i class="fa fa-long-arrow-right"></i></a>
                    </div>

                <?php } // endif ?>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<?php
require_once("rodape.php");
?>