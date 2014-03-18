CREATE TABLE Tuote (
TuoteNro INTEGER NOT NULL PRIMARY KEY,
Nimi  VARCHAR(50) NOT NULL,
Hinta DECIMAL(10,2) NOT NULL, 
Jaljella INTEGER NOT NULL, 
Lisayskynnys INTEGER NOT NULL,
Lisaysmaara INTEGER NOT NULL
);

CREATE TABLE Asiakas (
Asiakasnro INTEGER NOT NULL PRIMARY KEY,
Nimi VARCHAR(60) NOT NULL,
Osoite VARCHAR(80) NOT NULL,
Tunnus VARCHAR(20) NOT NULL,
Salasana VARCHAR(20) NOT NULL
);

CREATE TABLE Tilaus ( 
Tilausnro INTEGER NOT NULL PRIMARY KEY,
Toimitettu VARCHAR(5) NOT NULL,
Maksettu VARCHAR(5) NOT NULL,
Asiakasnro INTEGER NOT NULL REFERENCES ASIAKAS ON UPDATE CASCADE ON DELETE RESTRICT,
Erapaiva DATE NOT NULL,
Maksettupaiva DATE NOT NULL
);

CREATE TABLE Tilausrivi (
Tilausnro INTEGER NOT NULL PRIMARY KEY REFERENCES TILAUS ON UPDATE CASCADE ON DELETE RESTRICT,
Tuotteennro INTEGER NOT NULL REFERENCES TUOTE ON UPDATE CASCADE ON DELETE RESTRICT,
Lkm INTEGER NOT NULL,
OstoHetkenKplHinta DECIMAL(10,2) NOT NULL
);

CREATE TABLE KuuluuRyhmiin ( 
Tuotenro INTEGER NOT NULL PRIMARY KEY REFERENCES TUOTE 
ON UPDATE CASCADE
ON DELETE RESTRICT,
Tuoteryhmanro INTEGER NOT NULL REFERENCES TUOTERYHMA
ON UPDATE CASCADE
ON DELETE RESTRICT
);

CREATE TABLE Tuoteryhma (
Tuoteryhmanro INTEGER NOT NULL PRIMARY KEY,
Nimi VARCHAR(20) NOT NULL
);