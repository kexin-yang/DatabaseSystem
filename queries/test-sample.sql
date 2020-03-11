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
SELECT Applicant.Name, Applicant.Major, Applicant.ContactInformation
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

# Below are newly added on Mar. 9th 2020, for Milestone 2, some relatively more complex queries

# Order jobs by popularity
SELECT JID, JobTitle, Organization, Division, PositionType, InternalStatus, AppDeadline, Description
FROM Job, Company, Applied
WHERE Job.Organization = Company.Name
AND Job.JID = Applied.JID
ORDER BY COUNT(Applied.SID);

# Group applicants by major
SELECT Applicant.Major
FROM Applied, Applicant
WHERE Applied.SID = Applicant.SID
AND Applied.JID = 151034
GROUP BY Applicant.Major;

# Where has a student worked before?
SELECT StudentRecord.Term, Job.Organization, StudentRecord.Rating
FROM StudentRecord, Job
WHERE StudentRecord.JID = Job.JID
AND StudentRecord.SID = 18097676;

# Find all applicants who applied for a job
SELECT Applicant.Name, Applicant.Major, Applicant.ContactInformation
FROM Applied, Applicant
WHERE Applied.SID = Applicant.SID
AND Applied.JID = 151034;

# When a student is hired, delete the corresponding record in Applied
CREATE TRIGGER DeleteApplied
AFTER INSERT ON StudentRecord
REFERENCING NEW ROW AS newHire
FOR EACH ROW
DELETE FROM Applied
WHERE Applied.SID = newHire.SID
AND Applied.JID = newHire.JID;

# This Trigger is to remove corresponding job records in table Applied when a company 
# decides to remove a job posting
Create Trigger removeJob2
After Delete on Job
Referencing Old Row as OldJob
For Each row
Delete from Applied
Where Applied.JID = OldJob.JID;

# This Trigger is to remove corresponding job records in table Job when a company 
# decides to quit Workify and therefore remove itself from Company table, this trigger will trigger 
# the above two triggers
Create Trigger noCompany
After Delete on Company
Referencing old Rows as oldCompany
For Each Row
Delete from Job
Where Job.organization = oldCompany.name;
                                                          
# Select jobs with jobs whose ratings more than 9.0 and the Location of the company that offer this job is in Austin, U.S.
SELECT * 
FROM Job j, 
    (SELECT *
    FROM Company c
    WHERE c.Name = j.CompanyName) AS CJ
WHERE j.Rating > 9.0 AND CJ.Location == "Austin";

# If we want to select jobs from [companys] whose ratings are more than 9.0, and the application deadline is later than Apr. 1st, 2020 
SELECT * 
FROM Job j, 
    (SELECT * 
    FROM Company c
    WHERE c.Name == j.CompanyName) AS CJ
WHERE j.AppDeadline >= 1585699200 AND CJ.Rating > 9.0;

# Sort job by ratings
SELECT *
FROM Job
ORDER BY Rating DESC;
                               
# Print pairs of applicants and company applied before time t sorted by company name ascending order
SELECT Applicant.Name, Company.Name
FROM Applicant, Company, Applied, Job
WHERE Applid.AppliedDate < t AND
            Applied.SID = Applicant.SID AND
            Applied.JID = Job.JID AND
            Job.Organization = Company.Name
ORDER BY Company.Name asc;

# Print list of names of students who applied to 'Apple' but not 'Huawei' sorted by ascending name order
SELECT Applicant.Name
FROM  Applicant
WHERE Applicant.SID in 
(SELECT SID
FROM Applied, Job
WHERE Applied.JID = Job.JID AND
        Job.Organization = 'Apple'
EXCEPT
SELECT SID
FROM Applied, Job
WHERE Applied.JID = Job.JID AND
        Job.Organization = 'Huawei'
)
ORDER BY Applicant.Name asc;
                               
#Print the number of applicants who applied to more than 5 jobs
SELECT COUNT(*) FROM
           (SELECT Applicant.Name
             FROM Applicant, Applied
             WHERE Applicant.SID IN (
                          SELECT SID
                          FROM Applied a
                          GROUP BY a.SID
                          HAVING COUNT(a.JID) > 5)
            );

#print the company names and their locations of the companies that offers ' 'developer" job titles but not "writer''. The outputs are sorted by the name of
#the companies in ascending order.
SELECT name, location
FROM company
WHERE name IN (SELECT name
FROM Job
WHERE Job Title LIKE" % developer"
EXCEPT
SELET name
FROM Job
WHERE Job.JobTitle LIKE" % writer %")ORDER BY name in ASC;
                                                              
#For company A, print a list of Job titles, add date.
#and its corresponding applicants size
#sorted by the job title in ascending order. Note that it is
#possible that some Jobs don't have any applicants, the
#output should give a count of 0
#SELECT CS.JobTitle, a.Add Date, CS. size
#FROM add,
#(SELECT J.JobTitle, J.JID, count (Ap.SID) AS Jsize
#FROM Job J
#LEFT OUTER JOIN Applied Ap
#ON J.JID = Ap.JID & J.organization="A"
#Group By JID) AS CS
#WHERE JID = CS.JID
#ORDER BY CS.Job Title in ASC;
                              
#For Company A, print a list of Tips and their corresponding
#job titles that haven't been applied by anyone yet.                               
SELECT Job.JID, Job.JobTitle
FROM Job
WHERE organization = "A"
EXCEPT
SELECT J.JID, J.JobTitle
FROM Job J, Applied Ap
WHERE J.JID = Ap.JID AND J.Organization = "A";

# Find all applicants who applied for a job order by rating from past employers
SELECT Applicant.Name, Applicant.Major, Applicant.ContactInformation, AVG(StudentRecord.Rating)
FROM Applied, Applicant, StudentRecord
WHERE Applied.SID = Applicant.SID
AND Applied.JID = 151034
ORDER BY AVG(StudentRecord.Rating);

# Find all applicants who applied for a company
SELECT DISTINCT Applicant.Name, Applicant.Major, Applicant.ContactInformation
FROM Applied, Applicant, Job
WHERE Applied.SID = Applicant.SID
AND Applied.JID = Job.JID
AND Job.Organization = "Apple"
ORDER BY Job.JobTitle;
