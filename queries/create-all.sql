CREATE TABLE Job (
JID int,
JobTitle VARCHAR(255), 
Organization VARCHAR(255),
Division VARCHAR(255),
PositionType VARCHAR(255),
InternalStatus VARCHAR(255),
AppDeadline VARCHAR(255),
Description VARCHAR(255),
PRIMARY KEY(JID));

CREATE TABLE Company (
Name VARCHAR(255),
Rating float,
Password VARCHAR(255),
Location VARCHAR(255),
PRIMARY KEY(Name));

CREATE TABLE Applicant (
SID int,
Name VARCHAR(255),
Major VARCHAR(255),
Password VARCHAR(255),
ContactInformation VARCHAR(255),
PRIMARY KEY(SID));

CREATE TABLE Applied (
SID int,
JID int,
PRIMARY KEY(SID, JID));
