# DatabaseSystem

Repo for group project for 348

## JDBC-DB2 Sample code

To run JDBC-DB2 sample code, run `./compile` followed by `./test.sh`.

## How to create and load sample database


### Preparing data

1. Login to GCP.
2. Activate cloud shell by clicking the button on the top right corner.
3. Select project: 
```
gcloud config set project cs348demo-266020
```
4. Generate data and put into a txt file, attributes are separated by tabs (see jobs.txt in the raw folder for an example). 
5. In the same directory, write a script with the extension ".sql" to insert the data into a table of choice. For example, to insert data from jobs.txt to the table `Job`, the script should look something like this:
``` sql
LOAD DATA LOCAL INFILE 'jobs.txt'
INTO TABLE Job COLUMNS TERMINATED BY '\t';
```

### Loading data

4. Connect to MySQL (password: password):
```
gcloud sql connect workify-db --user=root
```
5. Use the Workify database:
```
mysql > USE Workify;
```
6. Execute the script you just created to insert data into the corresponding table:
```
mysql > source populateJobs.sql;
```

## Schema
 
Job (JID int, JobTitle string, Organization string, Division string, PositionType string, InternalStatus string, AppDeadline string, Description string)
 
Company (Name string, Rating float, Password string, Location string)
 
Applicant (SID int, Name string, Major string, Password String, ContactInformation string)
 
Applied (SID int, JID int)
