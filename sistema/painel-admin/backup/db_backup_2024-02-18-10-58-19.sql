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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

INSERT INTO tb_alertas VALUES("1","Perfume","Perfume","Teste",NULL,"perfume2.jpg","2024-02-18 17:43:00","Não");


DROP TABLE IF EXISTS tb_carac;

CREATE TABLE `tb_carac` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_carac VALUES("1","Voltagem");
INSERT INTO tb_carac VALUES("2","COR");
INSERT INTO tb_carac VALUES("3","AMPERAGEM");


DROP TABLE IF EXISTS tb_carac_itens;

CREATE TABLE `tb_carac_itens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carac_prod` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `valor_item` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_item_carac_prod` (`id_carac_prod`),
  CONSTRAINT `fk_item_carac_prod` FOREIGN KEY (`id_carac_prod`) REFERENCES `tb_carac_prod` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO tb_carac_itens VALUES("1","1","Bivolt",NULL);
INSERT INTO tb_carac_itens VALUES("2","2","Branco","#FFFFFF");


DROP TABLE IF EXISTS tb_carac_itens_car;

CREATE TABLE `tb_carac_itens_car` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_carrinho` int(11) NOT NULL,
  `id_carac` int(11) NOT NULL,
  `nome` varchar(35) NOT NULL,
  PRIMARY KEY (`id`)
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

INSERT INTO tb_carac_prod VALUES("1","1","17");
INSERT INTO tb_carac_prod VALUES("2","2","17");


DROP TABLE IF EXISTS tb_carrinho;

CREATE TABLE `tb_carrinho` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `data` date NOT NULL,
  `combo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

INSERT INTO tb_carrinho VALUES("1","5","1","4",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("3",NULL,"1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("4","5","1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("5",NULL,"1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("6","2","1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("7","2","1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("8",NULL,"1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("9","3","1","5",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("10","3","3","3",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("11","3","3","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("12","1","1","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("13","1","3","1",NULL,"2024-02-18","1");
INSERT INTO tb_carrinho VALUES("14","1","4","1",NULL,"2024-02-18","1");


DROP TABLE IF EXISTS tb_categorias;

CREATE TABLE `tb_categorias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `nome_url` varchar(50) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tb_categorias VALUES("1","Eletrônicos","eletronicos","ele-tron-icos.jpg");
INSERT INTO tb_categorias VALUES("2","Para Casa","para-casa","para_casa.jpg");
INSERT INTO tb_categorias VALUES("3","Acessórios para celular","acessorios-para-celular","acessorios_celular.jpg");
INSERT INTO tb_categorias VALUES("4","Beleza","beleza","barbear2.jpeg");


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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_clientes VALUES("1","teste","21605881058","teste1@gmail.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tb_clientes VALUES("2","Teste patricia","94538024090","patricia@hotmail.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
INSERT INTO tb_clientes VALUES("3","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com",NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);


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
  `vendas` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_combos VALUES("1","Combo de relogios","combo-de-relogios","Eletronicos","Eletronicos","1000.00","cat-5.jpg","1","eletronico","Sim","1500.00","20.00","30.00","30.00","0.00",NULL);
INSERT INTO tb_combos VALUES("2","Moda Masculina","moda-masculina","Teste","Teste","5000.00","Camisa-azul.jpg","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","200.00","10.00","1.90","130.00","0.00",NULL);
INSERT INTO tb_combos VALUES("3","Relógios","relogios","teste","tassd","200.00","perfume2.jpg","1","tetrasr","Sim","1.00","10.00","10.00","130.00","0.00",NULL);


DROP TABLE IF EXISTS tb_emails;

CREATE TABLE `tb_emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_emails VALUES("1","teste","teste1@gmail.com","Sim");
INSERT INTO tb_emails VALUES("2","Teste patricia","patricia@hotmail.com","Sim");
INSERT INTO tb_emails VALUES("3","Charles Rocha dos Santos","rocha_charles@outlook.com","Sim");


DROP TABLE IF EXISTS tb_imagens;

CREATE TABLE `tb_imagens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_imagem_produto` (`id_produto`),
  CONSTRAINT `fk_imagem_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;

INSERT INTO tb_imagens VALUES("1","3","fone_jbl_sem_fio.2.jpeg");
INSERT INTO tb_imagens VALUES("2","3","fone_jbl_sem_fio3.jpeg");
INSERT INTO tb_imagens VALUES("3","3","fone_jbl_sem_fio4.jpeg");
INSERT INTO tb_imagens VALUES("4","4","fone_bluetooth2.jpeg");
INSERT INTO tb_imagens VALUES("5","4","fone_bluetooth3.jpeg");
INSERT INTO tb_imagens VALUES("6","5","lampadaCamera VR Cam2.jpeg");
INSERT INTO tb_imagens VALUES("7","5","lampadaCamera VR Cam3.jpeg");
INSERT INTO tb_imagens VALUES("8","6","lampadabluetoothWJ-L2_2.jpeg");
INSERT INTO tb_imagens VALUES("9","6","lampadabluetoothWJ-L2_3.jpeg");
INSERT INTO tb_imagens VALUES("10","6","lampadabluetoothWJ-L2_4.jpeg");
INSERT INTO tb_imagens VALUES("12","7","Balana de alimentos.jpeg");
INSERT INTO tb_imagens VALUES("13","7","Balana de alimentos2.jpeg");
INSERT INTO tb_imagens VALUES("14","8","liquidificadorPortatil.jpeg");
INSERT INTO tb_imagens VALUES("15","11","caixa_som_capa2.jpg");
INSERT INTO tb_imagens VALUES("16","12","lanterna3.jpeg");
INSERT INTO tb_imagens VALUES("17","12","lanterna4.jpeg");
INSERT INTO tb_imagens VALUES("18","12","lanterna5.jpeg");
INSERT INTO tb_imagens VALUES("19","14","gimble_2.jpeg");
INSERT INTO tb_imagens VALUES("20","14","gimble_2.jpeg");
INSERT INTO tb_imagens VALUES("21","16","barbear2.jpeg");
INSERT INTO tb_imagens VALUES("22","16","barbear3.jpeg");
INSERT INTO tb_imagens VALUES("23","17","pocessador_alimentos_2.jpeg");


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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

INSERT INTO tb_prod_combos VALUES("1","3","1");
INSERT INTO tb_prod_combos VALUES("5","14","1");
INSERT INTO tb_prod_combos VALUES("6","8","3");
INSERT INTO tb_prod_combos VALUES("7","9","3");
INSERT INTO tb_prod_combos VALUES("8","10","3");
INSERT INTO tb_prod_combos VALUES("9","17","2");
INSERT INTO tb_prod_combos VALUES("10","15","2");


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
  `largura` int(11) DEFAULT NULL,
  `altura` int(11) DEFAULT NULL,
  `comprimento` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

INSERT INTO tb_produtos VALUES("1","1","2","Eletronico TEste","eletronico-teste","  Teste    ","  Teste    ","500.00","caixa_som_capa1.jpg","12","1","tenis masculino, tenis esportivo, tenis de qualidade","Sim","1.00","10","10","25","teste","0.00","Sim",NULL);
INSERT INTO tb_produtos VALUES("3","1","2","Fone JBL - Everest JB950","fone-jbl-everest-jb950","      Experimente o som cristalino do Fone JBL Everest JB950. Design elegante, conforto supremo e tecnologia avançada de cancelamento de ruído. Uma experiência auditiva imersiva como nunca antes.    ","      Descrição longa (500 caracteres):\nO Fone JBL Everest JB950 redefine a qualidade sonora, oferecendo uma experiência auditiva envolvente. Com drivers potentes, produz áudio cristalino em todas as frequências. Seu design elegante combina estilo e conforto, com almofadas ergonômicas que garantem horas de uso sem fadiga. A tecnologia avançada de cancelamento de ruído proporciona um isolamento acústico perfeito, permitindo que você mergulhe totalmente na sua música ou chamada. A conectividade Bluetooth sem fio permite a reprodução de dispositivos compatíveis, enquanto a bateria de longa duração garante que a música nunca pare. O Everest JB950 é mais do que um fone de ouvido, é uma experiência sensorial completa. Desfrute da liberdade musical com este acessório premium da JBL.    ","84.99","fone_jbl_sem_fio.jpeg","15","1","fones de ouvido, fones, headphones, som, música, jbl, ","Sim","120.00","15","15","15","Everest JB950","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("4","1","4","Fone bluetooth - PEI-M513","fone-bluetooth-pei-m513","     Fone Bluetooth PEI-M513 oferece áudio imersivo e design elegante. Sem fios, confortável e compatível com dispositivos. Uma experiência sonora sem limites.   ","     O Fone Bluetooth PEI-M513 redefine a forma como você experimenta o áudio. Combinando tecnologia avançada e design elegante, este fone oferece uma experiência imersiva e sem fios. Os drivers de alta qualidade garantem um som nítido em todas as frequências, enquanto o design ergonômico proporciona conforto prolongado. A conectividade Bluetooth permite emparelhamento fácil com dispositivos compatíveis, proporcionando liberdade de movimento. Além disso, o PEI-M513 é leve e portátil, facilitando o transporte. Desfrute da versatilidade e da qualidade sonora excepcional deste fone que se adapta perfeitamente ao seu estilo de vida conectado.   ","120.00","fone_bluetooth.jpeg","20","1","fones de ouvido, fones, headphones, som, música, sem fio, bluetooth ","Sim","90.00","10","5","10","PEI-M513","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("5","1",NULL,"Lâmpada Câmera - VR Cam","lampada-camera-vr-cam","  A Lâmpada Câmera VR Cam combina iluminação eficiente com vigilância discreta. Controle remoto, visão noturna e detecção de movimento para segurança total.","  A Lâmpada Câmera VR Cam é a solução perfeita para iluminação e segurança inteligentes. Esta lâmpada discreta possui uma câmera integrada que oferece vigilância 24 horas. Com controle remoto, ajuste a intensidade da luz e monitore sua casa ou escritório de qualquer lugar. A visão noturna garante clareza mesmo em condições de pouca luz, e a detecção de movimento aciona alertas instantâneos. A integração com aplicativos facilita o acesso ao feed ao vivo e ao histórico de gravações. Além de iluminar seus espaços, a VR Cam garante tranquilidade, proporcionando uma solução de vigilância discreta e eficaz.","139.99","lampadaCamera-VR-Cam.jpeg","33","1","lâmpada, câmera, video, camera, iluminação","Sim","120.00","11","14","14","VR Cam","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("6","1",NULL,"Lâmpada bluetooth - WJ-L2","lampada-bluetooth-wj-l2","  A Lâmpada Bluetooth WJ-L2 une iluminação ambiente à conectividade moderna. Controle via smartphone, cores personalizáveis e qualidade de som excepcional.","  A Lâmpada Bluetooth WJ-L2 é mais do que uma fonte de luz; é uma experiência completa. Com a capacidade de ajustar a cor e a intensidade da luz através do smartphone, você cria atmosferas personalizadas. Além disso, integra alto-falantes de alta qualidade, permitindo que você desfrute de músicas com qualidade excepcional, tornando qualquer ambiente mais envolvente. A conectividade Bluetooth facilita o emparelhamento com dispositivos, proporcionando controle total. Seja para iluminar sua casa, criar um ambiente relaxante ou animar uma festa, a WJ-L2 é a escolha perfeita para aqueles que buscam funcionalidade e estilo em um só produto.","55.00","lampadabluetoothWJ-L2.jpeg","33","1","lâmpada, som, música, camera, iluminação, bluetooth","Sim","120.00","10","15","15","WJ-L2","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("7","2",NULL,"Balança de alimentos","balanca-de-alimentos","   Precisão na sua dieta! A Balança de Alimentos oferece medições exatas, design compacto e tela fácil de ler. Ideal para quem busca controle na alimentação. ","   A Balança de Alimentos é uma ferramenta essencial para quem procura manter uma dieta equilibrada. Com precisão milimétrica, permite medir porções exatas, tornando o controle de calorias e nutrientes mais eficiente. Seu design compacto facilita o armazenamento e uso em qualquer lugar. A tela de fácil leitura exibe resultados instantâneos, tornando a experiência intuitiva. Ideal para quem busca perda de peso, ganho de massa muscular ou simplesmente um estilo de vida saudável. Simplifique a gestão da sua dieta com esta balança que coloca o controle na ponta dos seus dedos. ","50.00","Balana-de-alimentos1.jpeg","22","1","balança, saúde, precisão, alimentos, balança de precisão","Sim","3000.00","20","12","30",NULL,"0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("8","2","1","Liquidificador Portátil - Legumes","liquidificador-portatil-legumes","    Liquidificador Portátil com cápsula de vidro: potência sem fio para smoothies perfeitos em movimento. Compacto, leve e eficiente.  ","    O Liquidificador Portátil com cápsula de vidro é a solução ideal para quem busca praticidade na preparação de bebidas saudáveis em qualquer lugar. Com design sem fio, bateria recarregável e potência surpreendente, este liquidificador compacto é perfeito para smoothies, sucos e shakes em movimento. Sua cápsula de vidro durável é fácil de limpar e mantém a pureza dos ingredientes. Além disso, sua estrutura leve facilita o transporte. Seja na academia, escritório ou ao ar livre, tenha a praticidade de preparar suas bebidas favoritas com qualidade e eficiência. O Liquidificador Portátil é a escolha inteligente para um estilo de vida saudável e dinâmico.  ","120.00","liquidificadorPortatil_1.jpeg","15","1","liquidificador, portátil, legumes, corte","Sim","1500.00","15","25","25","Tomato","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("9","3",NULL,"Microfone para Celular","microfone-para-celular","  Microfone para Celular: clareza sonora excepcional em gravações e chamadas. Compacto e plug-and-play para elevar a qualidade do áudio no seu dispositivo.","  O Microfone para Celular oferece uma melhoria significativa na qualidade do áudio em suas gravações e chamadas. Compatível com diversos dispositivos, este microfone compacto é plug-and-play, eliminando a necessidade de configurações complicadas. Sua tecnologia avançada captura sons com clareza excepcional, tornando cada gravação, transmissão ao vivo ou chamada telefônica uma experiência mais nítida e profissional. O design portátil permite fácil transporte, sendo ideal para criadores de conteúdo, profissionais em trânsito ou entusiastas de áudio. Eleve o padrão do seu som com o Microfone para Celular, uma escolha acessível para melhorar a qualidade sonora em seus dispositivos móveis.","85.00","Microfone-para-Celular.jpeg","15","1","microfone, acessório, celular, áudio","Sim","90.00","5","9","9",NULL,"0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("10","3",NULL,"Suporte para moto / celular","suporte-para-moto-/-celular","Suporte para moto/celular: segurança e praticidade em suas viagens. Fixação estável, ajustável e rotação 360° para uma experiência de condução conectada.","  O Suporte para moto/celular combina segurança e praticidade em suas jornadas. Com uma fixação estável e ajustável, mantém seu celular seguro durante a condução. A rotação de 360° oferece flexibilidade para visualização em diferentes ângulos. O suporte é compatível com uma variedade de modelos de moto e celulares, proporcionando versatilidade. Seja para usar aplicativos de navegação, atender chamadas ou ouvir música, este suporte facilita o acesso ao seu dispositivo enquanto mantém as mãos no guidão. Desfrute de uma experiência de condução conectada e segura com o Suporte para moto/celular, um aliado essencial para os motociclistas modernos.","37.00","suporte_celular_moto.jpeg","22","1","suporte celular, suporte moto, suporte gps","Sim","150.00","12","15","15","suporte","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("11","1","2","Caixa de som Bommax","caixa-de-som-bommax","  Caixa de som Bommax: Som potente, design elegante. Conectividade Bluetooth, resistência à água e bateria duradoura para uma experiência musical completa.","  A Caixa de som Bommax proporciona uma experiência musical envolvente. Com um som potente e claro, esta caixa de som é ideal para animar festas, passeios ao ar livre ou simplesmente curtir música em casa. Equipada com conectividade Bluetooth, permite fácil emparelhamento com dispositivos compatíveis. Seu design elegante combina estilo com funcionalidade, enquanto a resistência à água oferece versatilidade em diferentes ambientes. A bateria de longa duração garante horas de reprodução contínua. Leve a sua música para onde quiser com a Caixa de som Bommax, uma escolha versátil para os amantes da música em movimento.","40.00","caixa_som_capa1.jpg","21","1","caixa de som, som, áudio, música","Sim","700.00","20","15","20","Bommax","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("12","1","3","Lanterna - Kapbom KA-L1315","lanterna-kapbom-ka-l1315","  Lanterna Kapbom KA-L1315: potente, compacta e resistente. Feixe de luz focado para diversas situações. Ideal para aventuras ao ar livre e emergências.","  A Lanterna Kapbom KA-L1315 é a escolha perfeita para iluminação confiável em diversas situações. Seu design compacto esconde uma potência impressionante, oferecendo um feixe de luz focado para aventuras ao ar livre, camping, caminhadas ou situações de emergência. Construída com durabilidade em mente, esta lanterna resistente é projetada para resistir às condições mais adversas. O interruptor de fácil acesso permite alternar entre modos de iluminação, enquanto o formato ergonômico facilita o manuseio. Seja para explorar a natureza ou garantir a segurança em casa, a Lanterna Kapbom KA-L1315 é sua companheira confiável para iluminação em qualquer situação.","54.99","lanterna2.jpeg","33","1","lanterna, luz","Sim","450.00","10","22","22","Kapbom KA-L1315","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("13","1","4","Fone bluetooth - FON-20418","fone-bluetooth-fon-20418","   Fone Bluetooth FON-20418: Som imersivo, design ergonômico. Sem fios para total liberdade. Perfeito para música e chamadas com alta qualidade. ","   O Fone Bluetooth FON-20418 oferece uma experiência auditiva envolvente com som de alta qualidade e design ergonômico. Sem fios, proporciona liberdade total de movimento, seja durante atividades físicas, viagens ou no dia a dia. Com conectividade Bluetooth, emparelhamento fácil e estável com dispositivos compatíveis. Seu design ergonômico garante conforto prolongado, enquanto os controles intuitivos permitem ajustes sem esforço. A qualidade de som nítido se estende tanto para músicas quanto para chamadas, tornando-o um companheiro versátil para o entretenimento e a comunicação. O FON-20418 é a escolha perfeita para quem busca praticidade, conforto e desempenho sonoro em um fone de ouvido Bluetooth. ","95.00","fone_ouvido_sem_fio_blue.jpeg","7","1","fones de ouvido, fones, headphones, som, música, sem fio, bluetooth ","Sim","200.00","10","7","10"," FON-20418","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("14","3",NULL,"Gimbal estabilizador de celular H4","gimbal-estabilizador-de-celular-h4","  Gimbal estabilizador de celular H4: Estabilidade excepcional para vídeos suaves. Leve, portátil e fácil de usar, elevando a qualidade das suas gravações.","  O Gimbal estabilizador de celular H4 redefine a forma como você captura vídeos. Com estabilidade excepcional, proporciona gravações suaves e profissionais em movimento. Sua construção leve e portátil permite fácil transporte, sendo perfeito para viagens, vlogs ou produções cinematográficas amadoras. Com controles intuitivos, o H4 é fácil de usar, mesmo para iniciantes. A rotação de 3 eixos oferece flexibilidade para capturar momentos de todos os ângulos. Compatível com uma variedade de smartphones, é uma ferramenta versátil para entusiastas da criação de conteúdo. Eleve a qualidade das suas gravações com o Gimbal estabilizador de celular H4, o parceiro ideal para videomakers que buscam resultados profissionais.","350.00","gimble.jpeg","37","1","gimbal, selfie, fotos","Sim","120.00","7","120","120","Gimbal H4","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("15","1","5","Selfie Ring Light","selfie-ring-light","   Selfie Ring Light: Iluminação perfeita em suas selfies. Compacta, ajustável e recarregável. Realce sua beleza em todas as fotos. ","   A Selfie Ring Light é a solução definitiva para selfies impecáveis. Com iluminação ajustável em três tons, esta luz compacta proporciona um brilho suave e natural, realçando sua beleza em todas as fotos. Equipada com clipe ajustável, é compatível com smartphones, tablets e laptops. A bateria recarregável oferece praticidade, eliminando a necessidade de pilhas. Seja para criar conteúdo de qualidade, participar de videochamadas ou simplesmente capturar momentos especiais, a Selfie Ring Light é a aliada perfeita para garantir a iluminação ideal em qualquer situação. Transforme suas selfies com esta ferramenta indispensável para amantes da fotografia móvel. ","22.00","ring_light.jpeg","15","1","luz, iluminação, selfie, fotos","Sim","300.00","25","25","25","ring light","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("16","4",NULL,"Máquina de barbear com display digital","maquina-de-barbear-com-display-digital","   Máquina de barbear com display digital: Precisão avançada, lâminas afiadas. Experiência de barbear intuitiva com controle digital. ","   A Máquina de barbear com display digital redefine o cuidado masculino. Suas lâminas afiadas garantem um barbear suave e preciso. O display digital fornece informações em tempo real sobre a carga da bateria e indicadores de desempenho, proporcionando uma experiência de barbear personalizada. Com ajustes de velocidade e intensidade, adapta-se às preferências individuais. O design ergonômico e a tecnologia de ponta tornam o barbear confortável e eficiente. Seja para um visual impecável ou um estilo personalizado, esta máquina de barbear oferece desempenho excepcional com controle digital intuitivo, elevando a rotina de cuidados pessoais a um novo patamar. ","125.00","barbear.jpeg","15","1","beleza, corte de cabelo, cabelo, ","Sim","300.00","10","22","22","Com display digital","0.00","Não",NULL);
INSERT INTO tb_produtos VALUES("17","2","1","Mini processador de alimentos - Knup","mini-processador-de-alimentos-knup","   Mini processador de alimentos Knup: Compacto e eficiente. Corte, pique e triture facilmente. Versátil para receitas rápidas. ","   O Mini Processador de Alimentos Knup é a escolha perfeita para simplificar suas tarefas na cozinha. Compacto, mas poderoso, ele corta, pica e tritura ingredientes com facilidade. Com lâminas afiadas e motor eficiente, é ideal para preparar rapidamente uma variedade de pratos. Seu design intuitivo e fácil de usar torna a experiência culinária mais eficiente. Perfeito para quem busca praticidade em receitas cotidianas ou para quem possui espaço limitado na cozinha. O Knup oferece versatilidade e conveniência em um tamanho compacto, tornando-se um aliado indispensável para facilitar suas atividades na cozinha. ","60.00","pocessador_alimentos.jpeg","9","1","cozinha, triturador de alimentos","Sim","400.00","15","20","20","Knup","0.00","Não",NULL);


DROP TABLE IF EXISTS tb_promocao_banner;

CREATE TABLE `tb_promocao_banner` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `imagem` varchar(100) NOT NULL,
  `ativo` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_promocao_banner VALUES("1","Camisa polo play","https://www.sansales.com.br/loja/produto-fone-jbl-everest-jb950","banner-promo.jpg","Sim");
INSERT INTO tb_promocao_banner VALUES("2","Promo 2","https://www.sansales.com.br/loja/produto-fone-jbl-everest-jb950","banner-2.jpg","Sim");
INSERT INTO tb_promocao_banner VALUES("3","Promo 3","https://www.sansales.com.br/loja/produto-fone-jbl-everest-jb950","Camisa-azul.jpg","Não");


DROP TABLE IF EXISTS tb_promocoes;

CREATE TABLE `tb_promocoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `valor` decimal(8,2) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_final` datetime NOT NULL,
  `ativo` varchar(3) NOT NULL,
  `desconto` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_produto` (`id_produto`),
  CONSTRAINT `id_produto` FOREIGN KEY (`id_produto`) REFERENCES `tb_produtos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

INSERT INTO tb_promocoes VALUES("2","1","425.00","2024-01-14 03:31:00","2024-02-19 03:31:00","Sim","15");
INSERT INTO tb_promocoes VALUES("3","17","51.00","2024-01-19 16:12:00","2024-01-27 16:12:00","Não","15");


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

INSERT INTO tb_sub_categorias VALUES("1","Cozinha","cozinha","liquidificadorPortatil.jpeg","2");
INSERT INTO tb_sub_categorias VALUES("2","Caixa de som","caixa-de-som","caixa_som_capa.jpg","1");
INSERT INTO tb_sub_categorias VALUES("3","Lanterna","lanterna","lanterna1.jpeg","1");
INSERT INTO tb_sub_categorias VALUES("4","Fone de ouvido","fone-de-ouvido","fone_ouvido_sem_fio_blue.jpeg","1");
INSERT INTO tb_sub_categorias VALUES("5","Iluminação","iluminacao","ring_light.jpeg","1");


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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

INSERT INTO tb_usuarios VALUES("1","Administrador_Charles","000.000.000-00","store@sansales.com.br","123","202cb962ac59075b964b07152d234b70","Admin","2024-01-14 03:28:58");
INSERT INTO tb_usuarios VALUES("2","teste","21605881058","teste1@gmail.com","Teste1","5d44d60379779d3cd66380eb45f5af27","Cliente","2024-02-18 09:32:53");
INSERT INTO tb_usuarios VALUES("3","Teste patricia","94538024090","patricia@hotmail.com","Teste123","06afa6c8b54d3cc80d269379d8b6a078","Cliente","2024-02-18 11:32:10");
INSERT INTO tb_usuarios VALUES("4","Charles Rocha dos Santos","33068222800","rocha_charles@outlook.com","Teste123","06afa6c8b54d3cc80d269379d8b6a078","Cliente","2024-02-18 12:31:31");


