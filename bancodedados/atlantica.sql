-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 03, 2024 at 02:56 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `atlantica`
--

-- --------------------------------------------------------

--
-- Table structure for table `especialidades`
--

CREATE TABLE `especialidades` (
  `id_especialidade` int NOT NULL,
  `icone` varchar(100) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `especialidades`
--

INSERT INTO `especialidades` (`id_especialidade`, `icone`, `titulo`, `descricao`) VALUES
(1, 'bx bx-hard-hat', 'Engenharia Mecânica', 'Todas as peças foram idealizadas e projetadas pelo talentoso designer brasileiro Gian Franco Silva. Com uma formação sólida em mecânica e projetos mecânicos, ele soube aproveitar seus conhecimentos técnicos para criar peças que combinam resistência, segurança e inovação. Sempre com foco em design minimalista, Gian Franco não apenas prioriza a estética, mas também o conforto e a funcionalidade para o uso diário. Cada criação é uma verdadeira fusão de técnica e elegância, oferecendo soluções práticas e sofisticadas.\r\n\r\n'),
(2, 'bx-palette', 'Carpintaria', 'Todas as peças foram cuidadosamente projetadas e executadas pelo mestre carpinteiro, Gian Franco Silva. Com uma sólida formação em marcenaria e técnicas tradicionais de carpintaria, ele utiliza seus conhecimentos para criar móveis e peças únicas, que se destacam pela durabilidade e precisão. Adotando uma abordagem que valoriza o design minimalista, Gian Franco Silva foca não apenas na estética, mas também na funcionalidade e no conforto para o dia a dia. Cada criação é uma combinação perfeita de habilidade artesanal, inovação e qualidade, proporcionando beleza e praticidade em cada detalhe.\r\n\r\n'),
(3, 'bx-bar-chart-alt', 'Designer', 'Todas as criações foram pensadas e desenvolvidas pelo designer brasileiro Gian Franco Silva. Com uma sólida formação em design de produtos e uma paixão por soluções inovadoras, ele aplica sua experiência para criar peças que combinam estética, funcionalidade e durabilidade. Seu trabalho é marcado pela busca constante por um design minimalista, que valoriza a simplicidade e a elegância sem abrir mão do conforto e da praticidade. Gian Franco Silva acredita que o design deve transformar o cotidiano, oferecendo não apenas beleza, mas também uma experiência mais confortável e eficiente para quem utiliza suas peças.\r\n\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int NOT NULL,
  `id_usuario` int NOT NULL,
  `id_produto` int NOT NULL,
  `preco_produto` decimal(10,2) NOT NULL,
  `quantidade_produto` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `id_usuario`, `id_produto`, `preco_produto`, `quantidade_produto`) VALUES
(79, 8, 1, '543322.00', 2),
(81, 8, 3, '300.00', 1),
(82, 8, 4, '120.00', 1),
(83, 8, 5, '1203.00', 2),
(92, 7, 2, '200.00', 2),
(93, 1, 1, '300000.00', 1),
(94, 1, 2, '200.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `produtos`
--

CREATE TABLE `produtos` (
  `id_produto` int NOT NULL,
  `imagem` varchar(255) NOT NULL,
  `nomeproduto` varchar(255) NOT NULL,
  `preco` decimal(10,2) NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produtos`
--

INSERT INTO `produtos` (`id_produto`, `imagem`, `nomeproduto`, `preco`, `descricao`) VALUES
(1, 'redepet3.jpeg', 'Rede Pet ', '899.00', 'Uma rede apaixonante. Construída de uma estrutura sólida de madeira certificada, e uma elegante superfície de dormir, permite um cochilo confortável. A almofada de ultra-camursa tbm é reversível,  hopoalergênica e resistente a manchas.\r\nOs peludos nos dão tanto, porque não retribuir o favor, dando a eles o lugar perfeito para relaxar.\r\n\r\nTamanho 85cm X 85cm x25cm\r\n\r\nDisponível em diversas cores.'),
(2, 'camacachorro15.jpeg', 'Rede Pet II', '699.00', 'A rede Pet ll da Atlântica design oferece um local confortável e elegante para seu amigo peludo relaxar. \r\nEssa rede da Atlântica tem um design minimalista e muito elegante de camas para animais de estimação,  criado com estrutura sólida em madeira , um colchão confortável e uma capa de almofada removível e lavável.  A ideia é de inclusão do seu peludo no ambiente.  Foi criada para cães e gatos de pequeno e médio porte. \r\n\r\nTamanho: 85 cmx 63 cm x 25 cm .\r\n\r\nDisponível em diversas cores.'),
(3, 'prateleiragatos.jpeg', 'Prateleiras para gatos', '599.00', 'Adicione estilo a sua casa e encante seu gato com estas Prateleiras de madeira lindamente projetadas e moldadas a vapor. Elas apresentam um design elegante, moderno e super funcional. Uma almofada macia e personalizavel que seu gato vai adorar. \r\nUm móvel resistente,  pode suportar até 20kg, tornando-as perfeitas até  para os maiores gatos. Elas fornecem um local confortável e elevado para seu gato relaxar e observar os arredores.'),
(4, 'tocaluxo.jpeg', 'Toca Luxo', '1149.00', 'A Toca Luxo da Atlântica design,  agradou tanto os fãs de pets quanto os de design. A inspiração veio da ideia de que os cães e gatos são animais de Toca e gostam de uma sensação de cercamento.  Sentimos que os acessórios para cães e gatos não devem se parecer com móveis de pessoas em miniaturas, mas devem responder às preferências dos nossos peludos.\r\nA Toca é feita de compensado de bétula, com opção de folheado. A almofada é removível,  lavável e, finalmente substituível.  Esta é realmente uma peça icônica!'),
(5, 'at8.png', 'Cama Super Luxo ', '1099.00', 'Essa linha de móveis Super luxo para animais de estimação da Atlântica design,  é tão exagerada que parece pertencer a um museu.\r\nModernas e minimalistas,  são peças para quem pode comprar o melhor para seu animais de estimação. \r\nAs peças são feitas com materiais de alta qualidade, moldadas artesanalmente , e a maioria em quantidades de edição limitadas. As curvas em madeira nobre, combinadas com microfibras a prova de animais de estimação,  dão a essas peças um visual clássico que também é funcional.'),
(6, 'at12.png', 'Berço para adultos ', '5990.00', 'Este Assento de cesta da Atlântica design,  é um verdadeiro Berço para Adultos. Sua construção foi pensada para que vc se deite de uma forma bem descontraída, como quando era um bebê.  Estrutura construída de madeira certificada, o que dá uma sofisticação,  e estofado muito confortável,  removível e lavável.  \r\n\r\nMedidas: 1500mm diâmetro \r\nAltura: 700mm\r\nPeso: 12 kg'),
(7, 'at13.png', 'Caverna e Cama', '600.00', 'Dê ao seu peludo um lugar para brincar, se esconder e tirar uma soneca. \r\nApresentando uma silhueta em forma de cone, esta peça leve e coberta com um tecido feltro. \r\nUma porta arqueada facilita a entrada e a saída,  enquanto uma almofada listrada removível fornece acolchoamento extra.\r\nO melhor de tudo é que essa cama pode ser enrola da para que vc possa levar facilmente em viagens'),
(8, 'at9.png', 'Tamboretes', '399.00', 'Procurando um companheiro?\r\n A \"Atlântica design para vida \" tem o que vc precisa. A marca de design recém fundada , lançou seu design de estreia chamado \" Companion\" , um design de banquinhos alienígenas , que se tornam companheiros para assentos extras, uma mesa pequena ou uma peça de arte engraçada,  funcional ao mesmo tempo. Cores vibrantes, alegre!!!!\r\nA série \" Companion\" consiste em dois modelos: Companion e Companion 4 legs. Os bancos atrevidos podem até parecer apenas mais um banco, com uma base interessante. Mas esses bancos são meio alienígenas.  As bases de aço com revestimento em pó, são os corpos. Enquanto os assentos de madeira maciça,  são as cabeças com um único olho!\r\nColoque-os  individualmente ou junto com os amigos para se divertir ainda mais.\r\nTamanho: Largura 40cm - profundidade 40cm- altura 50cm.'),
(21, 'bebe5.jpeg', 'Rede Kids', '599.00', 'A rede Kids Balançantemente legaus da Atlântica design é sensacional e dispensa comentários. Imagina seu filhote esparramado e se balançando rsrsrs.  Com um design minimalista,  linhas limpas, mantém o critério de criação da Atlântica. \r\nA rede infantil de balanço é ideal para quarto ou salas de jogos; perfeita para cochilar, descansar,  ler e outras atividades relaxantes.  Estrutura de madeira e curva permitem que as crianças balancem suavemente.  Rede durável,  de tecido de algodão,  compacta,  leve e fácil de mover em qualquer lugar que as crianças vão- dentro ou fora de casa. Suporta a integração sensorial e aumenta suavemente a tolerância ao movimento. \r\nIndicada para crianças de 3 a 5 anos ou até 45 kg\r\nMedidas C 125cm X L 50cm'),
(22, 'at11.png', 'Assento \"Gravidade zero\"', '13900.00', 'Não é um assento, é um estilo de vida. A  Gravidade Zero é uma das poltronas mais versáteis do mercado.\r\nO design exclusivo oferece 4 posições diferentes: Ajoelhado, ereto, reclinado e a  máxima ausência de peso \" Gravidade Zero \"\r\nEm Gravidade Zero, suas pernas ficam acima do nível do seu coração.Seu coração não precisa trabalhar tanto para fazer seu fluxo sanguíneo fluir, o que é muito saudável e relaxante. A expressão facial das pessoas que ficam nessa posição não tem preço.  Imperdível!!!!!!\r\nO estofamento , o formato do encosto e assento oferecem excelente para as costas e região lombar. \r\nA madeira flexível e o balanço induzem movimentos agradáveis.\r\nUma experiência única de assento. Peso máximo suportável: 100 KG.');

-- --------------------------------------------------------

--
-- Table structure for table `produto_imagens`
--

CREATE TABLE `produto_imagens` (
  `id_imagem` int NOT NULL,
  `id_produto` int DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `produto_imagens`
--

INSERT INTO `produto_imagens` (`id_imagem`, `id_produto`, `imagem`) VALUES
(9, 1, 'redepet2.jpeg'),
(10, 1, 'redepet1.jpeg'),
(13, 3, 'gato1.jpeg'),
(14, 3, 'gato3.jpeg'),
(15, 3, 'gato2.jpeg'),
(17, 1, 'at7.png'),
(18, 2, 'at6.png'),
(19, 2, 'at4.png'),
(20, 2, 'camacachorro12.jpeg'),
(21, 4, 'at5.png'),
(22, 4, 'tocaluxo2.jpeg'),
(23, 4, 'tocaluxo3.jpeg'),
(25, 6, 'berçoadulto3.jpeg'),
(26, 6, 'berçoadulto1.jpeg'),
(27, 6, 'berçoadulto2.jpeg'),
(28, 6, 'berçoadulto4.jpeg'),
(29, 5, 'banco2.jpeg'),
(30, 5, 'banco3.jpeg'),
(31, 5, 'banco5.jpeg'),
(32, 7, 'cone1.jpeg'),
(33, 7, 'cone2.jpeg'),
(34, 7, 'cone3.jpeg'),
(35, 8, 'tam1.jpeg'),
(36, 8, 'tam2.jpeg'),
(37, 8, 'tam3.jpeg'),
(38, 21, 'bebe2.jpeg'),
(39, 21, 'bebe3.jpeg'),
(40, 21, 'bebe4.jpeg'),
(41, 22, 'orto2.jpeg'),
(42, 22, 'orto3.jpeg'),
(43, 22, 'orto4.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tipouser`
--

CREATE TABLE `tipouser` (
  `id` int NOT NULL,
  `desc` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tipouser`
--

INSERT INTO `tipouser` (`id`, `desc`) VALUES
(1, 'Admin'),
(2, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int NOT NULL,
  `CPF` varchar(15) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `dtnasc` date NOT NULL,
  `tipoUser` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `CPF`, `nome`, `email`, `senha`, `dtnasc`, `tipoUser`) VALUES
(1, '12312312311', 'Gian Franco', 'nicolasfranco@gmail.com', 'Gian123', '1970-02-15', 1),
(2, '12312322212', 'matheus Ferreira', 'matheusrimoldi@gmail.com', '12345', '2006-11-13', 1),
(3, '12394293288', 'Matheus Rimoldi', 'murilo@gmail.com', '123456', '2000-02-12', 2),
(4, '46727951870', 'matheus ferreira rimoldi', 'matheus001@gmail.com', 'matheus123', '2006-11-13', 2),
(5, '51633829855', 'Nicolas Henrique', 'nichenr@gmail.com', 'nic123', '2006-08-07', 2),
(6, '55566677789', 'jessica medeiros', 'jessicamed@gmail.com', 'jes123', '1990-09-12', 2),
(7, '123456789', 'Laelson Mota da Silva', 'laelson.mota@gmail.com', '1234', '1966-12-12', 2),
(8, '33876777828', 'Alice Amaro belanguiall', 'alice@gmail.com', 'alice123', '1986-05-30', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `especialidades`
--
ALTER TABLE `especialidades`
  ADD PRIMARY KEY (`id_especialidade`);

--
-- Indexes for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `id_produto` (`id_produto`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_produto_2` (`id_produto`);

--
-- Indexes for table `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `produto_imagens`
--
ALTER TABLE `produto_imagens`
  ADD PRIMARY KEY (`id_imagem`),
  ADD KEY `id_produto` (`id_produto`);

--
-- Indexes for table `tipouser`
--
ALTER TABLE `tipouser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD UNIQUE KEY `CPF_2` (`CPF`) USING BTREE,
  ADD KEY `FK_usuario_tipouser` (`tipoUser`),
  ADD KEY `tipoUser` (`tipoUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `especialidades`
--
ALTER TABLE `especialidades`
  MODIFY `id_especialidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id_produto` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `produto_imagens`
--
ALTER TABLE `produto_imagens`
  MODIFY `id_imagem` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tipouser`
--
ALTER TABLE `tipouser`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `FK_pedidos_produtos` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`) ON DELETE CASCADE;

--
-- Constraints for table `produto_imagens`
--
ALTER TABLE `produto_imagens`
  ADD CONSTRAINT `produto_imagens_ibfk_1` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id_produto`);

--
-- Constraints for table `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `FK_usuario_tipouser` FOREIGN KEY (`tipoUser`) REFERENCES `tipouser` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
