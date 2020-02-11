# Company login (successful)
SELECT COUNT(*) FROM Company WHERE Name = 'Altius Analytics Labs' AND Password = 'BcX0tyP5';

# Applicant (student) login (successful)
SELECT COUNT(*) FROM Applicant WHERE SID = 71264089 AND Password = 'NDNZCaTk';

# Find all jobs posted by a certain company
SELECT * FROM Job WHERE Organization = 'ArcelorMittal';

# Filter jobs by company rating
SELECT JID, JobTitle, Organization, Division, PositionType, InternalStatus, AppDeadline, Description
FROM Job, Company
WHERE Job.Organization = Company.Name
AND Company.Rating > 9.5;

# Find the name of a student
SELECT Name FROM Applicant WHERE SID = 71264089;

# Find all applicants who applied for a job
SELECT Applicant.SID, Applicant.Name, Applicant.Major, Applicant.Password, Applicant.ContactInformation
FROM Applied, Applicant
WHERE Applied.SID = Applicant.SID
AND Applied.JID = 151034;

# Find the number of applicants for a job
SELECT COUNT(*)
FROM Applied, Applicant
WHERE Applied.SID = Applicant.SID
AND Applied.JID = 151034;

# Apply for a job
INSERT INTO Applied (SID, JID) values (18097676, 150554);

# Post a new job
INSERT INTO Job (JID, JobTitle, Organization, Division, PositionType, InternalStatus, AppDeadline, Description) values (666666, "Dishwasher", "Apple Inc", "Divisional Office", "Full-time", "Open for Applications", "Feb 5, 2020", "Clean dishes.");

# Register new company
INSERT INTO Company (Name, Rating, Password, Location) values ("McDonalds", 9.9, "password", "Mexico");

# Register new applicant (student)
INSERT INTO Applicant (SID, Name, Major, Password, ContactInformation) values (00000001, "Natasha Denona", "Arts", "password", "natasha.denona@gmail.com");

# Delete a job
DELETE FROM Job WHERE JID = 666666;
