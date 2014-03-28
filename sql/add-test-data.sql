INSERT INTO Yllapitaja ( Tunnus, Salasana)
VALUES ( 'takrot', 'kopp1t4p4');

INSERT INTO Tuote ( Nimi, Tiedot, Hinta, Jaljella, Lisayskynnys, Lisaysmaara, Poistettu)
VALUES ( 'Pasta Pyyhekumi', 'Laadukas pyyhekumi kirjoitusvirheiden kumittamiseen. \n Ei hajoa käsiin ensimmäisellä kumituskerralla', 0.70, 600, 100, 400, 'Ei'),
( 'Pasta Lyijykyna', 'Laadukas lyijykynä pidempienkin tekstien kirjoittamiseen.', 0.30, 1200, 200, 800, 'Ei'),
( 'Jylha Sohva', 'Edistyksellinen sohva toimistoon.', 119.99, 20, 5, 10, 'Ei');

INSERT INTO Tuoteryhma (Nimi)
VALUES ( 'Toimistotarvikkeet'),
( 'Huonekalut'),
( 'Pasta');

INSERT INTO KuuluuRyhmiin (Tuotenro, Tuoteryhmanro)
SELECT Tuotenro, Tuoteryhmanro FROM Tuote A, Tuoteryhma B
WHERE A.Nimi like '%Pasta%' and B.Nimi like 'Pasta';

INSERT INTO KuuluuRyhmiin (Tuotenro, Tuoteryhmanro)
SELECT Tuotenro, Tuoteryhmanro FROM Tuote A, Tuoteryhma B
WHERE A.Nimi like 'Pasta Pyyhekumi' and B.Nimi like 'Toimistotarvikkeet';
INSERT INTO KuuluuRyhmiin (Tuotenro, Tuoteryhmanro)
SELECT Tuotenro, Tuoteryhmanro FROM Tuote A, Tuoteryhma B
WHERE A.Nimi like 'Pasta Lyijykyna' and B.Nimi like 'Toimistotarvikkeet';

INSERT INTO Asiakas ( Nimi, Osoite, Tunnus, Salasana, Poistettu)
VALUES ( 'Seppu Sukio', 'Sukiotie 3', 'suukios', 'soikuus', 'Ei'),
( 'Liisa Loimu', 'Loimukatu 34', 'loimus', 'liisal', 'Ei'),
( 'Jouni Jempala', 'Jempaantie 5', 'jempal', 'jounij', 'Ei'),
( 'Karri Karvinen', 'Karvisenpolku 66', 'kkarv', 'moukumau', 'Kyllä');

INSERT INTO Tilaus ( Toimitettu, Tilauspaiva, Asiakasnro, Maksettu, Maksettupaiva)
VALUES ( 'Kyllä', '10-4-2013', 1, 'Ei', null),
(  'Ei', '22-5-2013', 1, 'Ei', null),
(  'Kyllä', '12-2-2013', 3, 'Kyllä', '13-2-2013');

INSERT INTO Tilausrivi ( Tilausnro, Tuotenro, Lkm, OstoHetkenKplHinta)
VALUES ( 1, 2, 30, 0.30),
( 1, 1, 60, 0.60),
( 2, 1, 60, 0.70),
( 2, 2, 20, 0.30),
( 2, 3, 1, 45.0),
( 3, 3, 2, 50.0);

INSERT INTO Lasku ( Tilausnro, Tyyppi, Erapaiva)
VALUES ( 1, 'Lasku', '22-5-2013'),
( 3, 'Lasku', '22-3-2013'),
( 3, 'Karhu1', '22-4-2013');