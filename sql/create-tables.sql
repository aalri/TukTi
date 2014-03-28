CREATE TABLE Tuote (
Tuotenro SERIAL NOT NULL PRIMARY KEY,
Nimi  VARCHAR(50) NOT NULL,
Tiedot  VARCHAR(600) NOT NULL,
Hinta DECIMAL(10,2) NOT NULL, 
Jaljella INTEGER NOT NULL, 
Lisayskynnys INTEGER NOT NULL,
Lisaysmaara INTEGER NOT NULL,
Poistettu Varchar(5) NOT NULL
);

CREATE TABLE Asiakas (
Asiakasnro SERIAL NOT NULL PRIMARY KEY,
Nimi VARCHAR(60) NOT NULL,
Osoite VARCHAR(80) NOT NULL,
Tunnus VARCHAR(20) NOT NULL,
Salasana VARCHAR(20) NOT NULL,
Poistettu Varchar(5) NOT NULL
);

CREATE TABLE Tilaus ( 
Tilausnro SERIAL NOT NULL PRIMARY KEY,
Toimitettu VARCHAR(5) NOT NULL,
Tilauspaiva DATE NOT NULL,
Asiakasnro INTEGER NOT NULL REFERENCES ASIAKAS ON UPDATE CASCADE ON DELETE RESTRICT,
Maksettu VARCHAR(5) NOT NULL,
Maksettupaiva DATE
);

CREATE TABLE Tilausrivi (
Tilausnro INTEGER NOT NULL REFERENCES TILAUS ON UPDATE CASCADE ON DELETE RESTRICT,
Tuotenro INTEGER NOT NULL REFERENCES TUOTE ON UPDATE CASCADE ON DELETE RESTRICT,
Lkm INTEGER NOT NULL,
OstoHetkenKplHinta DECIMAL(10,2) NOT NULL,
PRIMARY KEY (Tilausnro, Tuotenro)
);

CREATE TABLE Tuoteryhma (
Tuoteryhmanro SERIAL NOT NULL PRIMARY KEY,
Nimi VARCHAR(20) NOT NULL
);

CREATE TABLE KuuluuRyhmiin ( 
Tuotenro INTEGER NOT NULL REFERENCES TUOTE ON UPDATE CASCADE ON DELETE CASCADE,
Tuoteryhmanro INTEGER NOT NULL REFERENCES TUOTERYHMA ON UPDATE CASCADE ON DELETE CASCADE,
PRIMARY KEY (Tuotenro, Tuoteryhmanro)
);

CREATE TABLE Lasku (
Laskunro SERIAL NOT NULL PRIMARY KEY,
Tilausnro INTEGER NOT NULL REFERENCES TILAUS ON UPDATE CASCADE ON DELETE RESTRICT,
Tyyppi VARCHAR(7) NOT NULL,
Erapaiva DATE NOT NULL
);

CREATE TABLE Yllapitaja (
Id SERIAL NOT NULL PRIMARY KEY,
Tunnus VARCHAR(20) NOT NULL,
Salasana VARCHAR(20) NOT NULL
);