CREATE TABLE veiculo
(
   id int PRIMARY KEY auto_increment,
   marca varchar(30),
   modelo varchar(50),
   ano char(4),
   cor varchar(30),
   quilometragem varchar(20)
) ENGINE=InnoDB;

INSERT INTO veiculo VALUES (null, "Volkswagen", "Polo", "2022", "Prata", "36000");
INSERT INTO veiculo VALUES (null, "Volkswagen", "Polo", "2024", "Vermelho", "3500");
INSERT INTO veiculo VALUES (null, "Volkswagen", "T-Cross", "2020", "Preto", "89000");
INSERT INTO veiculo VALUES (null, "Volkswagen", "T-Cross", "2021", "Cinza", "58000");
INSERT INTO veiculo VALUES (null, "Volkswagen", "T-Cross", "2022", "Prata", "32500");
INSERT INTO veiculo VALUES (null, "Volkswagen", "Passat", "2020", "Branco", "47800");

INSERT INTO veiculo VALUES (null, "Fiat", "Argo", "2018", "Prata", "94000");
INSERT INTO veiculo VALUES (null, "Fiat", "Argo", "2019", "Bege", "64700");
INSERT INTO veiculo VALUES (null, "Fiat", "Mobi", "2017", "Prata", "98400");
INSERT INTO veiculo VALUES (null, "Fiat", "Mobi", "2021", "Cinza", "56800");
INSERT INTO veiculo VALUES (null, "Fiat", "Pulse", "2022", "Preto", "16800");
INSERT INTO veiculo VALUES (null, "Fiat", "Pulse", "2023", "Azul", "6500");

INSERT INTO veiculo VALUES (null, "Chevrolet", "Onix", "2015", "Branco", "125500");
INSERT INTO veiculo VALUES (null, "Chevrolet", "Onix", "2016", "Vermelho", "95300");
INSERT INTO veiculo VALUES (null, "Chevrolet", "S10", "2012", "Prata", "156300");
INSERT INTO veiculo VALUES (null, "Chevrolet", "S10", "2013", "Prata", "123600");
INSERT INTO veiculo VALUES (null, "Chevrolet", "S10", "2016", "Branca", "87360");
INSERT INTO veiculo VALUES (null, "Chevrolet", "Montana", "2018", "Preta", "52000");

INSERT INTO veiculo VALUES (null, "Hyundai", "HB20", "2015", "Branco", "122500");
INSERT INTO veiculo VALUES (null, "Hyundai", "Creta", "2017", "Prata", "78500");
