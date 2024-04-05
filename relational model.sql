drop database if exists rentalDB;
create database rentalDB;

CREATE TABLE Person(
	PersonID	CHAR(5)		NOT NULL,
	FirstName	VARCHAR(30),
	LastName	VARCHAR(30),
	Phone		BIGINT,
	PRIMARY KEY(PersonID)
);

CREATE TABLE RentalGroup(
	Code		CHAR(5)		NOT NULL,
	NBathrooms	INT,
	NBedrooms	INT,
	Parking		CHAR(1),
	LaundryType	VARCHAR(30),
	MaxRent		INT,
	Accessibility	CHAR(1),
	Classification	VARCHAR(30),
	PRIMARY KEY(Code)
);

CREATE TABLE Renter(
	RenterID	CHAR(5)		NOT NULL,
	StudentID	CHAR(5),
	Program		VARCHAR(30),
	GradYear	YEAR,
	rgCode		CHAR(5)		NOT NULL,
	PRIMARY KEY(RenterID, rgCode),
	FOREIGN KEY(RenterID) REFERENCES Person(PersonID) ON DELETE CASCADE,
	FOREIGN KEY(rgCode) REFERENCES RentalGroup(Code)
);


CREATE TABLE PropertyManager(
	PropManagerID	CHAR(5)		NOT NULL,
	StartYear	YEAR,
	PRIMARY KEY(PropManagerID),
	FOREIGN KEY(PropManagerID) REFERENCES Person(PersonID) ON DELETE CASCADE
);


CREATE TABLE Owner(
	OwnerID		CHAR(5)		NOT NULL,
	PRIMARY KEY(OwnerID),
	FOREIGN KEY(OwnerID) REFERENCES Person(PersonID) ON DELETE CASCADE
);

CREATE TABLE Property(
	PropertyID	CHAR(5)		NOT NULL,
	Classification	VARCHAR(30),
	Parking		CHAR(1),
	Cost		INT,
	ListingDate	DATE,
	Accessiblity	CHAR(1),
	LaundryType	VARCHAR(30),
	Street		VARCHAR(30),
	City		VARCHAR(30),
	Province	VARCHAR(30),
	PC		VARCHAR(10),
	PropManagerID	CHAR(5),
	rgCode		CHAR(5)		NOT NULL,
	LeaseSignDate	DATE,
	LeaseEndDate	DATE,
	PRIMARY KEY(PropertyID),
	FOREIGN KEY(PropManagerID) REFERENCES PropertyManager(PropManagerID),
	FOREIGN KEY(rgCode) REFERENCES RentalGroup(Code)
);

CREATE TABLE Apartment(
	ApartmentID	CHAR(5)		NOT NULL,
	NBathrooms	INT,
	NBedrooms	INT,
	Floor		INT,
	Elevator	VARCHAR(30),
	PRIMARY KEY(ApartmentID),
	FOREIGN KEY(ApartmentID) REFERENCES Property(PropertyID) ON DELETE CASCADE
);

CREATE TABLE House(
	HouseID		CHAR(5)		NOT NULL,
	NBathrooms	INT,
	NBedrooms	INT,
	Fencing		VARCHAR(30),
	HouseType	VARCHAR(30),
	PRIMARY KEY(HouseID),
	FOREIGN KEY(HouseID) REFERENCES Property(PropertyID) ON DELETE CASCADE
);

CREATE TABLE Room(
	RoomID		CHAR(5)		NOT NULL,
	NRoommates	INT,
	Furnishings	VARCHAR(30),
	KitchenPrivs	CHAR(1),
	PRIMARY KEY(RoomID),
	FOREIGN KEY(RoomID) REFERENCES Property(PropertyID) ON DELETE CASCADE
);

CREATE TABLE Owns(
	OwnerID		CHAR(5)		NOT NULL,
	PropertyID	CHAR(5)		NOT NULL,
	PRIMARY KEY(OwnerID, PropertyID),
	FOREIGN KEY(OwnerID) REFERENCES Owner(OwnerID),
	FOREIGN KEY(PropertyID) REFERENCES Property(PropertyID)
);







INSERT INTO Person VALUES
('00001', 'Emily', 'Brown', 4165057643),
('00002', 'Ricky', 'Jones', 2938553583),
('00003', 'Jacob', 'White', 1039551023),
('00004', 'Lucas', 'Smith', 1837450493),
('00005', 'Ethan', 'Clark', 1928458394),
('00006', 'Alexa', 'Lungs', 1121122659),
('00007', 'Willy', 'Rosse', 3546679983),
('00008', 'James', 'Moore', 7696995236),
('00009', 'Henry', 'Savis', 6472306948),

('00010', 'Andre', 'Leigh', 3039183928),
('00011', 'Bowie', 'Acker', 1301039358),
('00012', 'Avery', 'Blair', 8792849834),
('00013', 'Oliver', 'Kent', 6845453998),

('00014', 'Sophia', 'Gump', 3372742035),
('00015', 'Johnson', 'Cox', 1129409730)
;
#1-10 = Renters
#10-13 = Owners
#14-15 = Property Managers


INSERT INTO Owner VALUES
('00010'),
('00011'),
('00012'),
('00013')
;

INSERT INTO RentalGroup VALUES
('RG001', 2, 3, 'Y', 'Ensuite', 2500, 'Y', 'House'),
('RG002', 2, 2, 'N', 'Shared', 1800, 'Y', 'Apartment'),
('RG003', 2, 4, 'Y', 'Ensuite', 3000, 'N', 'Apartment'),
('RG004', 1, 3, 'N', 'Shared', 1200, 'Y', 'House')
;

INSERT INTO Renter VALUES
('00001', 'S0001', 'Engineering', 2025, 'RG002'),
('00002', 'S0002', 'Commerce', 2026, 'RG003'),
('00003', 'S0003', 'Psychology', 2024, 'RG004'),
('00004', 'S0004', 'Health Science', 2027, 'RG001'),
('00005', 'S0005', 'Economics', 2026, 'RG001'),
('00006', 'S0006', 'Computer Science', 2026, 'RG002'),
('00007', 'S0007', 'History', 2024, 'RG003'),
('00008', 'S0008', 'Computer Science', 2026, 'RG004'),
('00009', 'S0009', 'Engineering', 2026, 'RG002'),
('00010', 'S0010', 'Computer Science', 2026, 'RG001')
;

INSERT INTO PropertyManager VALUES
('00014', 2018),
('00015', 1974)
;

INSERT INTO Property VALUES
('P0001', 'Apartment', 'Y', 3400, '2024-01-25', 'Y', 'Ensuite', '456 Maple Street', 'Toronto', 'Ontario', 'M4C 5G2', NULL, 'RG002', '2024-02-12', '2024-08-31'),
('P0002', 'Room', 'N', 4500, '2024-02-09', 'N', 'Shared', '789 Oak Lane', 'Vancouver', 'British Columbia', 'V5R 1P1', NULL, 'RG003', '2024-02-14', '2025-02-28'),
('P0003', 'House', 'Y', 1100, '2024-02-08', 'Y', 'Ensuite', '1010 Elm Avenue', 'Calgary', 'Alberta', 'T2P 1A6', '00015', 'RG001', '2024-02-10', '2024-12-31'),
('P0004', 'Room', 'Y', 2500, '2024-02-07', 'N', 'Ensuite', '293 Pine Street', 'Montreal', 'Quebec', 'H1Y 2J7', NULL, 'RG002', '2024-02-11', '2025-03-31'),
('P0005', 'Apartment', 'N', 1600, '2024-02-06', 'Y', 'Shared', '32 Cedar Avenue', 'Ottawa', 'Ontario', 'K1P 5N9', NULL, 'RG003', '2024-02-09', '2024-09-30'),
('P0006', 'House', 'Y', 350, '2024-02-05', 'N', 'Ensuite', '444 Birch Road', 'Edmonton', 'Alberta', 'T5J 2P4', NULL, 'RG001', '2024-02-08', '2025-06-30'),
('P0007', 'House', 'Y', 1700, '2024-02-04', 'Y', 'Shared', '555 Spadina Street', 'Halifax', 'Nova Scotia', 'B3H 1Y6', NULL, 'RG002', '2024-02-07', '2024-10-31'),
('P0008', 'Apartment', 'N', 2300, '2024-02-03', 'N', 'Ensuite', '666 Cat Avenue', 'Victoria', 'British Columbia', 'V8W 1V4', '00014', 'RG003', '2024-02-06', '2025-04-30'),
('P0009', 'Room', 'Y', 1900, '2024-02-02', 'Y', 'Ensuite', '71 Sunset Court', 'Winnipeg', 'Manitoba', 'R3T 3E1', NULL, 'RG002', '2024-02-05', '2024-11-30'),
('P0010', 'House', 'Y', 1800, '2024-02-11', 'Y', 'Shared', '2 Wilcox Avenue', 'Halifax', 'Nova Scotia', 'B3H 3E4', NULL, 'RG001', '2024-02-02', '2025-01-01')
;

INSERT INTO Apartment VALUES
('P0001', 2, 2, 13, 'Y'),
('P0005', 1, 2, 2, 'Y'),
('P0008', 1, 4, 51, 'N')
;

INSERT INTO House VALUES
('P0003', 2, 3, 'Y', 'Detached'),
('P0006', 2, 2, 'N', 'Detached'),
('P0007', 2, 4, 'Y', 'Semi'),
('P0010', 1, 2, 'N', 'Semi')
;

INSERT INTO Room VALUES
('P0002', 1, 'Bed, Desk, Chair', 'Y'),
('P0004', 2, 'Desk, Carpet', 'Y'),
('P0009', 11, NULL, 'N')
;

INSERT INTO Owns VALUES
('00011', 'P0002'),
('00011', 'P0006'),
('00011', 'P0001'),
('00011', 'P0004'),
('00011', 'P0005'),
('00012', 'P0009'),
('00012', 'P0003'),
('00012', 'P0007'),
('00013', 'P0008'),
('00013', 'P0010')
;

