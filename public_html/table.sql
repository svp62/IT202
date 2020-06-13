CREATE TABLE customer (
    customerID int NOT NULL,
    customerAge int NOT NULL,
    FirstName varchar(255),
    LastName varchar(255),
    surveyID int,
    PRIMARY KEY (customerID),
    FOREIGN KEY (surveyID) REFERENCES Survey_types(surveyID)
);

INSERT INTO customer VALUES ('001','18','richard', 'vaniya', '2');
INSERT INTO customer VALUES ('002','24','milley', 'patel', '1');

SELECT * FROM customer;



CREATE TABLE Survey_types ( surveyID int NOT NULL, category varchar(255), description varchar(255), PRIMARY KEY (surveyID)); 

INSERT INTO Survey_types VALUES ('1','beauty','everything related to makeup, nails, soap, lotions and perfumes'); 
INSERT INTO Survey_types VALUES ('2','resturant','breakfast lunch dinner cafes'); 
INSERT INTO Survey_types VALUES ('3','shops','clothing, jwellery, accessories');
INSERT INTO Survey_types VALUES ('4','brands',"iconic name brand's products"); 

SELECT * FROM Survey_types;