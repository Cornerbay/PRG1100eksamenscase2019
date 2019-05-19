CREATE TABLE hotell(
	hotellnavn VARCHAR (255) NOT NULL,
	sted VARCHAR (255) NOT NULL,
	PRIMARY KEY (hotellnavn)
);

CREATE TABLE romtype(
	romtype VARCHAR(50) NOT NULL,
    PRIMARY KEY (romtype)
);

CREATE TABLE hotellromtype(
	hotellnavn VARCHAR(255) NOT NULL,
	romtype VARCHAR(255) NOT NULL,
	antallrom INT NOT NULL,
	PRIMARY KEY (hotellnavn,romtype),
	FOREIGN KEY (hotellnavn) REFERENCES hotell(hotellnavn),
	FOREIGN KEY (romtype) REFERENCES romtype(romtype)
);

CREATE TABLE rom(
	hotellnavn VARCHAR(255) NOT NULL,
	romtype VARCHAR(255) NOT NULL,
	romnr INT NOT NULL,
	PRIMARY KEY (hotellnavn, romnr),
	FOREIGN KEY (hotellnavn,romtype) REFERENCES hotellromtype(hotellnavn,romtype)
);

CREATE TABLE bruker(
	brukernavn 	VARCHAR(255) NOT NULL,
	passord		VARCHAR(255) NOT NULL,
	rolle		VARCHAR(255) NOT NULL,
	PRIMARY KEY (brukernavn)
);

CREATE TABLE bestilling(
	bestillings_id 	int NOT NULL AUTO_INCREMENT,
	brukernavn 		VARCHAR(255) NOT NULL,
	hotellnavn		VARCHAR(255) NOT NULL,
	romtype			VARCHAR(255) NOT NULL,
	romnr 			VARCHAR(255) NOT NULL,
	dato_fra		DATE NOT NULL,
	dato_til 		DATE NOT NULL,
	PRIMARY KEY (bestillings_id),
	FOREIGN KEY (hotellnavn,romtype) REFERENCES hotellromtype(hotellnavn,romtype),
	FOREIGN KEY (hotellnavn, romtype) REFERENCES rom(hotellnavn,romtype),
	FOREIGN KEY (brukernavn) REFERENCES bruker(brukernavn)
);


INSERT INTO hotell
VALUES ('grand hotel oslo', 'oslo'),
('hotel klubben tønsberg', 'tønsberg'),
('radisson blu gardermoen', 'ullensaker');

INSERT INTO romtype
VALUES ('enkeltrom'),
('dobbeltrom'),
('familierom'),
('suite');

INSERT INTO hotellromtype
VALUES ('grand hotel oslo', 'enkeltrom', 50),
('grand hotel oslo', 'dobbeltrom', 200),
('grand hotel oslo', 'suite', 10),
('hotel klubben tønsberg', 'enkeltrom', 10),
('hotel klubben tønsberg', 'dobbeltrom', 150),
('hotel klubben tønsberg', 'familierom', 50);

INSERT INTO rom
VALUES ('grand hotel oslo', 'enkeltrom', 101),
('grand hotel oslo', 'enkeltrom', 102),
('grand hotel oslo', 'enkeltrom', 103),
('grand hotel oslo', 'dobbeltrom', 201),
('grand hotel oslo', 'dobbeltrom', 202),
('grand hotel oslo', 'dobbeltrom', 203);

/* spørring */


/*Vis romtype*/
SELECT r.romtype
FROM romtype AS r
	INNER JOIN hotellromtype AS hr
	ON r.romtype = hr.romtype
WHERE
	hr.hotellnavn='grand hotel oslo';



SELECT romnr
FROM rom
WHERE
	hotellnavn='grand hotel oslo'
	AND romnr NOT IN
			(
				SELECT romnr 
				FROM bestilling 
				WHERE 	
					hotellnavn='grand hotel oslo'
					AND
					dato_fra BETWEEN '2019-05-17' AND '2019-05-18'
					AND
					dato_til BETWEEN '2019-05-17' AND '2019-05-18'
			);