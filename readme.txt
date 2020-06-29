studentinfo(sid, firstname, lastname, ssn, dob, gender, race, photo, submission);



CREATE DATABASE dbstudentmanager;

CREATE TABLE `dbstudentmanager`.`studentinfo` (
	`sid` INT(10) NOT NULL AUTO_INCREMENT , 
	`firstname` VARCHAR(30) NOT NULL , 
	`lastname` VARCHAR(30) NOT NULL , 
	`ssn` VARCHAR(20) , 
	`dob` DATE NOT NULL , 
	`gender` CHAR(1) NOT NULL , 
	`race` VARCHAR(20) NOT NULL , 
	`photo` VARCHAR(200) , 
	`submission` VARCHAR(200) , 
	PRIMARY KEY (`sid`), 
	UNIQUE (`ssn`)) ENGINE = InnoDB;