
create table Facilities (
	id INT PRIMARY KEY,
	facilityType VARCHAR(19),
	capacity INT,
	phoneNumber VARCHAR(50),
	facilityName VARCHAR(33) NOT NULL,
	managerID INT UNIQUE,
	province VARCHAR(20),
	city VARCHAR(10),
	address VARCHAR(50),
	webAddress VARCHAR(1000),
      FOREIGN KEY (managerID) REFERENCES Employee(ID)
);
DELETE FROM Facilities WHERE id = 1;
update Facilities set capacity = 200 where id = 1;
select * from Facilities;



