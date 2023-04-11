use vbc353_4;
CREATE TABLE EmailDetail (
  emailID int NOT NULL,
  dateSent date NOT NULL,
  emailBody mediumtext,
  PRIMARY KEY (emailID,dateSent),
  FOREIGN KEY (emailID) REFERENCES logTable(emailID) ON DELETE CASCADE ON UPDATE CASCADE
);
