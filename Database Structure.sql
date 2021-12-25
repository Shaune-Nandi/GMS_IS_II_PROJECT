--Database Name: GMSdb

/*********FOR DEMONSTRATION ONLY**********

	INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
	VALUES ('Manager','Shaune','Nandi','SMN','12345','shaunenandi27@gmail.com','+254740948031','30/11/2021');
	INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
	VALUES ('Mechanic','John','Doe','JD','12345','jd@gmail.com','+254722709811','30/11/2021');
								**********RUN THESE 2 FIRST**************


	INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
	VALUES ('Customer','Ann','Atieno','Atiii','12345','annatieno@gmail.com','+254785678990','08/12/2021');



	INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
	VALUES ('KCD885C', 'Car', 'Toyota','Corolla','2015', 3);
	INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
	VALUES ('KDA335L', 'Car', 'Audi','Q7','2018', 3);
	INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
	VALUES ('KCX467F', 'Pick-up', 'Ford','Ranger','2019', 3);



	INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
	VALUES (NULL, '6', 'KCD885C', 'Body Panelling', 'Extreme offroad damages', 'PSHtK6', '05:55:39pm 07-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);
	INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
	VALUES (NULL, '6', 'KDA335L', 'Body Panelling', 'Accident with a bodaboda', 'liHHK6', '05:37:39pm 09-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);
	INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
	VALUES (NULL, '6', 'KCX467F', 'Wheel Alignment', 'Wheel is slightly distorted', 'hFtHK6', '09:37:39pm 09-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

*/


CREATE TABLE Users (
    UserID INT(11) AUTO_INCREMENT PRIMARY KEY,
	Role VARCHAR(255) NOT NULL,
    FirstName VARCHAR(255) NOT NULL,
    LastName VARCHAR(255) NOT NULL,
	UserName VARCHAR(255) NOT NULL,
    Password VARCHAR(255) NOT NULL,
	Email VARCHAR(255) NOT NULL,
	Phone VARCHAR(255) NOT NULL,
    DateJoined VARCHAR(255) NOT NULL
);

CREATE TABLE Vehicles (
    Registration VARCHAR(255) PRIMARY KEY,
	VehicleType VARCHAR(255) NOT NULL,
	VehicleMake VARCHAR(255) NOT NULL,
	VehicleName VARCHAR(255) NOT NULL,
	VehicleYear INT(4) NOT NULL,
	OwnerID INT(11) NOT NULL
);

CREATE TABLE CustRepairDetails (
    CustRepairID INT(11) AUTO_INCREMENT PRIMARY KEY,
	RepairCust INT(11) NOT NULL,
	Registration VARCHAR(255) NOT NULL,
	CustJobType VARCHAR(255) NOT NULL,
	CustRepairDesc VARCHAR(1000) NOT NULL,
	CustToken VARCHAR(255) NOT NULL,
	CustDate VARCHAR(255) NOT NULL,
	CustJobTaken VARCHAR(255) NOT NULL,
	CustJobTakenWhen VARCHAR(255),
	TakenByUserID INT(11),
	CustJobDone VARCHAR(255),
	CustJobRepairedWhen VARCHAR(255)
	PaymentStatus VARCHAR(255) NOT NULL,
	PaidWhen VARCHAR(255),
	SpareID INT(11)
);


CREATE TABLE Spares (
    SpareID INT(11) AUTO_INCREMENT PRIMARY KEY,
	SpareName VARCHAR(255) NOT NULL UNIQUE,
	Cost INT(11) NOT NULL,
	NoInStock INT(11) NOT NULL
);


CREATE TABLE SpareDetails (
    SpareDetailsID INT(11) AUTO_INCREMENT PRIMARY KEY,
	SpareDetailsName VARCHAR(255) NOT NULL,
	SpareTblID INT(11) NOT NULL,
	UsedWhen VARCHAR(255),
	UsedByCar VARCHAR(255)
);



CREATE TABLE Payments (
	PaymentID INT(11) AUTO_INCREMENT PRIMARY KEY,
	PaymentDate VARCHAR(255) NOT NULL,
	PaymentAmount INT(11) NOT NULL,
	UserID INT(11) NOT NULL,
	Registration VARCHAR(255) NOT NULL,
	CustRepairID INT(11)
);















INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Manager','Shaune','Nandi','SMN','12345','shaunenandi27@gmail.com','+254740948031','30/11/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Manager','Harriet','Masanga','HMasanga','12345','harrietmasanga@gmail.com','+254746425868','08/12/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Mechanic','John','Doe','JD','12345','jd@gmail.com','+254722709811','30/11/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Mechanic','Peter','Dowry','PD','12345','pd@gmail.com','+25411360091','30/11/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Mechanic','Ronald','Omulindi','Ronyo','12345','ronald@gmail.com','+254758449936','05/12/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Customer','Mark','Kuria','MKur','12345','markii@gmail.com','+254753765442','06/12/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Customer','Brandon','Tumbo','Brandy254','12345','btumbo@gmail.com','+254786446782','29/07/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Customer','Lisa','Njeri','LisN','12345','njeri@gmail.com','+254756748009','01/11/2021');

INSERT INTO `users`(`Role`, `FirstName`, `LastName`, `UserName`, `Password`, `Email`, `Phone`, `DateJoined`)
VALUES ('Customer','Ann','Atieno','Atiii','12345','annatieno@gmail.com','+254785678990','08/12/2021');



INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KCD885C', 'Car', 'Toyota','Corolla','2015', 6);

INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KDA335L', 'Car', 'Audi','Q7','2018', 6);

INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KCX467F', 'Pick-up', 'Ford','Ranger','2019', 6);



INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KCL957V', 'Car', 'Nissan','X-Trail','2013', 7);

INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KBG544V', 'Car', 'Toyota','Premio','2008', 7);

INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KDB478K', 'Van', 'Toyota','HiAce','2015', 7);


INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KDD667H', 'Car', 'Mercedes Benz','S-Class','2020', 8);

INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KBL638Y', 'Car', 'Mercedes Benz','C-Class','2009', 8);




INSERT INTO `Vehicles`(`Registration`, `VehicleType`, `VehicleMake`, `VehicleName`, `VehicleYear`, `OwnerID`)
VALUES ('KDC356L', 'Car', 'Audi','RS6','2021', 9);












INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '6', 'KCD885C', 'Body Panelling', 'Extreme offroad damages', 'PSHtK6', '05:55:39pm 07-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '6', 'KDA335L', 'Body Panelling', 'Accident with a bodaboda', 'liHHK6', '05:37:39pm 09-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '6', 'KCX467F', 'Wheel Alignment', 'Wheel is slightly distorted', 'hFtHK6', '09:37:39pm 09-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '6', 'KDA335L', 'Oil Change', 'Need better quality oil', 'kksju9', '07:04:12am 07-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '6', 'KCX467F', 'Puncture', 'Slow puncture', 'ThsyY8', '10:57:31pm 30-11-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);



INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '7', 'KCL957V', 'Puncture', 'Ran over some spikes while escaping alco-blow', 'rSdtK7', '12:38:31pm 05-12-21', 'NO', NULL, NULL, 'NO', NULL 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '7', 'KBG544V', 'Brake Repair', 'Brake disks are worn out', 'OSGtK7', '12:48:31pm 06-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '7', 'KDB478K', 'Oil Change', 'Mileage is over 100,000 Km. The car needs servicing since it is overdue', 'dUjkw7', '11:27:31am 08-12-21', 'NO', NULL, NULL, 'NO', NULL 'NO', NULL);



INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '8', 'KDD667H', 'Puncture', 'Valve is spoilt', 'kGYYk8', '10:27:33am 07-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '8', 'KBL638Y', 'Wheel Alignment', 'Wheel is vibrating at high speeds', 'UIskp8', '11:27:31pm 08-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '8', 'KBL638Y', 'Puncture', 'Sharp rocks', 'hsUmL8', '09:27:31pm 08-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);



INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '9', 'KDC356L', 'Body Panelling', 'Accident with a matatu', 'Yunwu9', '08:14:55am 22-11-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '9', 'KDC356L', 'Puncture', 'Drove over some nails at the job site', 'usgtk9', '09:46:38am 08-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);

INSERT INTO `custrepairdetails` (`CustRepairID`, `RepairCust`, `Registration`, `CustJobType`, `CustRepairDesc`, `CustToken`, `CustDate`, `CustJobTaken`, `CustJobTakenWhen`, `TakenByUserID`, `CustJobDone`, `CustJobRepairedWhen`, `PaymentStatus`, `PaidWhen`)
VALUES (NULL, '9', 'KDC356L', 'Brake Repair', 'Brake pads need replacement ASAP', 'hsykI9', '01:13:50pm 01-12-21', 'NO', NULL, NULL, 'NO', NULL, 'NO', NULL);





INSERT INTO `spares` (`SpareID`, `SpareName`, `Cost`, `NoInStock`) VALUES (NULL, 'Wipers', '1000', '10');
INSERT INTO `spares` (`SpareID`, `SpareName`, `Cost`, `NoInStock`) VALUES (NULL, 'Brake Pads', '3000', '100');
INSERT INTO `spares` (`SpareID`, `SpareName`, `Cost`, `NoInStock`) VALUES (NULL, 'Tires', '20000', '20');
INSERT INTO `spares` (`SpareID`, `SpareName`, `Cost`, `NoInStock`) VALUES (NULL, 'Oil', '500', '30');
INSERT INTO `spares` (`SpareID`, `SpareName`, `Cost`, `NoInStock`) VALUES (NULL, 'Windscreen', '8000', '10');
































/*

	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=1;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=2;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=3;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=4;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=5;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=6;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=7;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=8;
	UPDATE CustRepairDetails SET CustJobTaken='NO',CustJobTakenWhen=NULL, TakenByUserID=NULL, CustJobDone='NO', CustJobRepairedWhen=NULL WHERE CustRepairID=9;

*/





/*




---To Be used later
CREATE TABLE Repairs (
    RepairID INT(11) AUTO_INCREMENT PRIMARY KEY,
	JobType VARCHAR(255) NOT NULL,
	Registration VARCHAR(255) NOT NULL,
	Cost INT(11) NOT NULL,
	UsedPartID INT(11) NOT NULL,
	UsedPart VARCHAR(255) NOT NULL,
	UserID INT(11) NOT NULL
);

CREATE TABLE SpareParts (
    PartNo INT(11) AUTO_INCREMENT PRIMARY KEY,
	PartType VARCHAR(255) NOT NULL,
	PartName VARCHAR(255) NOT NULL,
	Make VARCHAR(255) NOT NULL,
	Cost INT(11) NOT NULL
);






*/


