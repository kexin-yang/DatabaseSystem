# DatabaseSystem
Repo for group project for 348

## JDBC-DB2 Sample code
To run JDBC-DB2 sample code, run `./compile` followed by `./test.sh`

## Schema
 
Job (JID int, JobTitle string, Organization string, Division string, PositionType string, InternalStatus string, AppDeadline string, Description string)
 
Company (Name string, Rating float, Password string, Location string)
 
Applicant (SID int, Name string, Major string, Password String, ContactInformation string)
 
Applied (SID int, JID int)

