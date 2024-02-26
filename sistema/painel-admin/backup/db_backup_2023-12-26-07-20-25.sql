DROP TABLE IF EXISTS tb_alertas;

CREATE TABLE `tb_alertas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo_alerta` varchar(20) NOT NULL,
  `titulo_mensagem` varchar(100) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `data` datetime NOT NULL,
  `ativo` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_alertas VALUES("3","Teste","Camisa",NULL,"http://localhost/loja/produto.php","sem-foto.jpg","2023-11-14 15:27:00","Não");
INSERT INTO tb_alertas VALUES("5","Teste Playstation","Playstation 5",NULL,"https://google.com.br","sem-foto.jpg","2023-11-14 15:28:00","Não");
INSERT INTO tb_alertas VALUES("6","Oferta PS5","PS5",NULL,"http://localhost/loja/produto.php","cat-4.jpg","2023-12-24 05:52:00","Não");


DROP TABLE IF EXISTS tb_carac;

CREATE TABLE `tb_carac` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_carac VALUES("3","Cores");
INSERT INTO tb_carac VALUES("4","Numeração");
INSERT INTO tb_carac VALUES("5","Voltagem");
INSERT INTO tb_carac VALUES("6","Tamanho");
INSERT INTO tb_carac VALUES("11","Páginas");


DROP TABLE IF EXISTS tb_carac_itens;

CREATE TABLE `tb_carac_itens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_carac_prod` int NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor_item` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carac_prod` (`id_carac_prod`),
  CONSTRAINT `fk_item_carac_prod` FOREIGN KEY (`id_carac_prod`) REFERENCES `tb_carac_prod` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_carac_itens VALUES("36","42","P",NULL);
INSERT INTO tb_carac_itens VALUES("38","44","Azul","#2340bf");


DROP TABLE IF EXISTS tb_carac_prod;

CREATE TABLE `tb_carac_prod` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_carac` int NOT NULL,
  `id_prod` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_caracteristica_produto` (`id_carac`),
  KEY `fk_produto_caracteristica` (`id_prod`),
  CONSTRAINT `fk_caracteristica_produto` FOREIGN KEY (`id_carac`) REFERENCES `tb_carac` (`id`),
  CONSTRAINT `fk_produto_caracteristica` FOREIGN KEY (`id_prod`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_carac_prod VALUES("42","6","26");
INSERT INTO tb_carac_prod VALUES("44","3","26");
INSERT INTO tb_carac_prod VALUES("45","4","26");
INSERT INTO tb_carac_prod VALUES("46","3","29");
INSERT INTO tb_carac_prod VALUES("47","4","29");


DROP TABLE IF EXISTS tb_categorias;

CREATE TABLE `tb_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_categorias VALUES("16","Moda Masculina","moda-masculina","cat-3.jpg");
INSERT INTO tb_categorias VALUES("17","Moda Feminina","moda-feminina","cat-2.jpg");
INSERT INTO tb_categorias VALUES("18","Tecnologia","tecnologia","fonesJbl-teste-teste.jpg");
INSERT INTO tb_categorias VALUES("19","Relógios","relogios","cat-5.jpg");
INSERT INTO tb_categorias VALUES("20","Calçados","calcados","cat-6.jpg");
INSERT INTO tb_categorias VALUES("21","Eletrônicos Casa","eletronicos-casa","ele-tron-icos.jpg");
INSERT INTO tb_categorias VALUES("22","TVs","tvs","cat_televisor.png");
INSERT INTO tb_categorias VALUES("23","Perfumes","perfumes","perfume2.jpg");
INSERT INTO tb_categorias VALUES("35","Computadores","computadores","note-book-Vaio.jpg");
INSERT INTO tb_categorias VALUES("36","Óculos","oculos","oculos.jpg");
INSERT INTO tb_categorias VALUES("37","Info Produtos","info-produtos","tec.gif");


DROP TABLE IF EXISTS tb_clientes;

CREATE TABLE `tb_clientes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `rua` varchar(80) DEFAULT NULL,
  `numero` varchar(20) DEFAULT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `cidade` varchar(50) DEFAULT NULL,
  `estado` varchar(5) DEFAULT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `cartoes` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_clientes VALUES("1","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tb_clientes VALUES("3","Amanda","15814666099","amanda@gmail.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


DROP TABLE IF EXISTS tb_combos;

CREATE TABLE `tb_combos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `descricao_longa` text NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `tipo_envio` int NOT NULL,
  `palavras` varchar(250) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) NOT NULL,
  `largura` double(8,2) NOT NULL,
  `altura` double(8,2) NOT NULL,
  `comprimento` double(8,2) NOT NULL,
  `valor_frete` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_combos VALUES("8","Tecnologia","tecnologia",NULL,NULL,"500.00","sem-foto.jpg","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","1.00","12.00","1.90","25.00","50.00");
INSERT INTO tb_combos VALUES("9","Jaquetas","jaquetas","Teste","Teste","2000.00","sem-foto.jpg","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","1.00","10.00","10.00","25.00","0.00");
INSERT INTO tb_combos VALUES("11","Perfumes","perfumes",NULL,NULL,"500.00","perfume2.jpg","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","87.00","12.00","10.00","80.00","0.00");
INSERT INTO tb_combos VALUES("12","Combo Blusas","combo-blusas","Teste","Teste","500.00","camisa-masc.jpg","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","10.00","10.00","12.00","12.00","0.00");


DROP TABLE IF EXISTS tb_emails;

CREATE TABLE `tb_emails` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_emails VALUES("1","Charles Rocha dos Santos","rocha_charles@outlook.com","Sim");
INSERT INTO tb_emails VALUES("3","Amanda","amanda@gmail.com","Sim");


DROP TABLE IF EXISTS tb_imagens;

CREATE TABLE `tb_imagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagem_produto` (`id_produto`),
  CONSTRAINT `fk_imagem_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_imagens VALUES("1","29","camisa-masc.jpg");
INSERT INTO tb_imagens VALUES("2","29","camisa-masc.jpg");


DROP TABLE IF EXISTS tb_prod_combos;

CREATE TABLE `tb_prod_combos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `id_combo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prod_combo` (`id_produto`),
  KEY `fk_combo_prod` (`id_combo`),
  CONSTRAINT `fk_combo_prod` FOREIGN KEY (`id_combo`) REFERENCES `tb_combos` (`id`),
  CONSTRAINT `fk_prod_combo` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=235 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_prod_combos VALUES("231","26","12");
INSERT INTO tb_prod_combos VALUES("232","25","12");
INSERT INTO tb_prod_combos VALUES("233","24","12");
INSERT INTO tb_prod_combos VALUES("234","23","12");


DROP TABLE IF EXISTS tb_produtos;

CREATE TABLE `tb_produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` int NOT NULL,
  `sub_categoria` int DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `descricao_longa` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estoque` int NOT NULL,
  `tipo_envio` int NOT NULL,
  `palavras` varchar(250) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `largura` double(8,2) DEFAULT NULL,
  `altura` double(8,2) DEFAULT NULL,
  `comprimento` double(8,2) DEFAULT NULL,
  `modelo` varchar(100) NOT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL,
  `promocao` varchar(5) DEFAULT NULL,
  `vendas` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produto_categoria` (`categoria`),
  KEY `fk_produto_subcategoria` (`sub_categoria`),
  KEY `fk_produto_tipo_envio` (`tipo_envio`),
  CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`categoria`) REFERENCES `tb_categorias` (`id`),
  CONSTRAINT `fk_produto_subcategoria` FOREIGN KEY (`sub_categoria`) REFERENCES `tb_sub_categorias` (`id`),
  CONSTRAINT `fk_produto_tipo_envio` FOREIGN KEY (`tipo_envio`) REFERENCES `tb_tipo_envios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_produtos VALUES("23","18","9","Fone de ouvido","fone-de-ouvido","              Alta qualidade            ","                Alta qualidade            ","100.00","fonesJbl-teste-teste.jpg","10","1","técnologia, qualidade, high surround","Sim","50.00","4.00","70.00","70.00","sony","0.00","Sim","59");
INSERT INTO tb_produtos VALUES("24","18","9","Notebook","notebook","  Notebook alta qualidade          ","  Notebook alta qualidade          ","300.00","notebookSony.jpg","12","1","tecnologia, tech, inovação, modernidade","Sim","2.50","50.00","80.00","70.00","VAIO","0.00","Sim",NULL);
INSERT INTO tb_produtos VALUES("25","18","9","TV PHILCO","tv-philco","              ","              ","2000.00","tv-philco.png","12","1","tecnologia, tech, inovação, modernidade","Sim","12.00","150.00","120.00","150.00","Tela infinita","0.00","Sim",NULL);
INSERT INTO tb_produtos VALUES("26","17","13","Calça Jeans","calca-jeans","     Calça Jeans                                                           ","     Calça Jeans                                                                  ","250.00","Calça-fem.jpg","10","1","Teste","Sim","120.00","70.00","120.00","120.00",NULL,"0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("29","35","15","Teste","teste"," Testando       "," Testando         ","139.99","camisa-masc.jpg","12","1","teste","Sim","10.00","10.00","10.00","10.00",NULL,"0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("30","20","14","Sapato Esporte","sapato-esporte","  Teste","  Teste","500.00","t_sport.gif","10","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","1.00","12.00","10.00","25.00","nike shok","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("31","37",NULL,"Fone JBL","fone-jbl","    ","    ","2999.99","fonesJbl-teste-teste.jpg","12","1","Sandalia melissa, sandalia rosa","Sim","87.00","12.00","10.00","130.00","teste","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("32","20","14","sapatudo","sapatudo"," teste "," tes ","100.00","sem-foto.jpg","12","1","teste","Sim","1.00","10.00","10.00","25.00","Deluxe","0.00","Não",NULL);


DROP TABLE IF EXISTS tb_promocao_banner;

CREATE TABLE `tb_promocao_banner` (
  `id` int NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_promocao_banner VALUES("6","Camisas",NULL,"camisas.jpg","Sim");
INSERT INTO tb_promocao_banner VALUES("7","Sandálias",NULL,"banner-promo-2.jpg","Não");
INSERT INTO tb_promocao_banner VALUES("10","Eletronicos","produto-notebook","tec.gif","Sim");


DROP TABLE IF EXISTS tb_promocoes;

CREATE TABLE `tb_promocoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_produto` int NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `ativo` varchar(3) NOT NULL,
  `desconto` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_promocoes VALUES("1","23","77.00","2023-12-24 00:00:00","2023-12-27 04:03:00","Sim","23 %");
INSERT INTO tb_promocoes VALUES("2","29","97.99","2023-12-25 00:00:00","2023-12-25 22:55:00","Não","30 %");
INSERT INTO tb_promocoes VALUES("4","26","205.00","2023-12-24 00:00:00","2023-12-25 20:31:00","Não","18");
INSERT INTO tb_promocoes VALUES("5","25","1300.00","2023-12-24 00:00:00","2023-12-27 20:55:00","Sim","35 %");
INSERT INTO tb_promocoes VALUES("6","24","237.00","2023-12-24 00:00:00","2023-12-30 00:00:00","Sim","21 %");
INSERT INTO tb_promocoes VALUES("7","30","425.00","2023-12-25 19:54:00","2023-12-25 22:50:00","Não","15 %");
INSERT INTO tb_promocoes VALUES("8","31","2339.99","2023-12-25 19:57:00","2023-12-26 18:55:00","Não","22 %");
INSERT INTO tb_promocoes VALUES("9","32","55.00","2023-12-25 20:56:00","2023-12-25 23:59:00","Não","45 %");


DROP TABLE IF EXISTS tb_sub_categorias;

CREATE TABLE `tb_sub_categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `id_categoria` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategoria_categoria` (`id_categoria`),
  CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_sub_categorias VALUES("7","Calçados Masculinos","calcados-masculinos","bota.jpg","16");
INSERT INTO tb_sub_categorias VALUES("8","Vestidos","vestidos","moda-feminina.jpg","17");
INSERT INTO tb_sub_categorias VALUES("9","Informática","informatica","cat_perifericos.png","18");
INSERT INTO tb_sub_categorias VALUES("10","Calçados Femininos","calcados-femininos","sapato-feminino.jpg","20");
INSERT INTO tb_sub_categorias VALUES("11","Perfume masculino","perfume-masculino","cat_perfume.jpg","23");
INSERT INTO tb_sub_categorias VALUES("12","Perfume Feminino","perfume-feminino","perfume_channel.jpg","23");
INSERT INTO tb_sub_categorias VALUES("13","Calças","calcas","Calça-fem.jpg","17");
INSERT INTO tb_sub_categorias VALUES("14","Tênis de Corrida","tenis-de-corrida","tenis-masculino.jpg","20");
INSERT INTO tb_sub_categorias VALUES("15","Notebooks Gamer","notebooks-gamer","notebook-gamer-dell-g15-intel-co.jpg","35");
INSERT INTO tb_sub_categorias VALUES("16","TEste1","teste1","sem-foto.jpg","20");
INSERT INTO tb_sub_categorias VALUES("17","TEste2","teste2","sem-foto.jpg","20");
INSERT INTO tb_sub_categorias VALUES("22","Teste 7","teste-7","sem-foto.jpg","20");
INSERT INTO tb_sub_categorias VALUES("23","Teste 8","teste-8","sem-foto.jpg","20");
INSERT INTO tb_sub_categorias VALUES("24","Teste 9","teste-9","sem-foto.jpg","20");


DROP TABLE IF EXISTS tb_tipo_envios;

CREATE TABLE `tb_tipo_envios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_tipo_envios VALUES("1","Correios");
INSERT INTO tb_tipo_envios VALUES("2","Valor Fixo");
INSERT INTO tb_tipo_envios VALUES("3","Sem Frete");
INSERT INTO tb_tipo_envios VALUES("6","Digital");


DROP TABLE IF EXISTS tb_usuarios;

CREATE TABLE `tb_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `dt_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

INSERT INTO tb_usuarios VALUES("1","Administrador Charles","00000000000","storesansales@gmail.com","123","202cb962ac59075b964b07152d234b70","Admin","2023-11-07 13:32:22");
INSERT INTO tb_usuarios VALUES("2","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com","Teste1","5d44d60379779d3cd66380eb45f5af27","Cliente","2023-11-13 02:59:40");
INSERT INTO tb_usuarios VALUES("4","Amanda","15814666099","amanda@gmail.com","Teste1","5d44d60379779d3cd66380eb45f5af27","Cliente","2023-11-16 03:47:25");


