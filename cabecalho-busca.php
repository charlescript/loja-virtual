<?php
require_once('conexao.php');
?>
<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>Categorias</span>
                    </div>
                    
                    <ul>
                        <?php
                            $query = $pdo->query("SELECT id, nome, nome_url FROM tb_categorias order by nome asc ");
                            $res = $query->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($res as $key) {
                                $id = $key['id'];
                                $nome = $key['nome'];
                                $nome_url = $key['nome_url'];
                        ?>
                            <li>
                                <a href="sub-categoria-de-<?php echo $nome_url; ?>">
                                    <?php echo $nome; ?>
                                </a>
                            </li>
                        <?php } //End FOREACH ?>
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
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->