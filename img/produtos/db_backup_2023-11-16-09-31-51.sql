DROP TABLE IF EXISTS tb_alertas;

CREATE TABLE `tb_alertas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_alerta` varchar(20) NOT NULL,
  `titulo_mensagem` varchar(100) NOT NULL,
  `mensagem` varchar(1000) NOT NULL,
  `link` varchar(100) DEFAULT NULL,
  `imagem` varchar(100) DEFAULT NULL,
  `data` datetime NOT NULL,
  `ativo` varchar(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_carac;

CREATE TABLE `tb_carac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tb_carac VALUES("1","Cor");


DROP TABLE IF EXISTS tb_carac_itens;

CREATE TABLE `tb_carac_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carac_prod` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor_item` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carac_prod` (`id_carac_prod`),
  CONSTRAINT `fk_item_carac_prod` FOREIGN KEY (`id_carac_prod`) REFERENCES `tb_carac_prod` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_carac_prod;

CREATE TABLE `tb_carac_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carac` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_caracteristica_produto` (`id_carac`),
  KEY `fk_produto_caracteristica` (`id_prod`),
  CONSTRAINT `fk_caracteristica_produto` FOREIGN KEY (`id_carac`) REFERENCES `tb_carac` (`id`),
  CONSTRAINT `fk_produto_caracteristica` FOREIGN KEY (`id_prod`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_categorias;

CREATE TABLE `tb_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

INSERT INTO tb_categorias VALUES("1","Computadores","computadores","cat_computador.png");
INSERT INTO tb_categorias VALUES("2","Notebooks","notebooks","cat_notebook.png");
INSERT INTO tb_categorias VALUES("3","Televisores","televisores","cat_televisor.png");
INSERT INTO tb_categorias VALUES("4","Informática Periféricos","informatica-perifericos","cat_perifericos.png");
INSERT INTO tb_categorias VALUES("5","Livros","livros","cat_livros.png");
INSERT INTO tb_categorias VALUES("6","Moda Masculina","moda-masculina","cat-3.jpg");
INSERT INTO tb_categorias VALUES("7","Jóias e Semi Jóias","joias-e-semi-joias","cat-7.jpg");
INSERT INTO tb_categorias VALUES("8","Moda Feminina","moda-feminina","cat-2.jpg");
INSERT INTO tb_categorias VALUES("9","Relógios","relogios","cat-5.jpg");


DROP TABLE IF EXISTS tb_clientes;

CREATE TABLE `tb_clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `cartoes` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tb_clientes VALUES("1","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


DROP TABLE IF EXISTS tb_combos;

CREATE TABLE `tb_combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `descricao_longa` text NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `tipo_envio` int(1) NOT NULL,
  `palavras` varchar(250) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) NOT NULL,
  `largura` double(8,2) NOT NULL,
  `altura` double(8,2) NOT NULL,
  `comprimento` double(8,2) NOT NULL,
  `valor_frete` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_emails;

CREATE TABLE `tb_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tb_emails VALUES("1","Charles Rocha dos Santos","rocha_charles@outlook.com","Não");


DROP TABLE IF EXISTS tb_imagens;

CREATE TABLE `tb_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagem_produto` (`id_produto`),
  CONSTRAINT `fk_imagem_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_prod_combos;

CREATE TABLE `tb_prod_combos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_combo` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_prod_combo` (`id_produto`),
  KEY `fk_combo_prod` (`id_combo`),
  CONSTRAINT `fk_combo_prod` FOREIGN KEY (`id_combo`) REFERENCES `tb_combos` (`id`),
  CONSTRAINT `fk_prod_combo` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_produtos;

CREATE TABLE `tb_produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria` int(11) NOT NULL,
  `sub_categoria` int(11) DEFAULT NULL,
  `nome` varchar(100) NOT NULL,
  `nome_url` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `descricao_longa` text NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `estoque` int(11) NOT NULL,
  `tipo_envio` int(11) NOT NULL,
  `palavras` varchar(250) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  `peso` double(8,2) DEFAULT NULL,
  `largura` double(8,2) DEFAULT NULL,
  `altura` double(8,2) DEFAULT NULL,
  `comprimento` double(8,2) DEFAULT NULL,
  `modelo` varchar(100) NOT NULL,
  `valor_frete` decimal(8,2) DEFAULT NULL,
  `promocao` varchar(5) NOT NULL,
  `vendas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_produto_categoria` (`categoria`),
  KEY `fk_produto_subcategoria` (`sub_categoria`),
  KEY `fk_produto_tipo_envio` (`tipo_envio`),
  CONSTRAINT `fk_produto_categoria` FOREIGN KEY (`categoria`) REFERENCES `tb_categorias` (`id`),
  CONSTRAINT `fk_produto_subcategoria` FOREIGN KEY (`sub_categoria`) REFERENCES `tb_sub_categorias` (`id`),
  CONSTRAINT `fk_produto_tipo_envio` FOREIGN KEY (`tipo_envio`) REFERENCES `tb_tipo_envios` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tb_produtos VALUES("1","3",NULL,"Samsung 60BU8000 - Smart TV LED 60\' 4K","samsung-60bu8000-smart-tv-led-60\'-4k","Tamanho da tela	60\nMarca	SAMSUNG\nTecnologia do visor	LED\nDimensões do produto	15,8D x 151W x 90,6H centímetros\nResolução	4K\nTaxa de atualização	60 Hz\nCaracterísticas especiais	Plana\nNome do modelo	UN60BU8000GXZD\nComponentes incluídos	Controle, Kit de pilhas\nTecnologia de conectividade	Wi-fi"," Sobre este item\nTamanho da tela: 60\" Tecnologia de conectividade: Bluetooth, Wi-fi, USB, Ethernet, HDMI\nMarca: SAMSUNG Resolução: 4K\nPeso do produto: 19 Quilogramas Tecnologia de comunicação sem fio: Bluetooth, Wi-fi\nPaís de origem do produto: BR","2943.80","televisao_samsung_UN60BU8000GXZD.jpg","12","1","tecnologia, tech, inovação, modernidade","Sim","15.80","151.00","90.60","151.00","UN60BU8000GXZD","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("3","1",NULL,"Notebook VAIO FE15, Intel® Core i5","notebook-vaio-fe15,-intel","    Sobre este item\nProcessador Intel 11th, placa gráfica Intel UHD Graphics e SSD NVMe\nTela de LCD 15.6” Full HD antirreflexiva\nWebcam de alta definição (HD) e Microfone Digital\nBateria de alta capacidade com autonomia de até 10 horas\nLeve e prático, pesando apenas 1,75kg  ","    \nMarca	VAIO\nNome do modelo	VJFE55F11X-B0211H\nTamanho da tela	15,6 Polegadas\nCor	Cinza\nTamanho do disco rígido	512 GB\nModelo da CPU	Core i5-1130G7\nTamanho instalado da memória RAM	8 GB\nSistema operacional	Windows 11 Home\nCaracterísticas especiais	Teclado Numérico\nDescrição da placa de vídeo  ","3199.99","notebookSony.jpg","12","1","tecnologia, tech, inovação, modernidade, notebook, notebooks","Sim","1.75","46.00","28.50","46.00","VJFE55F11X-B0211H","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("4","3",NULL,"Televisor LG","televisor-lg","  Teste","  TEste","2499.50","tv_2.png","20","1","tecnologia, tech, inovação, modernidade","Sim","23.00","120.00","80.00","120.00","65UR8750PSA","0.00","Não",NULL);


DROP TABLE IF EXISTS tb_promocao_banner;

CREATE TABLE `tb_promocao_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_promocoes;

CREATE TABLE `tb_promocoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `ativo` varchar(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



DROP TABLE IF EXISTS tb_sub_categorias;

CREATE TABLE `tb_sub_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subcategoria_categoria` (`id_categoria`),
  CONSTRAINT `fk_subcategoria_categoria` FOREIGN KEY (`id_categoria`) REFERENCES `tb_categorias` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

INSERT INTO tb_sub_categorias VALUES("1","Calçados Masculinos","calcados-masculinos","sap_sociais.png","6");
INSERT INTO tb_sub_categorias VALUES("2","Calçados Femininos","calcados-femininos","calcados_femininos.png","8");
INSERT INTO tb_sub_categorias VALUES("3","Teclado","teclado","teclados.png","4");
INSERT INTO tb_sub_categorias VALUES("4","Blusas Masculinas","blusas-masculinas","camisa-masc.jpg","6");
INSERT INTO tb_sub_categorias VALUES("5","Relógios Sociais","relogios-sociais","cat-5.jpg","9");


DROP TABLE IF EXISTS tb_tipo_envios;

CREATE TABLE `tb_tipo_envios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tb_tipo_envios VALUES("1","Correios");
INSERT INTO tb_tipo_envios VALUES("2","Valor Fixo");
INSERT INTO tb_tipo_envios VALUES("3","Sem Frete");
INSERT INTO tb_tipo_envios VALUES("4","Digital");


DROP TABLE IF EXISTS tb_usuarios;

CREATE TABLE `tb_usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(35) NOT NULL,
  `senha_crip` varchar(150) NOT NULL,
  `nivel` varchar(20) NOT NULL,
  `dt_cadastro` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO tb_usuarios VALUES("1","Administrador_Charles","000.000.000-00","store@sansales.com.br","82a6c15p@@##!!","81692b3a3a717bc06abee947e396df1a","Admin","2023-11-16 18:11:33");
INSERT INTO tb_usuarios VALUES("2","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com","Teste1","5d44d60379779d3cd66380eb45f5af27","Cliente","2023-11-16 21:29:49");


