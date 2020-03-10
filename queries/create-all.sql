CREATE TABLE Job (
JID int,
JobTitle VARCHAR(255), 
Organization VARCHAR(255),
Division VARCHAR(255),
PositionType VARCHAR(255),
InternalStatus VARCHAR(255),
AppDeadline int, # Need to update in mysql
Description VARCHAR(255),
PRIMARY KEY(JID),
FOREIGN KEY Organization REFERENCES Company(Name));

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
AppliedDate int, # Need to update in mysql
PRIMARY KEY(SID, JID),
FOREIGN KEY (SID) REFERENCES Applicant(SID),
FOREIGN KEY (JID) REFERENCES Job(JID));

# Below are newly added on Mar. 9th 2020, for Milestone 2, some relatively more complex queries。

# We created a new table of student record.
CREATE TABLE StudentRecord (
SID int,
JID int,
Term int,
StudentRating int,
PRIMARY KEY (SID, Term),
FOREIGN KEY (SID) REFERENCES Applicant(SID),
FOREIGN KEY (JID) REFERENCES Job(JID));
