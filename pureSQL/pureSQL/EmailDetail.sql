CREATE TABLE Emaildetail (
  emailID int NOT NULL,
  dateSent date NOT NULL,
  emailBody mediumtext,
  PRIMARY KEY (emailID,dateSent),
  FOREIGN KEY (emailID) REFERENCES logtable(emailID) ON DELETE CASCADE ON UPDATE CASCADE
);
