# DatabaseSystem

Repo for group project for 348

The website of our project:
http://cs348demo-266020.appspot.com/


## For TA grading Milestone 2:

The folder data transformer is the code we used to scrape and create data to use in the application.
The folder of queries contains all the SQL codes for creating tables, constraints etc. 

## Features
- Student login: /student.php
- Employer login: /employer.php
- Student 
    - apply: /student-login.php
    - filter for jobs: /student-login.php
- Employer
    - post: /employer-login.php
    - view applicant info: /employer-login.php


## How to create and load sample database

### Data source

- Our data is scraped from Waterloo Works: https://waterlooworks.uwaterloo.ca/
- The code that extracts and transforms the production dataset is located in /DataTransformer

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
