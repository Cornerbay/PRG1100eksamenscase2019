CREATE TABLE innlogging(
	brukernavn VARCHAR (40) NOT NULL,
	passord VARCHAR (255) NOT NULL,
	PRIMARY KEY (brukernavn)
);

CREATE TABLE klasse(
	klassekode CHAR(3) NOT NULL,
    klassenavn VARCHAR(50) NOT NULL,
    PRIMARY KEY (klassekode)
);

CREATE TABLE bilde(
	bildenr INT NOT NULL,
	opplastingsdato DATE NOT NULL,
	filnavn VARCHAR(50) NOT NULL,
	beskrivelse VARCHAR(50) NOT NULL,
	PRIMARY KEY (bildenr)
);

CREATE TABLE student(
	brukernavn CHAR(4) NOT NULL,
	fornavn VARCHAR(30) NOT NULL,
	etternavn VARCHAR(30) NOT NULL,
	klassekode CHAR(3) NOT NULL,
	`neste leveringsfrist` DATE NOT NULL,
	bildenr INT NOT NULL,
    PRIMARY KEY (brukernavn),
    FOREIGN KEY (klassekode) REFERENCES klasse(klassekode),
    FOREIGN KEY (bildenr) REFERENCES bilde(bildenr)
);



INSERT INTO klasse
VALUES ('IT1','IT og informasjonssystemer 1. år'),
('IT2','IT og informasjonssystemer 2. år'),
('IT3','IT og informasjonssystemer 3. år');

INSERT INTO bilde
VALUES (001,'2018-03-01','sm.jpg','flott bilde av Shegaw'),
(002,'2018-04-01','gb.jpg','grusomt bilde av Geir'),
(003,'2018-04-15','mj.jpg','Marius i solnedgang');

INSERT INTO student
VALUES ('gb','Geir','Bjarvin','IT1','2018-03-01',002),
('mj','Marius','Johannessen','IT1','2018-03-01',003),
('sm','Shegaw','Mengiste','IT2','2018-05-01',001);


/* spørring */


SELECT s.fornavn, s.etternavn, b.filnavn
FROM student AS s 
  INNER JOIN bilde AS b
  ON s.bildenr = b.bildenr 
WHERE 
  s.klassekode='IT1';