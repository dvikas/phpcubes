CREATE TABLEMYTABLE ( 
ID     INT, 
NAME  VARCHAR (100), 
ADDRESS1   VARCHAR(100), 
ADDRESS2  VARCHAR(100), 
ZIPCODE  VARCHAR(10), 
CITY   VARCHAR(50), 
PROVINCE  VARCHAR(2) 
) 
SELECT ID, VARCHAR 
FROMMYTABLE
WHERE IDBETWEEN0 AND100 
ORDER BYNAME, ZIPCODE 