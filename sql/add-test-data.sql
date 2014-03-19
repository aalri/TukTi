INSERT INTO Tuote ( Nimi, Hinta, Jaljella, Lisayskynnys, Lisaysmaara)
VALUES ( 'Pasta Pyyhekumi', 0.70, 600, 100, 400 ),
( 'Pasta Lyijykyna', 0.30, 1200, 200, 800),
( 'Jylha Sohva', 119.99, 20, 5, 10);

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

INSERT INTO Asiakas ( Nimi, Osoite, Tunnus, Salasana)
VALUES ( 'Seppu Sukio', Sukiotie 3, 'Suukios', 'soikuus'),
( 'Liisa Loimu', Loimukatu 34, 'Loimus', 'liisal'),
( 'Jouni Jempala', Jempaantie 5, 'Jempal', 'jounij');

INSERT INTO Tilausrivi ( Nimi, Osoite, Tunnus, Salasana)
VALUES ( 'Seppu Sukio', Sukiotie 3, 'Suukios', 'soikuus'),
( 'Liisa Loimu', Loimukatu 34, 'Loimus', 'liisal'),
( 'Jouni Jempala', Jempaantie 5, 'Jempal', 'jounij');
